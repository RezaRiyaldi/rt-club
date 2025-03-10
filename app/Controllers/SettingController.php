<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel2;
use CodeIgniter\Model;
use CodeIgniter\Validation\Exceptions\ValidationException;

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

    public function setSettings()
    {
        $requests = $this->request->getPost();

        foreach ($requests as $key => $val) {
            service('setting')->setSetting($key, $val);
        }

        return redirect('settings-man')->with('message', 'Setting Aplikasi Berhasil');
    }

    public function settingSelf()
    {
        $id = user()->id;

        $userModel = new UserModel2();
        $user = $userModel->find($id);

        $data = [
            'user' => $user
        ];

        return view('setting/self', $data);
    }

    public function processSettingSelf()
    {
        $type = 'message';
        $message = 'Unknown';

        $post = $this->request->getPost();

        $id = user()->id;

        if (isset($post['user_id_account'])) {
            $id = base64_decode($post['user_id_account']);
        }

        $userModel = new UserModel2();
        $validation = \Config\Services::validation();

        $dataUpdate = [];
        $dataUpdate['email'] = $post['email'];
        $dataUpdate['username'] = $post['username'];

        $rules = [
            'username' => "required|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'email' => "valid_email|is_unique[users.email,id,{$id}]",
        ];

        if (!empty($post['password'])) {
            $dataUpdate['password_hash'] = password_hash(
                base64_encode(
                    hash('sha384', $post['password'], true)
                ),
                PASSWORD_DEFAULT
            );
            $dataUpdate['password'] = $post['password'];
            $dataUpdate['repassword'] = $post['repassword'];

            $rules['password'] = 'required|min_length[2]';
            $rules['repassword'] = 'matches[password]';
        }

        $validation->setRules($rules);

        try {
            // Melakukan validasi
            if ($validation->run($dataUpdate)) {
                $userModel->update($id, $dataUpdate);
                $message = 'Berhasil setting akun';
            } else {
                $errors = $validation->getErrors();

                $message = implode('<br>', $errors);
                $type = 'error';

                if (!isset($post['user_id_account'])) {
                    return redirect()->to('setting-self')->with($type, $message);
                }
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $type = 'error';
        }

        if (isset($post['user_id_account'])) {
            return redirect()->to('users-man')->with($type, $message);
        }

        return redirect()->to('/')->with($type, $message);
    }
}
