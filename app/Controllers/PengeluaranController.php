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
            $action[] = '<a href="/pengeluaran/detail/' . base64_encode($d['id']) . '" class="btn btn-sm btn-secondary px-2"><i class="fas fa-eye"></i></a>';
            
            if (in_groups(['Superadmin', 'Ketua RT', 'Bendahara'])) {
                $action[] = '<button data-id="' . base64_encode($d['id']) . '" class="btn btn-sm btn-warning px-2 btn-edit"><i class="fas fa-pen"></i></button>';
            }

            $d['action'] = implode('&nbsp;', $action);

            $arr[] = $d;
        }

        $total_count_filter = count($data);
        $total_count_all = count($this->pengeluaranModel->getPengeluarans($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_filter,
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
        $dataInsert['created_by'] = user()->id;

        
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
            ->join('users', 'users.id = pengeluarans.created_by')
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
        $dataUpdate['created_by'] = user()->id;

        try {
            $this->pengeluaranModel->update($id, $dataUpdate);
            $message = 'Berhasil merubah pengeluaran';
        } catch (Exception $e) {
            $message = $e;
            $type = 'error';
        }

        return redirect('pengeluaran')->with($type, $message);
    }
}
