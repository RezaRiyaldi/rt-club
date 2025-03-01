<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IuranModel;
use App\Models\WargaModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;
use Exception;

class IuranController extends BaseController
{
    protected $iuranModel;
    protected $wargaModel;

    public function __construct()
    {
        $this->iuranModel = new IuranModel();
        $this->wargaModel = new WargaModel();
    }

    public function index()
    {
        return view('iuran/index');
    }

    public function getListIurans()
    {
        $post = (object) $this->request->getPost();

        $param = [];
        $param['draw'] = $post->draw != NULL ? $post->draw : '';
        $param['start'] = $post->start != NULL ? $post->start : '';
        $param['length'] = $post->length != NULL ? $post->length : '';
        $param['search'] = $post->search['value'] != NULL ? $post->search['value'] : '';
        $param['columns'] = $post->columns;
        $param['order'] = $post->order;

        $data = $this->iuranModel->getIurans($param);

        $arr = [];
        $no = $param['start'] + 1;
        foreach ($data as $d) {
            $d = (array) $d;
            $d['no'] = $no++;

            $actions = [];
            if (in_groups(['Superadmin', 'Ketua RT', 'Bendahara']) || $d['user_id'] == user()->id) {
                $actions[] = '<a href="' . base_url('iuran/detail/' . date('my', strtotime($d['periode'])) . '/' . base64_encode($d['warga_id'])) . '" class="btn btn-secondary btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Detail User"><i class="fas fa-eye"></i></a>';
            }
                
            // $actions[] = '<a href="' . base_url('iuran/edit/' . base64_encode($d['id'])) . '" class="btn btn-warning btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Edit User"><i class="fas fa-pen"></i></a>';

            $d['action'] = implode('', $actions);
            $d['periode'] = date('F Y', strtotime($d['periode']));

            $bg = "danger";
            $text = "Belum Lunas";
            if ($d['nominal'] >= $d['nominal_type']) {
                $text = "Lunas";
                $bg = "success";
            }

            $d['status_kas'] = "<span class='badge bg-$bg'>$text</span>";
            $d['nominal'] = 'Rp. ' . number_format($d['nominal'], 0, ',', '.');

            $arr[] = $d;
        }

        $total_count_filter = count($data);
        $total_count_all = count($this->iuranModel->getIurans($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_all,
            'data' => $arr
        ];


        $res = json_encode($res);

        echo $res;
    }

    public function iuranType()
    {
        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->get()->getResult();

        $data =  [
            'iuran_type' => $iuranType
        ];

        return view('iuran/type/index', $data);
    }

    public function processAddTypeIuran()
    {
        $dataForm = $this->request->getPost();

        $dataInsert = [
            'type' => ucwords(strtolower($dataForm['type'])),
            'nominal' => str_replace('.', '', $dataForm['nominal']),
            'description' => $dataForm['description']
        ];

        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->insert($dataInsert);

        return redirect('iuran/type')->with('message', 'Berhasil menambah tipe iuran');
    }

    public function getDetailTypeIuran()
    {
        $_id = $this->request->getGet();
        $id = base64_decode($_id['id']);

        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->where('id', $id)->get()->getRow();

        echo json_encode($iuranType);
    }

    public function processEditTypeIuran($id)
    {
        $id = base64_decode($id);

        $dataForm = $this->request->getPost();

        $dataUpdate = [
            'type' => ucwords(strtolower($dataForm['type'])),
            'nominal' => str_replace('.', '', $dataForm['nominal']),
            'description' => $dataForm['description']
        ];

        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->where('id', $id)->update($dataUpdate);

        return redirect('iuran/type')->with('message', 'Berhasil merubah tipe iuran');
    }

    public function addIuran()
    {
        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->get()->getResult();

        $wargas = $this->wargaModel->select('wargas.id, wargas.fullname, users.username')
            ->join('users', 'users.id = wargas.user_id')
            ->where('status_family', 'Kepala Keluarga')
            ->where('deleted_by', '0')
            ->get()->getResult();

        $data =  [
            'title' => "Tambah Iuran",
            'iuran_type' => $iuranType,
            'wargas' => $wargas,
            'action' => 'add'
        ];

        return view('iuran/form', $data);
    }

    public function processAddIuran()
    {
        $type = 'message';
        $message = 'Unknown';

        $post = $this->request->getPost();

        $dataInsert = [];
        $dataInsert['warga_id'] = $post['warga_id'];
        $dataInsert['type_id'] = $post['type_id'];
        $dataInsert['nominal'] = str_replace('.', '', $post['nominal']);
        $dataInsert['periode'] = date('Y-m-d', strtotime($post['periode']));
        $dataInsert['payment_method'] = $post['payment_method'] ?? 'Cash';
        $dataInsert['description'] = $post['description'];

        try {
            $this->iuranModel->insert($dataInsert);
            $message = 'Berhasil menambah iuran';
        } catch (Exception $e) {
            $message = $e;
            $type = 'error';
        }

        return redirect('iuran')->with($type, $message);
    }

    public function editIuran($_id)
    {
        $id = base64_decode($_id);

        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->get()->getResult();

        $wargas = $this->wargaModel->select('wargas.id, wargas.fullname, users.username')
            ->join('users', 'users.id = wargas.user_id')
            ->where('status_family', 'Kepala Keluarga')
            ->where('deleted_by', '0')
            ->get()->getResult();

        $detailIuran = $this->iuranModel->find($id);

        $data =  [
            'title' => "Edit Iuran",
            'iuran_type' => $iuranType,
            'wargas' => $wargas,
            'iuran' => $detailIuran
        ];

        return view('iuran/form', $data);
    }

    public function processEditIuran()
    {
        $post = $this->request->getPost();
        $id = base64_decode($post['id']);
        $type = 'message';
        $message = 'Unknown';

        $dataUpdate = [];
        $dataUpdate['warga_id'] = $post['warga_id'];
        $dataUpdate['type_id'] = $post['type_id'];
        $dataUpdate['nominal'] = str_replace('.', '', $post['nominal']);
        $dataUpdate['periode'] = date('Y-m-d', strtotime($post['periode']));
        $dataUpdate['payment_method'] = $post['payment_method'] ?? 'Cash';
        $dataUpdate['description'] = $post['description'];

        try {
            $this->iuranModel->update($id, $dataUpdate);
            $message = 'Berhasil merubah iuran';
        } catch (Exception $e) {
            $message = $e;
            $type = 'error';
        }

        return redirect('iuran')->with($type, $message);
    }

    public function detailIuran($period, $warga_id)
    {
        $bulan = substr($period, 0, 2);
        $tahun = 20 . substr($period, 2);
        $periode = "$tahun-$bulan";
        $warga_id = base64_decode($warga_id);

        $iurans = $this->iuranModel->select('iurans.*, wargas.fullname, wargas.address, iuran_type.type, iuran_type.nominal as nominal_type')
            ->join('iuran_type', 'iuran_type.id = iurans.type_id', 'inner')
            ->join('wargas', 'wargas.id = iurans.warga_id', 'inner')
            ->where('warga_id', $warga_id)
            ->like('periode', $periode, 'after')
            ->get()
            ->getResult();

        $nominal = 0;
        foreach ($iurans as $iuran) {
            $nominal += $iuran->nominal;
        }

        $status = 'Belum Lunas';
        if ($nominal >= $iurans[0]->nominal_type) {
            $status = 'Lunas';
        }
        
        $data = [
            'warga' => $iurans[0],
            'iurans' => $iurans,
            'status' => $status
        ];

        return view('iuran/detail', $data);
    }
}
