<?php

include __DIR__ . '/boot.php';

$requestPath = $_SERVER['REQUEST_URI'];

// get request method
$requestMethod = $_SERVER['REQUEST_METHOD'];

$route = $routes[$requestMethod][$requestPath];
$controller = $route[0];
$method = $route[1];
$instance = new $controller();
$instance->$method();
