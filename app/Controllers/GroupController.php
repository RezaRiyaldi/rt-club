<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupModel2;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Exception;
use Myth\Auth\Models\GroupModel;

class GroupController extends BaseController
{
    public $groupModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel2();
    }

    public function index()
    {
        return view('users_management/groups/index');
    }

    public function getListGroups()
    {
        $post = (object) $this->request->getPost();

        $param = [];
        $param['draw'] = $post->draw != NULL ? $post->draw : '';
        $param['start'] = $post->start != NULL ? $post->start : '';
        $param['length'] = $post->length != NULL ? $post->length : '';
        $param['search'] = $post->search['value'] != NULL ? $post->search['value'] : '';
        $param['columns'] = $post->columns;
        $param['order'] = $post->order;

        $data = $this->groupModel->getGroups($param);

        $arr = [];
        $no = $param['start'] + 1;
        foreach ($data as $d) {
            $d = (array) $d;

            $d['no'] = $no++;

            $actions = [];

            $actions[] = '<a href="' . base_url('groups-man/edit/' . base64_encode($d['id'])) . '" class=" btn btn-warning btn-sm mb-0 py-1 px-2 me-1" data-toggle="tooltip" title="Edit Grup"><i class="fas fa-pen"></i></a>'; 
            $actions[] = '<a href="' . base_url('groups-man/detail/' . base64_encode($d['id'])) . '" class=" btn btn-info btn-sm mb-0 py-1 px-2" data-toggle="tooltip" title="Detail Grup"><i class="fas fa-eye"></i></a>';
            
            $d['action'] = implode('', $actions);

            $arr[] = $d;
        }

        $total_count_filter = count($data);
        $total_count_all = count($this->groupModel->getGroups($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_filter,
            'data' => $arr
        ];


        $res = json_encode($res);

        echo $res;
    }

    public function addGroup()
    {
        $data = [
            'title' => 'Tambah Grup',
            'url' => '/groups-man/edit',
        ];

        return view('users_management/groups/form', $data);
    }

    public function processAddGroup()
    {
        $dataInsert = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        try {
            $this->groupModel->db->transBegin();
            $this->groupModel->db->table('auth_groups')->insert($dataInsert);

            if ($this->groupModel->db->transStatus()) {
                $this->groupModel->db->transCommit();
            } else {
                $this->groupModel->db->transRollback();
            }

        } catch (Exception $e) {
            $this->groupModel->db->transRollback();
        }
        return redirect('groups-man');
    }

    public function editGroup($id) {
        $_id = $id;
        $id = base64_decode($id);

        $group = $this->groupModel->getGroupId($id);

        $data = [
            'title' => 'Edit Grup',
            'url' => '/groups-man/edit/' . $_id,
            'group' => $group
        ];

        return view('users_management/groups/form', $data);
    }

    public function processEditGroup($id)
    {
        $id = base64_decode($id);

        $dataEdit = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        try {
            $this->groupModel->db->transBegin();
            $this->groupModel->db->table('auth_groups')
                ->where('id', $id)
                ->update($dataEdit);

            if ($this->groupModel->db->transStatus()) {
                $this->groupModel->db->transCommit();
            } else {
                $this->groupModel->db->transRollback();
            }

        } catch (Exception $e) {
            $this->groupModel->db->transRollback();
        }
        return redirect('groups-man');
    }

    public function detailGroup($id)
    {
        $id = base64_decode($id);

        $group = $this->groupModel->getGroupId($id);
        $listUserAtGroup = $this->groupModel->getUsersAtGroup($id);
        
        $data = [
            'title' => "Detail " . $group->name,
            'group_name' => $group->name,
            'group_description' => $group->description,
            'list_user' => $listUserAtGroup
        ];

        return view('users_management/groups/detail', $data);
    }
    
    public function assignUserGroup() {
        $dataForm = $this->request->getPost();
        $user_id = base64_decode($dataForm['user_id']);

        $this->groupModel->removeUserFromAllGroups($user_id);
        $this->groupModel->addUserToGroup($user_id, $dataForm['group_id']);

        return redirect('users-man');
    }
}
