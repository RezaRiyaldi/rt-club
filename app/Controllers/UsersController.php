<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupModel2;
use App\Models\UserModel2;
use App\Models\WargaModel;
use Config\Database;

// use function App\Helpers\generateInput;

class UsersController extends BaseController
{
    public $userModel;
    public $groupModel;
    public $wargaModel;

    public function __construct()
    {
        $this->userModel = new UserModel2();
        $this->groupModel = new GroupModel2();
        $this->wargaModel = new WargaModel();
    }

    public function userManagement()
    {
        $groups = $this->groupModel->getGroups();

        $data = [
            'groups' => $groups
        ];

        return view('users_management/index', $data);
    }

    public function getListUsers()
    {
        $post = (object) $this->request->getPost();

        $param = [];
        $param['draw'] = $post->draw != NULL ? $post->draw : '';
        $param['start'] = $post->start != NULL ? $post->start : '';
        $param['length'] = $post->length != NULL ? $post->length : '';
        $param['search'] = $post->search['value'] != NULL ? $post->search['value'] : '';
        $param['columns'] = $post->columns;
        $param['order'] = $post->order;

        $data = $this->userModel->getUsers($param);

        $arr = [];
        $no = $param['start'] + 1;
        foreach ($data as $d) {
            $d = (array) $d;
            $d['no'] = $no++;
            $d['no_rumah'] = !empty($d['blok']) ? $d['blok'] : '-';
            $d['no_hp'] = !empty($d['phone']) ? $d['phone'] : '-';

            $d['joined'] = date('H:s, d M Y', strtotime($d['joined']));

            $d['jabatan'] = $d['jabatan'] ?? '-';

            $actions = [];

            if (isset($d['no_kk']) && ($d['id_user'] == user()->id || in_groups(['Superadmin', 'Ketua RT', 'Bendahara', 'Sekretaris']))) {
                $actions[] = '<a href="' . base_url('users-man/detail/' . base64_encode($d['no_kk'])) . '" class="btn btn-secondary btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Detail User"><i class="fas fa-eye"></i></a>';
            }

            if (in_groups(['Superadmin', 'Ketua RT'])) {
                $actions[] = '<a href="' . base_url('/users-man/edit/' . base64_encode($d['no_kk'])) . '" class="btn btn-warning btn-sm px-2 py-1 me-1 mb-0 btn-edit" data-toggle="tooltip" title="Edit User"><i class="fas fa-pen"></i></a>';
                $actions[] = '<button style="background-color: orangered" class="btn btn-sm text-light px-2 py-1 me-1 mb-0 assign-group" data-id="' . base64_encode($d['id_user']) . '" data-fullname="' . $d['fullname'] . '" data-username="' . $d['username'] . '" data-toggle="tooltip" title="Masukan ke Grup"><i class="fas fa-link"></i></button>';
                $actions[] = '<button class="btn btn-sm btn-primary px-2 py-1 mb-0 edit-account" data-id="' . base64_encode($d['id_user']) . '" data-email="' . $d['email'] . '" data-username="' . $d['username'] . '" data-toggle="tooltip" title="Edit akun user"><i class="fas fa-user-edit"></i></button>';
            }

            $d['action'] = implode('', $actions);
            $arr[] = $d;
        }

        $total_count_all = count($this->userModel->getUsers($param['search']));

        $res = [
            'draw' => intval($param['draw']),
            'recordsTotal' => $total_count_all,
            'recordsFiltered' => $total_count_all,
            'data' => $arr
        ];


        $res = json_encode($res);

        echo $res;
    }

    public function addUser()
    {
        $setting = service('setting');
        $settings = $setting->getAllSettings();

        $data = [
            'title' => 'Tambah User',
            'url' => '/users-man/add',
            'family' => NULL,
            'settings' => $settings,
        ];

        return view('users_management/form', $data);
    }

