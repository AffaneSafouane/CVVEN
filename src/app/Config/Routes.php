<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes, ['except' => ['register']]);

use App\Controllers\UserController;
use App\Controllers\Auth\RegisterController;

//$routes->get('admin/users', [UserController::class, 'index']);
$routes->get('users/(:segment)', [UserController::class, 'show']);
$routes->get('register', [RegisterController::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);
