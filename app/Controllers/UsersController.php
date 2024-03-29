<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupModel2;
use App\Models\UserModel2;
use App\Models\WargaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class UsersController extends BaseController
{
    public $userModel;
    public $groupModel;
    public $wargaModel;

    public function __construct()
    {
        $this->userModel = new UserModel2();
        $this->groupModel = new GroupModel2();
        $this->wargaModel = new WargaModel();
    }

    public function userManagement()
    {
        $groups = $this->groupModel->getGroups();

        $data = [
            'groups' => $groups
        ];

        return view('users_management/index', $data);
    }

    public function getListUsers()
    {
        $post = (object) $this->request->getPost();

        $param = [];
        $param['draw'] = $post->draw != NULL ? $post->draw : '';
        $param['start'] = $post->start != NULL ? $post->start : '';
        $param['length'] = $post->length != NULL ? $post->length : '';
        $param['search'] = $post->search['value'] != NULL ? $post->search['value'] : '';
        $param['columns'] = $post->columns;
        $param['order'] = $post->order;

        $data = $this->userModel->getUsers($param);

        $arr = [];
        $no = $param['start'] + 1;
        foreach ($data as $d) {
            $d = (array) $d;
            $d['no'] = $no++;

            $d['joined'] = date('H:s, d M Y', strtotime($d['joined']));

            $d['jabatan'] = $d['jabatan'] ?? '-';

            $actions = [];

            if (isset($d['no_kk'])) {
                $actions[] = '<a href="' . base_url('users-man/detail/' . base64_encode($d['no_kk'])) . '" class="btn btn-secondary btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Detail User"><i class="fas fa-eye"></i></a>';
            }

            $actions[] = '<a href="' . base_url('/users-man/edit/' . base64_encode($d['id_user'])) . '" class="btn btn-warning btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Edit User"><i class="fas fa-pen"></i></a>';

            $actions[] = '<button style="background-color: orangered" class="btn btn-sm text-light px-2 py-1 mb-0 assign-group" data-id="' . base64_encode($d['id_user']) . '" data-fullname="' . $d['fullname'] . '" data-username="' . $d['username'] . '" data-toggle="tooltip" title="Masukan ke Grup"><i class="fas fa-link"></i></button>';

            $d['action'] = implode('', $actions);
            $arr[] = $d;
        }

        $total_count_filter = count($data);
        $total_count_all = count($this->userModel->getUsers($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_filter,
            'data' => $arr
        ];


        $res = json_encode($res);

        echo $res;
    }

    public function addUser()
    {
        $data = [
            'title' => 'Edit User',
            'url' => '/users-man/add',
        ];

        return view('users_management/form', $data);
    }

    public function processAddUser()
    {
        $type = "";
        $message = "";

        $dataForm = $this->request->getPost();
        $keys = array_keys($dataForm);

        $data = [];
        for ($i = 0; $i < count($dataForm['username']); $i++) {
            foreach ($keys as $key) {
                $field = $dataForm[$key];
                if (is_array($field)) {
                    $data[$i][$key] = $field[$i];
                } else {
                    $data[$i][$key] = $field;
                }
            }
        }

        $db = Database::connect();
        $db->transBegin();

        try {
            foreach ($data as $d) {
                // INSERT USER
                $insert_user = [];
                $insert_user['username'] = $d['username'];
                $insert_user['email'] = $d['email'];
                $insert_user['active'] = 1;
                $insert_user['password_hash'] = password_hash(
                    base64_encode(
                        hash('sha384', date('dmY', strtotime($d['birth_of_day'])), true)
                    ),
                    PASSWORD_DEFAULT
                );
                $userId = $this->userModel->insert($insert_user);

                $d['address'] = json_encode([
                    'alamat' => $d['address'],
                    'provinsi' => $d['province'],
                    'kota' => $d['city'],
                    'kecamatan' => $d['subdistrict'],
                    'kelurahan' => $d['village'],
                    'rt' => str_pad($d['rt'], 3, "0", STR_PAD_LEFT),
                    'rw' => str_pad($d['rw'], 3, "0", STR_PAD_LEFT),
                ]);

                // INSERT WARGA
                unset($d['csrf_test_name']);
                unset($d['username']);
                unset($d['email']);
                unset($d['province']);
                unset($d['city']);
                unset($d['subdistrict']);
                unset($d['village']);
                unset($d['rt']);
                unset($d['rw']);

                $insert_warga = [];
                $insert_warga['user_id'] = $userId;
                foreach ($d as $key => $val) {
                    $insert_warga[$key] = $val;
                }

                $this->wargaModel->insert($insert_warga);
            }

            if ($db->transStatus()) {
                $db->transCommit();
                $type = "message";
                $message = "Berhasil menambahkan users";
            } else {
                $db->transRollback();
                $type = "error";
                $message = "Gagal menambahkan users";
            }
        } catch (\Exception $e) {
            $db->transRollback();

            $type = "errors";
            $message = $e;
        }

        return redirect('users-man')->with($type, $message);
    }

    public function detailUser($kk)
    {
        $kk = base64_decode($kk);

        $family = $this->userModel->getUserByKK($kk);
        $leadFamily = $family[0];
        $leadAddress = json_decode($leadFamily->address);

        $data = [
            'lead_family' => $leadFamily,
            'lead_address' => $leadAddress,
            'family' => $family,
            'no_kk' => $kk
        ];

        return view('users_management/detail', $data);
    }

    public function editUser($userId)
    {
        $userId = base64_decode($userId);

        $user = $this->userModel->getUserById($userId);

        $family = $this->userModel->getUserByKK($user->no_kk);

        $data = [
            'title' => 'Edit User',
            'url' => '/users-man/edit',
        ];

        return view('users_management/form', $data);
    }
}
