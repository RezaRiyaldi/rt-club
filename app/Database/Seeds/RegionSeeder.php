<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Files\File;
use CodeIgniter\Model;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $provincesFile = APPPATH . '/Database/DataWilayah/provinces.csv';
        $regenciesFile = APPPATH . '/Database/DataWilayah/regencies.csv';
        $districtsFile = APPPATH . '/Database/DataWilayah/districts.csv';
        $villagesFile = APPPATH . '/Database/DataWilayah/villages.csv';

        $this->importRegion($provincesFile, 'region_provinces', ['id', 'province']);
        $this->importRegion($regenciesFile, 'region_regencies', ['id', 'province_id', 'regency']);
        $this->importRegion($districtsFile, 'region_districts', ['id', 'regency_id', 'district']);
        $this->importRegion($villagesFile, 'region_villages', ['id', 'district_id', 'village']);
    }

    public function importRegion($file, $table_name, $columns) {
        $file = new File($file);
        $content = $file->openFile('r')->fread($file->getSize());
        $rows = explode("\n", $content);

        $count = 0;
        foreach ($rows as $row) {
            $data = str_getcsv($row);
            
            $rowData = [];

            foreach ($columns as $key => $column) {
                $rowData[$column] = $data[$key] ?? NULL;
            }

            $model = new Model();
            $model->db->table($table_name)->insert($rowData);

            $count++;
        }

        echo "Berhasil import $count data, pada $table_name\n";
    }
}
