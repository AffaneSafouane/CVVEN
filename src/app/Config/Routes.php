<?php

use App\Controllers\RoomController;
use App\Controllers\ReservationController;
use App\Controllers\Admin\ReservationController as AdminReservationController;
use App\Controllers\Admin\RoomController as AdminRoomController;
use App\Controllers\Admin\UserController as AdminUserController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegister;
use App\Controllers\UserController;
use App\Controllers\Admin\AdminController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes auth
service('auth')->routes($routes, ['except' => ['register']]);

// User (profil)
$routes->get('users/form/(:num)', [UserController::class, 'userForm']);
$routes->put('users/edit/(:num)', [UserController::class, 'edit']);
$routes->delete('users/delete/(:num)', [UserController::class, 'delete']);
$routes->get('users/(:num)', [UserController::class, 'show']);

// Public — Chambres
$routes->get('rooms', [RoomController::class, 'index']);
$routes->get('rooms/(:num)', [RoomController::class, 'show']);
$routes->get('rooms/(:num)/reservation', [RoomController::class, 'newReservation']);
$routes->post('rooms/(:num)/reservation', [RoomController::class, 'submitReservation']);

// Public — Réservations (utilisateur)
$routes->get('reservations', [ReservationController::class, 'index']);
$routes->get('reservations/(:num)', [ReservationController::class, 'show']);
$routes->post('reservations/create', [ReservationController::class, 'create']);
$routes->get('reservations/cancel/(:num)', [ReservationController::class, 'cancel']);
$routes->get('reservations/delete/(:num)', [ReservationController::class, 'delete']);

// Register (Shield, override)
$routes->get('register', [ShieldRegister::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

// Routes admin
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', [AdminController::class, 'dashboard']);

    // Users
    $routes->get('users', [AdminUserController::class, 'index']);
    $routes->put('users/edit/(:num)', [AdminUserController::class, 'edit']);
    $routes->delete('users/delete/(:num)', [AdminUserController::class, 'delete']);
    $routes->get('users/(:num)', [AdminUserController::class, 'show']);

    // Rooms
    $routes->get('rooms', [AdminRoomController::class, 'index']);
    $routes->get('rooms/form', [AdminRoomController::class, 'roomForm']);
    $routes->get('rooms/form/(:num)', [AdminRoomController::class, 'roomForm']);
    $routes->post('rooms/create', [AdminRoomController::class, 'create']);
    $routes->put('rooms/edit/(:num)', [AdminRoomController::class, 'edit']);
    $routes->delete('rooms/delete/(:num)', [AdminRoomController::class, 'delete']);
    $routes->get('rooms/(:num)', [AdminRoomController::class, 'show']);

    // Réservations
    $routes->get('reservations', [AdminReservationController::class, 'index']);
    $routes->post('reservations/confirm/(:num)', [AdminReservationController::class, 'confirm']);
    $routes->post('reservations/cancel/(:num)', [AdminReservationController::class, 'cancel']);
    $routes->delete('reservations/delete/(:num)', [AdminReservationController::class, 'delete']);
    $routes->get('reservations/(:num)', [AdminReservationController::class, 'show']);

    // Admin Auth
    $routes->get('register', [AdminRegisterController::class, 'registerView']);
    $routes->post('register', [AdminRegisterController::class, 'registerAction']);
});

// Test mailpit
$routes->get('test/mail', [\App\Controllers\TestMailpit::class, 'index']);
