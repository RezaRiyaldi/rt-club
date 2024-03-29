<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Models\GroupModel;

class GroupModel2 extends GroupModel
{
    public function getGroups($params = [])
    {
        $builder = $this->table($this->table);

        if (!empty($params['search'])) {
            if (!empty($params['columns'])) {
                foreach ($params['columns'] as $column) {
                    if ($column['searchable'] == "true") {
                        $builder = $builder->orLike($column['data'], $params['search']);
                    }
                }
            }
        }

        if ((isset($params['start']) && $params['start'] > 0) or (isset($params['length']) && $params['length'] > 0)) {
            $builder = $builder->limit($params['length'], $params['start']);
        }

        if (isset($params['order']) && $params['columns'][0]['orderable'] == "true") {
            foreach ($params['order'] as $order) {
                if ($params['columns'][$order['column']]['orderable'] == "true") {
                    $builder = $builder->orderBy($params['columns'][$order['column']]['data'], $order['dir']);
                }
            }
        } else {
            $builder = $builder->orderBy('name', 'asc');
        }
        return $builder->get()->getResult();
    }

    public function getGroupId($id) {
        $group = $this->db->table('auth_groups')->where('id', $id)->get()->getRow();
        return $group;
    }

    public function getUsersAtGroup($id)
    {
        $users = $this->db
            ->table('auth_groups_users')
            ->select('users.username, users.email, users.active, wargas.user_id, wargas.fullname, auth_groups.name as group_name, auth_groups.description')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left')
            ->join('users', 'users.id = auth_groups_users.user_id', 'left')
            ->join('wargas', 'wargas.user_id = users.id', 'left')
            ->where('auth_groups.id', $id)
            ->get()->getResult();

        return $users;
    }
}
