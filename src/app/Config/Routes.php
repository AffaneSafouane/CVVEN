<?php

use App\Controllers\MeetingRoomController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes, ['except' => ['register']]);

use App\Controllers\UserController;
use App\Controllers\Admin\AdminUserController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\RoomController;

// @TODO Ajouter les routes pour la suppression et la mise à jour de l'utilisateur
$routes->get('admin/users', [AdminUserController::class, 'index']);
$routes->get('users/(:segment)', [UserController::class, 'show']);
$routes->get('register', [RegisterController::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

$routes->get('rooms', [RoomController::class, 'index']);

$routes->get('meetingRooms', [MeetingRoomController::class, 'index']);

