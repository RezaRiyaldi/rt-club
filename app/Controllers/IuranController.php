<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IuranModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

class IuranController extends BaseController
{
    protected $iuranModel;

    public function __construct()
    {
        $this->iuranModel = new IuranModel();
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

            // $d['joined'] = date('H:s, d M Y', strtotime($d['joined']));

            // $d['jabatan'] = $d['jabatan'] ?? '-';

            // $actions = [];

            // if (isset($d['no_kk'])) {
            //     $actions[] = '<a href="' . base_url('users-man/detail/' . base64_encode($d['no_kk'])) . '" class="btn btn-secondary btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Detail User"><i class="fas fa-eye"></i></a>';
            // }

            // $actions[] = '<a href="' . base_url('/users-man/edit/' . base64_encode($d['id_user'])) . '" class="btn btn-warning btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Edit User"><i class="fas fa-pen"></i></a>';

            // $actions[] = '<button style="background-color: orangered" class="btn btn-sm text-light px-2 py-1 mb-0 assign-group" data-id="' . base64_encode($d['id_user']) . '" data-fullname="' . $d['fullname'] . '" data-username="' . $d['username'] . '" data-toggle="tooltip" title="Masukan ke Grup"><i class="fas fa-link"></i></button>';

            // $d['action'] = implode('', $actions);
            $arr[] = $d;
        }

        $total_count_filter = count($data);
        $total_count_all = count($this->iuranModel->getIurans($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_filter,
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
            'description' => $dataForm['description']
        ];

        $iuranType = new Model();
        $iuranType = $iuranType->db->table('iuran_type')->where('id', $id)->update($dataUpdate);

        return redirect('iuran/type')->with('message', 'Berhasil merubah tipe iuran');
    }
}
