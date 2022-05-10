<?php

/**
 * DATABASE CONNECTION CONFIGURATION
 */
return [
    'host' => $_ENV['DATABASE_HOSTNAME'] ?? 'localhost',
    'database' => $_ENV['DATABASE_NAME'] ?? '',
    'username' => $_ENV['DATABASE_USERNAME'] ?? '',
    'password' => $_ENV['DATABASE_PASSWORD'] ?? '',
];
