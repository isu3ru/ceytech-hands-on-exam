<?php

include __DIR__ . '/../boot.php';

use App\Controllers\SiteController;

return [
    '404' => '/resources/views/web/404.php',
    'GET' => [
        '/' => [SiteController::class, 'index'],
        '/about' => [SiteController::class, 'about'],
        '/admin/login' => '/resources/views/admin/login.php',
    ],
    'POST' => [],
];
