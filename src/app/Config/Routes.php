<?php

use App\Controllers\Admin\ReservationController as AdminReservationController;
use App\Controllers\Admin\RoomController as AdminRoomController;
use App\Controllers\Admin\UserController as AdminUserController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegister;
use App\Controllers\RoomController;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\ReservationController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes auth
service('auth')->routes($routes, ['except' => ['register']]); // Routes Shield
// @TODO Ajouter les routes pour la suppression et la mise à jour de l'utilisateur (post)
$routes->get('users/(:segment)', [UserController::class, 'show']);
$routes->get('register', [ShieldRegister::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

// Routes Reservations
// @TODO Ajouter les routes pour les réservations
$routes->get('rooms', [RoomController::class, 'index']);
$routes->get('rooms/(:segment)', [RoomController::class, 'show']);
$routes->get('rooms/new/(:segment)', [RoomController::class, 'new']);
$routes->post('reservations/create', [ReservationController::class, 'create']);

// Routes admin
$routes->get('admin/users', [AdminUserController::class, 'index']);

$routes->get('admin/rooms', [AdminRoomController::class, 'index']);
$routes->get('admin/rooms/(:segment)', [AdminRoomController::class, 'show']);

$routes->get('admin/reservations', [ReservationController::class, 'index']);

$routes->get('admin/register', [AdminRegisterController::class, 'registerView']);
$routes->post('admin/register', [AdminRegisterController::class, 'registerAction']);

// Test mailpit
$routes->get('test/mail', [\App\Controllers\TestMailpit::class, 'index']);
