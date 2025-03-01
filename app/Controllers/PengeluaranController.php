<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengeluaranModel;
use Exception;

class PengeluaranController extends BaseController
{
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
    }

    public function index()
    {
        $data = [

        ];

        return view('pengeluaran/index', $data);
    }

    public function getListPengeluaran() {
        $post = (object) $this->request->getPost();

        $param = [];
        $param['draw'] = $post->draw != NULL ? $post->draw : '';
        $param['start'] = $post->start != NULL ? $post->start : '';
        $param['length'] = $post->length != NULL ? $post->length : '';
        $param['search'] = $post->search['value'] != NULL ? $post->search['value'] : '';
        $param['columns'] = $post->columns;
        $param['order'] = $post->order;

        $data = $this->pengeluaranModel->getPengeluarans($param);

        $arr = [];
        $no = $param['start'] + 1;
        foreach ($data as $d) {
            $d = (array) $d;
            $d['no'] = $no++;
            $d['periode'] = date('d F Y', strtotime($d['periode']));
            $d['nominal'] = 'Rp. ' . number_format($d['nominal'], 0, ',', '.');

            $action = [];
            $action[] = '<a href="/pengeluaran/detail/' . base64_encode($d['id']) . '" class="btn btn-sm btn-secondary px-2 py-1 mb-0"><i class="fas fa-eye"></i></a>';
            
            if (in_groups(['Superadmin', 'Ketua RT', 'Bendahara'])) {
                $action[] = '<button data-id="' . base64_encode($d['id']) . '" class="btn btn-sm btn-warning px-2 py-1 btn-edit mb-0"><i class="fas fa-pen"></i></button>';
                $action[] = '<button data-id="' . base64_encode($d['id']) . '" class="btn btn-sm btn-danger px-2 py-1 btn-delete mb-0" data-name="' . $d['pengeluaran'] . '" data-amount="' . $d['nominal'] . '"><i class="fas fa-trash"></i></button>';
            }

            $d['action'] = implode('&nbsp;', $action);

            $arr[] = $d;
        }

        $total_count_filter = count($data);
        $total_count_all = count($this->pengeluaranModel->getPengeluarans($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_all,
            'data' => $arr
        ];


        $res = json_encode($res);

        echo $res;
    }

    public function processAddPengeluaran() {
        $type = 'message';
        $message = 'Unknown';
        $post = $this->request->getPost();

        $dataInsert = [];
        $dataInsert['pengeluaran'] = ucwords(strtolower($post['pengeluaran']));
        $dataInsert['nominal'] = str_replace('.', '', $post['nominal']);
        $dataInsert['periode'] = $post['periode'];
        $dataInsert['description'] = $post['description'];
        $dataInsert['created_by'] = $dataInsert['updated_by'] = user()->id;

        
        try {
            $this->pengeluaranModel->insert($dataInsert);
            $message = 'Berhasil menambah pengeluaran';
        } catch (Exception $e) {
            $message = $e;
            $type = 'error';
        }

        return redirect('pengeluaran')->with($type, $message);
    }

    public function getPengeluaran($id) {
        $id = base64_decode($id);
        $pengeluaran = $this->pengeluaranModel
            ->select('pengeluarans.*, users.username')
            ->join('users', 'users.id = pengeluarans.created_by', 'left')
            ->where('pengeluarans.id', $id)
            ->get()->getRow();

        $pengeluaran->nominal = number_format($pengeluaran->nominal, 0, ',', '.');

        echo json_encode($pengeluaran);
    }

    public function processEditPengeluaran($id) {
        $id = base64_decode($id);
        $type = 'message';
        $message = 'Unknown';
        $post = $this->request->getPost();

        $dataUpdate = [];
        $dataUpdate['pengeluaran'] = ucwords(strtolower($post['pengeluaran']));
        $dataUpdate['nominal'] = str_replace('.', '', $post['nominal']);
        $dataUpdate['periode'] = $post['periode'];
        $dataUpdate['description'] = $post['description'];
        $dataUpdate['updated_by'] = user()->id;

        try {
            $this->pengeluaranModel->update($id, $dataUpdate);
            $message = 'Berhasil merubah pengeluaran';
        } catch (Exception $e) {
            $message = $e;
            $type = 'error';
        }

        return redirect('pengeluaran')->with($type, $message);
    }

    public function processDeletePengeluaran($id) {
        $id = base64_decode($id);

        $this->pengeluaranModel->delete($id);

        return redirect('pengeluaran')->with('message', 'Berhasil menghapus pengeluaran');
    }

    public function detailPengeluaran($_id)
    {
        $id = base64_decode($_id);

        $detailPengeluaran = $this->pengeluaranModel->select('pengeluarans.*, wargas.*')
            ->join('users', 'users.id = pengeluarans.created_by', 'left')
            ->join('wargas', 'wargas.user_id = users.id', 'left')
            ->where('pengeluarans.id', $id)
            ->get()->getRow();
        
        $data = [
            'pengeluaran' => $detailPengeluaran
        ];

        return view('pengeluaran/detail', $data);
    }
}
