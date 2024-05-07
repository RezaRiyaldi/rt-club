<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// SETTINGS MANAGEMENT
$routes->group('/settings-man', function ($routes) {
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

    $routes->get('add', 'UsersController::addUser');
    $routes->post('add', 'UsersController::processAddUser');
    
    $routes->get('detail/(:any)', 'UsersController::detailUser/$1');

    $routes->get('edit/(:any)', 'UsersController::editUser/$1');
    $routes->post('edit', 'UsersController::processEditUser');
});

// GROUPS MANAGEMENT
$routes->group('/groups-man', function($routes) {
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

    $routes->get('add', 'IuranController::addIuran');
    $routes->post('add', 'IuranController::processAddIuran');

    $routes->get('edit/(:any)', 'IuranController::editIuran/$1');
    $routes->post('edit/(:any)', 'IuranController::processEditIuran/$1');

    $routes->get('detail/(:any)/(:any)', 'IuranController::detailIuran/$1/$2');

    $routes->get('type', 'IuranController::iuranType');
    $routes->post('type/add', 'IuranController::processAddTypeIuran');

    $routes->get('type/get-detail', 'IuranController::getDetailTypeIuran');
    $routes->post('type/edit/(:any)', 'IuranController::processEditTypeIuran/$1');
});

// GET REGIONS
$routes->group('/get-region', function($routes) {
    $routes->get('provinces', 'RegionController::getProvinces');
    $routes->get('regencies/(:any)', 'RegionController::getRegencies/$1');
    $routes->get('districts/(:any)', 'RegionController::getDistricts/$1');
    $routes->get('villages/(:any)', 'RegionController::getVillages/$1');
});