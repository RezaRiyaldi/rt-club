<?php

namespace App\Models;

use Myth\Auth\Models\UserModel;

class UserModel2 extends UserModel
{
    protected $validationRules = [
        // 'email'         => 'valid_email|is_unique[users.email,id,{id}]',
        // 'username'      => 'required|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        // 'password_hash' => 'required',
    ];

    public function getUsers($params = [])
    {
        $builder = $this->table($this->table);
        $builder = $builder->select('w.*, w.id as warga_id, users.id as id_user, users.email, users.username, users.created_at as joined, ag.name as jabatan');
        $builder = $builder->join('wargas w', 'w.user_id = users.id', 'left');
        $builder = $builder->join('auth_groups_users agus', 'agus.user_id = users.id', 'left');
        $builder = $builder->join('auth_groups ag', 'ag.id = agus.group_id', 'left');

        if (!empty($params['search'])) {
            if (!empty($params['columns'])) {
                foreach ($params['columns'] as $column) {
                    if ($column['searchable'] == "true") {
                        $field = $this->getAliasColumn($column['data']);
                        $builder = $builder->orLike($field, $params['search']);
                    }
                }
            }
        }

        if ((isset($params['start']) && $params['start'] > 0) or (isset($params['length']) && $params['length'] > 0)) {
            $builder = $builder->limit($params['length'], $params['start']);
        }

        if (isset($params['order']) && $params['order'][0]['column'] != 0) {
            foreach ($params['order'] as $order) {
                if ($params['columns'][$order['column']]['orderable'] == "true") {
                    $builder = $builder->orderBy($params['columns'][$order['column']]['data'], $order['dir']);
                }
            }
        } else {
            $builder = $builder->orderBy('w.no_kk', 'asc');
            $builder = $builder->orderBy('FIELD(w.status_family, "Kepala Keluarga", "Istri", "Anak", "Lainnya")');
        }
        return $builder->get()->getResult();
    }

    public function getAliasColumn($column)
    {
        if ($column == 'jabatan') {
            $column = 'ag.name';
        } elseif ($column == 'joined') {
            $column = 'users.created_at';
        }

        return $column;
    }

    public function getUserById($id) {
        $builder = $this->db->table('users')
            ->join('wargas w', 'w.user_id = users.id', 'left')
            ->where('users.id', $id)
            ->get()->getRow();

        return $builder;
    }

    public function getUserByKK($kk)
    {
        $builder = $this->db->table('wargas')
            ->where('wargas.no_kk', $kk)
            ->get()->getResult();

        return $builder;
    }
}
