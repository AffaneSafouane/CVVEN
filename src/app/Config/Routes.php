<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

use App\Controllers\Clients;
use App\Controllers\Pages;

$routes->get('clients', [Clients::class, 'index']);
$routes->get('clients/new', [Clients::class, 'new']);
$routes->post('clients', [Clients::class, 'create']);
$routes->get('clients/(:segment)', [Clients::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
