<?php

use App\Controllers\Admin\ActivityController as AdminActivityController;
use App\Controllers\Admin\MeetingRoomController as AdminMeetingRoomController;
use App\Controllers\Admin\ReservationController as AdminReservationController;
use App\Controllers\Admin\RoomController as AdminRoomController;
use App\Controllers\Admin\UserController as AdminUserController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes auth
service('auth')->routes($routes, ['except' => ['register']]);; // Routes Shield
// @TODO Ajouter les routes pour la suppression et la mise à jour de l'utilisateur
$routes->get('users/(:segment)', [UserController::class, 'show']);
$routes->get('register', [RegisterController::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

// Routes Reservations
// @TODO Ajouter les routes pour les réservations (Room, MeetingRoom et Activity)


// Routes admin
$routes->get('admin/users', [AdminUserController::class, 'index']);
$routes->get('admin/rooms', [AdminRoomController::class, 'index']);
$routes->get('admin/meetingRooms', [AdminMeetingRoomController::class, 'index']);
$routes->get('admin/reservations', [AdminReservationController::class, 'index']);
$routes->get('admin/activities', [AdminActivityController::class, 'index']);

// Test mailpit
$routes->get('test/mail', [\App\Controllers\TestMailpit::class, 'index']);
