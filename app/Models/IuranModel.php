<?php

namespace App\Models;

use CodeIgniter\Model;

class IuranModel extends Model
{
    protected $table            = 'iurans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'type_id', 'warga_id', 'nominal', 'payment_method', 'bukti_bayar', 'description', 'created_by', 'updated_by', 'periode'
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

    public function getIurans($params = []) {
        $builder = $this->table($this->table);
        $builder = $builder->select('iurans.*, it.type, w.fullname, u.id as user_id');
        $builder = $builder->select("MONTH(periode) as bulan, YEAR(periode) as tahun");
        $builder = $builder->selectSum('iurans.nominal');

        $builder = $builder->join('iuran_type it', 'it.id = iurans.type_id', 'inner');
        $builder = $builder->join('wargas w', 'w.id = iurans.warga_id', 'inner');
        $builder = $builder->join('users u', 'u.id = w.user_id', 'inner');
        $builder = $builder->groupBy(['iurans.warga_id', 'bulan', 'tahun']);

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

    public function getAliasColumn($column)
    {
        if ($column == 'date') {
            $column = 'iurans.created_at';
        }

        return $column;
    }
}
