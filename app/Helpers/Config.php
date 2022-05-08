<?php

namespace App\Helpers;

class Config
{
    private $generalConfig;
    private $databaseConfig;

    public function __construct()
    {
        $this->generalConfig = require_once CONFIG_PATH . '/config.php';
        $this->databaseConfig = require_once CONFIG_PATH . '/database.php';
    }

    public function config($key, $default = '')
    {
        $config = array_merge($this->generalConfig, $this->databaseConfig);

        if (!array_key_exists($key, $config)) {
            return $default;
        }

        return $config[$key];
    }
}
