<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

use App\Controllers\UserController;
use App\Controllers\Pages;

$routes->get('users', [UserController::class, 'index']);
$routes->get('users/new', [UserController::class, 'new']);
$routes->post('users', [UserController::class, 'create']);
$routes->get('users/(:segment)', [UserController::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
