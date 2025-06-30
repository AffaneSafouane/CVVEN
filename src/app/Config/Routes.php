<?php

use App\Controllers\LoginController;
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
use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;
use App\Controllers\CommentController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication (Shield)
service('auth')->routes($routes, ['except' => ['register', 'login']]);
$routes->get('login', [ShieldLoginController::class, 'loginView']);
$routes->post('login', [LoginController::class, 'loginAction']);

// User profile
$routes->get('users/form/(:num)', [UserController::class, 'userForm']);
$routes->put('users/edit/(:num)', [UserController::class, 'edit']);
$routes->delete('users/delete/(:num)', [UserController::class, 'delete']);
$routes->get('users/(:num)', [UserController::class, 'show']);

// Public — Rooms
$routes->get('rooms', [RoomController::class, 'index']);
$routes->get('rooms/(:num)', [RoomController::class, 'show']);
$routes->get('rooms/(:num)/reservation', [RoomController::class, 'newReservation']);
$routes->post('rooms/(:num)/reservation', [RoomController::class, 'submitReservation']);

// Public — Reservations (user)
$routes->get('reservations', [ReservationController::class, 'index']);
$routes->get('reservations/(:num)', [ReservationController::class, 'show']);
$routes->get('reservations/confirm', [ReservationController::class, 'confirm']);
$routes->post('reservations/create', [ReservationController::class, 'create']);
$routes->get('reservations/cancel/(:num)', [ReservationController::class, 'cancel']);
$routes->get('reservations/delete/(:num)', [ReservationController::class, 'delete']);

$routes->get('comments/index/(:num)', [CommentController::class, 'index']);
$routes->post('comments/create/(:num)', [CommentController::class, 'create']);
$routes->get('comments/form/(:num)', [CommentController::class, 'form']);

// Registration (override Shield)
$routes->get('register', [ShieldRegister::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

// Admin group
$routes->group('admin', function ($routes) {
    // Dashboard
    $routes->get('dashboard', [AdminController::class, 'dashboard']);

    // Admin — Users
    $routes->get('users', [AdminUserController::class, 'index']);
    $routes->put('users/edit/(:num)', [AdminUserController::class, 'edit']);
    $routes->delete('users/delete/(:num)', [AdminUserController::class, 'delete']);
    $routes->get('users/(:num)', [AdminUserController::class, 'show']);

    // Admin — Rooms
    $routes->get('rooms', [AdminRoomController::class, 'index']);
    $routes->get('rooms/form', [AdminRoomController::class, 'roomForm']);
    $routes->get('rooms/form/(:num)', [AdminRoomController::class, 'roomForm']);
    $routes->post('rooms/create', [AdminRoomController::class, 'create']);
    $routes->put('rooms/edit/(:num)', [AdminRoomController::class, 'edit']);
    $routes->delete('rooms/delete/(:num)', [AdminRoomController::class, 'delete']);
    $routes->get('rooms/(:num)', [AdminRoomController::class, 'show']);

    // Admin — Reservations
    $routes->get('reservations', [AdminReservationController::class, 'index']);
    $routes->post('reservations/confirm/(:num)', [AdminReservationController::class, 'confirm']);
    $routes->post('reservations/cancel/(:num)', [AdminReservationController::class, 'cancel']);
    $routes->delete('reservations/delete/(:num)', [AdminReservationController::class, 'delete']);
    $routes->get('reservations/(:num)', [AdminReservationController::class, 'show']);

    // Admin registration
    $routes->get('register', [AdminRegisterController::class, 'registerView']);
    $routes->post('register', [AdminRegisterController::class, 'registerAction']);
});

// Test Mailpit
$routes->get('test/mail', [\App\Controllers\TestMailpit::class, 'index']);
