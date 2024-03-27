<?php
namespace App\Models;

use Myth\Auth\Models\UserModel;

class UserModel2 extends UserModel {
    public function getUsers($params = []) {
        $builder = $this->table($this->table);
        $builder = $builder->select('w.*, users.email, users.username, users.active as status, users.created_at as joined');
        $builder = $builder->join('wargas w', 'w.user_id = users.id', 'left');

        if (!empty($params['search'])) {
            if (!empty($params['columns'])) {
                foreach ($params['columns'] as $column) {
                    if ($column['searchable'] == "true") {
                        $builder = $builder->orLike($column['data'], $params['search']);
                    }
                }
            }
        }

        if ((isset($params['start']) && $params['start'] > 0) OR (isset($params['length']) && $params['length'] > 0)) {
            $builder = $builder->limit($params['length'], $params['start']);
        }

        if (isset($params['order'])) {
            foreach ($params['order'] as $order) {
                if ($params['columns'][$order['column']]['orderable'] == "true") {
                    $builder = $builder->orderBy($params['columns'][$order['column']]['data'], $order['dir']);
                }
            } 
        }
        return $builder->get()->getResult();
    }
}