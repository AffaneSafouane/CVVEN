<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//use App\Controllers\UserController;

service('auth')->routes($routes);

//$routes->get('admin/users', [UserController::class, 'index']);
//$routes->get('users/(:segment)', [UserController::class, 'show']);
