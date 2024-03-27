<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users-man', 'UsersController::userManagement');
$routes->post('/users-man/get_list', 'UsersController::getListUsers');
$routes->get('/users-man/add', 'UsersController::addUser');
$routes->post('/users-man/add', 'UsersController::processAddUser');
