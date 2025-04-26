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
// @TODO Ajouter les routes pour les réservations et les chambres

// Routes admin
$routes->group('admin', function ($routes) {
    // Users
    $routes->get('users', [AdminUserController::class, 'index']);
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

    // Admin User
    $routes->get('register', [AdminRegisterController::class, 'registerView']);
    $routes->post('register', [AdminRegisterController::class, 'registerAction']);
});

// Test mailpit
$routes->get('test/mail', [\App\Controllers\TestMailpit::class, 'index']);
