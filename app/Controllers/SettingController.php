<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SettingController extends BaseController
{
    public function index()
    {
        $settings = service('setting')->getAllSettings();

        $data = [
            'settings' => $settings
        ];

        return view('setting/index', $data);
    }

    public function setSettings() {
        $requests = $this->request->getPost();

        foreach ($requests as $key => $val) {
            service('setting')->setSetting($key, $val);
        }

        return redirect('settings-man')->with('message', 'Setting Aplikasi Berhasil');
    }
}
