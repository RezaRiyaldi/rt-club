<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settingService = service('setting');
        $settingService->setSetting('application_name', 'K - Sakti');
    }
}
