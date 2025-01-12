<?php

use App\Controllers\MeetingRoomController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes, ['except' => ['register']]);

use App\Controllers\UserController;
use App\Controllers\Admin\UserController as AdminUserController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\RoomController;
use App\Controllers\Admin\ReservationController as AdminReservationController;;
use App\Controllers\ActivityController;

// @TODO Ajouter les routes pour la suppression et la mise à jour de l'utilisateur
$routes->get('admin/users', [AdminUserController::class, 'index']);
$routes->get('users/(:segment)', [UserController::class, 'show']);
$routes->get('register', [RegisterController::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

$routes->get('rooms', [RoomController::class, 'index']);

$routes->get('meetingRooms', [MeetingRoomController::class, 'index']);

$routes->get('admin/reservations', [AdminReservationController::class, 'index']);

$routes->get('activities', [ActivityController::class, 'index']);
