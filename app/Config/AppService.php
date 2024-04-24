<?php

namespace Config;

use App\Services\SettingService;
use CodeIgniter\Config\BaseService;

class AppService extends BaseService
{
    public static function setting($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('setting');
        }

        return new SettingService();
    }
}
