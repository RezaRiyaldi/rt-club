<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

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