    public function processAddUser()
    {
        $type = "";
        $message = "";
        $setting = service('setting');

        $dataForm = $this->request->getPost();
        $keys = array_keys($dataForm);

        $data = [];
        for ($i = 0; $i < count($dataForm['no_ktp']); $i++) {
            foreach ($keys as $key) {
                $field = $dataForm[$key];
                if (is_array($field)) {
                    $data[$i][$key] = $field[$i] ?? NULL;
                } else {
                    $data[$i][$key] = $field;
                }
            }
        }

        $db = Database::connect();
        $db->transBegin();

        try {
            $rt = $rw = $blok = $email = $fullnameKepala = NULL;
            foreach ($data as $d) {
                $userId = NULL;

                if ($d['status_family'] == "Kepala Keluarga") {
                    $rt = $d['rt'];
                    $rw = $d['rw'];
                    $blok = $d['blok'] . $d['blok_number'] . " No " . $d['home_number'];
                    $username = $d['blok'] . $d['blok_number'] . "/" . $d['home_number'];
                    $email = $d['email'];
                    $fullnameKepala = $d['fullname'];
                    $d['blok'] = $blok;

                    $password = password_hash(
                        base64_encode(
                            hash('sha384', strtolower($username), true)
                        ),
                        PASSWORD_DEFAULT
                    );

                    // INSERT USER
                    $insert_user = [];
                    $insert_user['username'] = $username;
                    $insert_user['email'] = !empty($d['email']) ? $d['email'] : NULL;
                    $insert_user['active'] = 1;
                    $insert_user['password_hash'] = $password;

                    $userId = $this->userModel->insert($insert_user);

                    $this->groupModel->addUserToGroup($userId, 3); // WARGA
                } else {
                    $d['blok'] = $blok;
                }

                $d['address'] = json_encode([
                    'alamat' => $setting->getSetting('perum_name') . ' Blok ' . $blok,
                    'provinsi' => 'JAWA BARAT',
                    'kota' => 'KABUPATEN BEKASI',
                    'kecamatan' => 'CIBITUNG',
                    'kelurahan' => 'KERTAMUKTI',
                    'kode_pos' => 17520,
                    'rt' => str_pad($rt, 3, "0", STR_PAD_LEFT),
                    'rw' => str_pad($rw, 3, "0", STR_PAD_LEFT),
                ]);

                $d['created_by'] = $d['updated_by'] = user()->id;

                // INSERT WARGA
                unset($d['csrf_test_name']);
                unset($d['rt']);
                unset($d['rw']);
                unset($d['blok_number']);
                unset($d['home_number']);

                $insert_warga = [];
                $insert_warga['user_id'] = $userId;
                foreach ($d as $key => $val) {
                    $insert_warga[$key] = $val;
                }

                $this->wargaModel->insert($insert_warga);
            }

            if ($db->transStatus()) {
                $db->transCommit();
                $type = "message";

                $email = !empty($email) ? $email : '-';
                $message = "Berhasil menambahkan users!!<br>
                            <h5>Informasi Akun untuk keperluan Login:</h5>
                            <ul>
                                <li>Fullname: $fullnameKepala</li>
                                <li>Email: $email</li>
                                <li>Username: $username</li>
                                <li>Password: " . strtolower($username) . "</li>
                            </ul>
                            <i>Mohon informasikan akun ini kepada warga terkait.</i>";
            } else {
                $db->transRollback();
                $type = "error";
                $message = "Gagal menambahkan users";
            }
        } catch (\Exception $e) {
            // dd($e);
            $db->transRollback();

            $type = "errors";
            $message = $e;
        }

        return redirect('users-man')->with($type, $message);
    }

    public function detailUser($kk)
    {
        $kk = base64_decode($kk);

        // $db = Database::connect();

        $family = $this->userModel->getUserByKK($kk);
        $leadFamily = $family[0];
        $leadAddress = json_decode($leadFamily->address);
        $userRTs = $this->groupModel->getUsersForGroup(2);

        $idKetuaRTs = [];
        foreach ($userRTs as $userRT) {
            $idKetuaRTs[] = $userRT['id'];
        }

        $ketuaRTs = $this->wargaModel->select('fullname')
            ->whereIn('user_id', $idKetuaRTs)
            ->get()->getResultArray();

        $namaKetuaRTs = array_column($ketuaRTs, 'fullname');

        $ketuaRT = implode(', ', $namaKetuaRTs);

        $data = [
            'lead_family' => $leadFamily,
            'lead_address' => $leadAddress,
            'family' => $family,
            'no_kk' => $kk,
            'ketua_rt' => $ketuaRT
        ];

        return view('users_management/detail', $data);
    }

    public function editUser($noKK)
    {
        $noKK = base64_decode($noKK);

        $setting = service('setting');
        $settings = $setting->getAllSettings();

        $family = $this->userModel->getUserByKK($noKK);

        foreach ($family as $member) {
            $member->address = null;
        }

        $data = [
            'title' => 'Edit User',
            'url' => '/users-man/edit',
            'settings' => $settings,
            'family' => json_encode($family)
        ];

        return view('users_management/form', $data);
    }

