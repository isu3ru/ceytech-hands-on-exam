<?php

require_once __DIR__ . '/vendor/autoload.php';

# define constants
defined('APP_PATH') or define('APP_PATH', __DIR__);
defined('VIEWS_PATH') or define('VIEWS_PATH', __DIR__ . '/resources/views');
defined('CONFIG_PATH') or define('CONFIG_PATH', __DIR__ . '/config');

# include routes
$routes = require_once __DIR__ . '/config/routes.php';
