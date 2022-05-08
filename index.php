<?php

include __DIR__ . '/bootstrap/app.php';
include __DIR__ . '/bootstrap/bootstrap.php';

use App\Helpers\RoutesHelper;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$routesHelper = new RoutesHelper();
$routesHelper->handle();
