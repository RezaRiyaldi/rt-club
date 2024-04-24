<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Model;

class RegionController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function getProvinces()
    {
        $provinces = $this->model->db->table('region_provinces')->get()->getResult();

        echo json_encode($provinces);
    }

    public function getRegencies($province_id)
    {
        $regencies = $this->model->db->table('region_regencies')
            ->where('province_id', $province_id)
            ->get()->getResult();

        echo json_encode($regencies);
    }

    public function getDistricts($regencies_id)
    {
        $districts = $this->model->db->table('region_districts')
            ->where('regency_id', $regencies_id)
            ->get()->getResult();

        echo json_encode($districts);
    }

    public function getVillages($district_id)
    {
        $villages = $this->model->db->table('region_villages')
            ->where('district_id', $district_id)
            ->get()->getResult();

        echo json_encode($villages);
    }
}
