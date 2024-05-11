<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/setting-self', 'settingController::settingSelf');
$routes->post('/setting-self', 'settingController::processSettingSelf');

// SETTINGS MANAGEMENT
$routes->group('/settings-man', ['filter' => 'role:Superadmin'], function ($routes) {
    $routes->get('', 'settingController::index');
    $routes->post('', 'settingController::setSettings');
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

    $routes->get('add', 'IuranController::addIuran', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);
    $routes->post('add', 'IuranController::processAddIuran', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);

    $routes->get('edit/(:any)', 'IuranController::editIuran/$1', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);
    $routes->post('edit/(:any)', 'IuranController::processEditIuran/$1', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);

    $routes->get('detail/(:any)/(:any)', 'IuranController::detailIuran/$1/$2');

    $routes->get('type', 'IuranController::iuranType', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);
    $routes->post('type/add', 'IuranController::processAddTypeIuran', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);

    $routes->get('type/get-detail', 'IuranController::getDetailTypeIuran', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);
    $routes->post('type/edit/(:any)', 'IuranController::processEditTypeIuran/$1', ['filter' => 'role:Superadmin, Ketua RT', 'Bendahara']);
});

$routes->group('/pengeluaran', function($routes) {
    $routes->get('', 'PengeluaranController::index');
    $routes->post('get_list', 'PengeluaranController::getListPengeluaran');

    // $routes->get('add', 'PengeluaranController::addIuran');
    $routes->post('add', 'PengeluaranController::processAddPengeluaran');

    $routes->get('edit/(:any)', 'PengeluaranController::getPengeluaran/$1');
    $routes->post('edit/(:any)', 'PengeluaranController::processEditPengeluaran/$1');

    $routes->get('detail/(:any)/(:any)', 'PengeluaranController::detailIuran/$1/$2');

    $routes->get('type', 'PengeluaranController::iuranType');
    $routes->post('type/add', 'PengeluaranController::processAddTypeIuran');

    $routes->get('type/get-detail', 'PengeluaranController::getDetailTypeIuran');
    $routes->post('type/edit/(:any)', 'PengeluaranController::processEditTypeIuran/$1');
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