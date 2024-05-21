<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table            = 'pengeluarans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pengeluaran', 'description', 'nominal', 'periode', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPengeluarans($params) {
        $builder = $this->table($this->table);        

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
            $builder = $builder->orderBy('periode', 'asc');
        }

        return $builder->get()->getResult();
    }
}
