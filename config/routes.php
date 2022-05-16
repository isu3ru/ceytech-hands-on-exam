<?php

include __DIR__ . '/../boot.php';

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\PageController;
use App\Controllers\SiteController;
use App\Controllers\UserController;

return [
    '404' => [SiteController::class, 'show404'],
    'GET' => [
        # site
        '/' => [SiteController::class, 'index'],
        '/about' => [SiteController::class, 'about'],
        '/page' => [SiteController::class, 'page'],
        # admin
        '/admin' => [AdminController::class, 'index'],
        # admin auth
        '/admin/login' => [AuthController::class, 'login'],
        '/admin/logout' => [AuthController::class, 'login'],
        # users
        '/admin/users' => [UserController::class, 'users'],
        '/admin/users/edit' => [UserController::class, 'edit'],
        # pages
        '/admin/pages' => [PageController::class, 'index'],
        '/admin/pages/create' => [PageController::class, 'create'],
        '/admin/pages/edit' => [PageController::class, 'edit'],
        # guests
        '/login' => [SiteController::class, 'login'],
        '/register' => [SiteController::class, 'register'],
    ],
    'POST' => [
        # users
        '/admin/users' => [UserController::class, 'createUser'],
        '/admin/users/edit' => [UserController::class, 'updateUser'],
        '/admin/users/delete' => [UserController::class, 'deleteUser'],
        '/login' => [AuthController::class, 'processUserLogin'],
        '/logout' => [AuthController::class, 'processUserLogout'],
        '/register' => [AuthController::class, 'processUserRegistration'],
        # pages
        '/admin/pages/create' => [PageController::class, 'createPage'],
        '/admin/pages/edit' => [PageController::class, 'updatePage'],
        '/admin/pages/delete' => [PageController::class, 'deletePage'],
        # auth
        '/admin/login' => [AuthController::class, 'processAdminLogin'],
        '/admin/logout' => [AuthController::class, 'processAdminLogout'],
    ],
];
