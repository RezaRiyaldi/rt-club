<?php
namespace App\Services;

use App\Models\SettingModel;

class SettingService
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function getAllSettings()
    {
        $settings = $this->settingModel->get()->getResult();

        $setting = [];
        foreach ($settings as $set) {
            $setting[$set->keyword] = $set->value;
        }

        return $setting;
    }

    public function getSetting($key)
    {
        return $this->settingModel->where('keyword', $key)->first()->value;
    }

    public function setSetting($key, $value)
    {
        $this->settingModel->updateOrCreate(['keyword' => $key], ['value' => $value]);
    }
}
