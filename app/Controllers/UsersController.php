<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel2;
use App\Models\WargaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Myth\Auth\Models\GroupModel;

class UsersController extends BaseController
{
    public $userModel;
    public $groupModel;
    public $wargaModel;

    public function __construct()
    {
        $this->userModel = new UserModel2();
        $this->groupModel = new GroupModel();
        $this->wargaModel = new WargaModel();
    }

    public function userManagement()
    {
        return view('users_management/index');
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
        foreach ($data as $d) {
            $d = (array) $d;
            $d['joined'] = date('H:s, d M Y', strtotime($d['joined']));

            if ($d['status']) {
                $bg = "bg-success";
                $txt = "Active";
            } else {
                $bg = "bg-secondary";
                $txt = "Non-Active";
            }

            $d['status'] = "<span class='badge $bg'>$txt</span>";

            $d['action'] = '<a href="javascript:;" class="text-secondary font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit user">Edit</a>';

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
        return view('users_management/add');
    }

    public function processAddUser()
    {
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
                $insert_user['password_hash'] = password_hash(date('dmY', strtotime($d['birth_of_day'])), PASSWORD_DEFAULT);
                $userId = $this->userModel->insert($insert_user);

                $d['address'] = json_encode([
                    'alamat' => $d['address'],
                    'provinsi' => $d['province'],
                    'kota' => $d['city'],
                    'kecamatan' => $d['subdistrict'],
                    'kelurahan' => $d['ward'],
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
                unset($d['ward']);
                unset($d['rt']);
                unset($d['rw']);

                $insert_warga = [];
                $insert_warga['user_id'] = $userId;
                foreach ($d as $key => $val) {
                    $insert_warga[$key] = $val;
                }

                $this->wargaModel->insert($insert_warga);
            }

            $db->transCommit();
            return redirect('users-man');
        } catch (\Exception $e) {
            $db->transRollback();
            // dd($e);

            return redirect('users-man')->with('error', $e);

        }
    }
}
