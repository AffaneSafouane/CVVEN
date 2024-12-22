<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

use App\Controllers\UserController;
use App\Controllers\Pages;

$routes->get('user', [UserController::class, 'index']);
$routes->get('user/new', [UserController::class, 'new']);
$routes->post('user', [UserController::class, 'create']);
$routes->get('user/(:segment)', [UserController::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