    public function processEditUser()
    {
        $type = "";
        $message = "";
        $setting = service('setting');

        $dataForm = $this->request->getPost();
        $keys = array_keys($dataForm);

        $data = [];
        foreach ($dataForm['no_ktp'] as $i => $no_ktp) {
            foreach ($keys as $key) {
                $data[$i][$key] = is_array($dataForm[$key]) ? $dataForm[$key][$i] ?? NULL : $dataForm[$key];
            }
        }

        $db = Database::connect();
        $db->transBegin();

        try {
            $rt = $rw = $blok = NULL;

            $existingIds = array_column($this->wargaModel->select('id')->where('no_kk', $dataForm['no_kk'])->findAll(), 'id');
            $newIds = [];
            foreach ($data as $d) {
                if (isset($d['id']) && !empty($d['id'])) {
                    $newIds[] = $d['id'];
                    if ($d['status_family'] == "Kepala Keluarga") {
                        $rt = $d['rt'];
                        $rw = $d['rw'];
                        $blok = $d['blok'] . $d['blok_number'] . " No " . $d['home_number'];
                        $d['blok'] = $blok;

                        $user_id = $this->wargaModel->select('user_id')->find($d['id'])->user_id;
                        $this->userModel->update($user_id, ['email' => $d['email']]);
                    } else {
                        $d['blok'] = $blok;
                    }

                    $d['address'] = json_encode([
                        'alamat' => $setting->getSetting('perum_name') . ' Blok ' . $blok,
                        'provinsi' => 'JAWA BARAT',
                        'kota' => 'KABUPATEN BEKASI',
                        'kecamatan' => 'CIBITUNG',
                        'kelurahan' => 'KERTAMUKTI',
                        'kode_pos' => 17520,
                        'rt' => str_pad($rt, 3, "0", STR_PAD_LEFT),
                        'rw' => str_pad($rw, 3, "0", STR_PAD_LEFT),
                    ]);

                    $d['updated_by'] = user()->id;

                    unset($d['csrf_test_name'], $d['rt'], $d['rw'], $d['blok_number'], $d['home_number']);
                    $this->wargaModel->update( $d['id'], $d);

                } else {
                    unset($d['id']);
                    $d['created_by'] = $d['updated_by'] = user()->id;

                    $d['address'] = json_encode([
                        'alamat' => $setting->getSetting('perum_name') . ' Blok ' . $d['blok'],
                        'provinsi' => 'JAWA BARAT',
                        'kota' => 'KABUPATEN BEKASI',
                        'kecamatan' => 'CIBITUNG',
                        'kelurahan' => 'KERTAMUKTI',
                        'kode_pos' => 17520,
                        'rt' => str_pad($d['rt'], 3, "0", STR_PAD_LEFT),
                        'rw' => str_pad($d['rw'], 3, "0", STR_PAD_LEFT),
                    ]);

                    unset($d['csrf_test_name'], $d['rt'], $d['rw'], $d['blok_number'], $d['home_number']);
                    $newIds[] = $this->wargaModel->insert($d);
                }
            }

            $idsToDelete = array_diff($existingIds, $newIds);
            if (!empty($idsToDelete)) {
                $this->wargaModel->whereIn('id', $idsToDelete)->delete();
            }

            if ($db->transStatus()) {
                $db->transCommit();
                $type = "message";
                $message = "Berhasil edit users";
            } else {
                $db->transRollback();
                $type = "error";
                $message = "Gagal edit users";
            }
        } catch (\Exception $e) {
            $db->transRollback();
            $type = "errors";
            $message = $e;
        }

        return redirect('users-man')->with($type, $message);
    }

    public function checkDuplicate()
    {
        $post = $this->request->getPost();

        $blokUsed = $this->wargaModel->where('blok', $post['blok'])
            ->whereNotIn('no_kk', [$post['no_kk']])
            ->first();

        // $nikUsed = $this->wargaModel->where('nik', $post['nik'])
        //     ->whereNotIn('no_kk', [$post['no_kk']])
        //     ->first();

        $response = [
            'status' => 'success',
            'blokNotUsed' => $blokUsed === null
        ];

        return $this->response->setJSON($response);
    }
}
