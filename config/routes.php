<?php

include __DIR__ . '/../boot.php';

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Controllers\UserController;

return [
    '404' => [SiteController::class, 'show404'],
    'GET' => [
        '/' => [SiteController::class, 'index'],
        '/about' => [SiteController::class, 'about'],
        '/admin' => [AdminController::class, 'index'],
        '/admin/login' => [AuthController::class, 'login'],
        '/admin/logout' => [AuthController::class, 'login'],
        '/admin/users' => [UserController::class, 'users'],
        '/admin/users/edit' => [UserController::class, 'edit'],
    ],
    'POST' => [
        '/admin/users' => [UserController::class, 'createUser'],
        '/admin/users/edit' => [UserController::class, 'updateUser'],
        '/admin/users/delete' => [UserController::class, 'deleteUser'],
    ],
];
