<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard-keuangan', 'Home::getKeuangan');

$routes->get('/setting-self', 'SettingController::settingSelf');
$routes->post('/setting-self', 'SettingController::processSettingSelf');

// SETTINGS MANAGEMENT
$routes->group('/settings-man', ['filter' => 'role:Superadmin'], function ($routes) {
    $routes->get('', 'SettingController::index');
    $routes->post('', 'SettingController::setSettings');
    // $routes->post('get_list', 'UsersController::getListUsers');

    // $routes->get('add', 'UsersController::addUser');
    // $routes->post('add', 'UsersController::processAddUser');
    
    // $routes->get('detail/(:any)', 'UsersController::detailUser/$1');

    // $routes->get('edit/(:any)', 'UsersController::editUser/$1');
    // $routes->post('edit', 'UsersController::processEditUser');
});

// USERS MANAGEMENT
$routes->group('/users-man', function ($routes) {
    $routes->get('', 'UsersController::userManagement');
    $routes->post('get_list', 'UsersController::getListUsers');

    $routes->get('add', 'UsersController::addUser', ['filter' => 'role:Superadmin, Ketua RT']);
    $routes->post('add', 'UsersController::processAddUser', ['filter' => 'role:Superadmin, Ketua RT']);
    
    $routes->get('detail/(:any)', 'UsersController::detailUser/$1');

    $routes->get('edit/(:any)', 'UsersController::editUser/$1', ['filter' => 'role:Superadmin, Ketua RT']);
    $routes->post('edit', 'UsersController::processEditUser', ['filter' => 'role:Superadmin, Ketua RT']);

    $routes->post('check_data_user', 'UsersController::checkDuplicate');
    $routes->post('setting-account', 'SettingController::processSettingSelf');
});

// GROUPS MANAGEMENT
$routes->group('/groups-man', ['filter' => 'role:Superadmin, Ketua RT'], function($routes) {
    $routes->get('', 'GroupController::index');
    $routes->post('get_list', 'GroupController::getListGroups');
    
    $routes->get('add', 'GroupController::addGroup');
    $routes->post('add', 'GroupController::processAddGroup');

    $routes->get('detail/(:any)', 'GroupController::detailGroup/$1');

    $routes->get('edit/(:any)', 'GroupController::editGroup/$1');
    $routes->post('edit/(:any)', 'GroupController::processEditGroup/$1');

    $routes->post('assign', 'GroupController::assignUserGroup');
});

// IURAN
$routes->group('/iuran', function($routes) {
    $routes->get('', 'IuranController::index');
    $routes->post('get_list', 'IuranController::getListIurans');

    $routes->get('add', 'IuranController::addIuran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('add', 'IuranController::processAddIuran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->get('edit/(:any)', 'IuranController::editIuran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('edit/(:any)', 'IuranController::processEditIuran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->post('delete/(:any)/(:any)', 'IuranController::processDeleteIuran/$1/$2', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->get('detail/(:any)/(:any)', 'IuranController::detailIuran/$1/$2');

    $routes->get('type', 'IuranController::iuranType', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('type/add', 'IuranController::processAddTypeIuran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->get('type/get-detail', 'IuranController::getDetailTypeIuran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('type/edit/(:any)', 'IuranController::processEditTypeIuran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
});

$routes->group('/pengeluaran', function($routes) {
    $routes->get('', 'PengeluaranController::index');
    $routes->post('get_list', 'PengeluaranController::getListPengeluaran');

    // $routes->get('add', 'PengeluaranController::addIuran');
    $routes->post('add', 'PengeluaranController::processAddPengeluaran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->get('edit/(:any)', 'PengeluaranController::getPengeluaran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('edit/(:any)', 'PengeluaranController::processEditPengeluaran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    
    $routes->post('delete/(:any)', 'PengeluaranController::processDeletePengeluaran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->get('detail/(:any)', 'PengeluaranController::detailPengeluaran/$1');

    $routes->get('type', 'PengeluaranController::iuranType', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('type/add', 'PengeluaranController::processAddTypeIuran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);

    $routes->get('type/get-detail', 'PengeluaranController::getDetailTypeIuran', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
    $routes->post('type/edit/(:any)', 'PengeluaranController::processEditTypeIuran/$1', ['filter' => 'role:Superadmin, Ketua RT, Bendahara, Sekretaris']);
});

// GET REGIONS
$routes->group('/get-region', function($routes) {
    $routes->get('provinces', 'RegionController::getProvinces');
    $routes->get('regencies/(:any)', 'RegionController::getRegencies/$1');
    $routes->get('districts/(:any)', 'RegionController::getDistricts/$1');
    $routes->get('villages/(:any)', 'RegionController::getVillages/$1');
});

// ERROR
$routes->get('/not-permission', 'Home::not_permission');