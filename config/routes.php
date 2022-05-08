<?php

include __DIR__ . '/../boot.php';

use App\Controllers\AdminController;
use App\Controllers\SiteController;

return [
    '404' => [SiteController::class, 'show404'],
    'GET' => [
        '/' => [SiteController::class, 'index'],
        '/about' => [SiteController::class, 'about'],
        '/admin' => [AdminController::class, 'index'],
        '/admin/login' => [AdminController::class, 'login'],
    ],
    'POST' => [],
];
