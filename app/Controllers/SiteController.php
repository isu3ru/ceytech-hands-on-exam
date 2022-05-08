<?php

namespace App\Controllers;

class SiteController
{
    public function __construct()
    {
    }

    public function index()
    {
        require_once VIEWS_PATH . '/web/home.php';
    }
}
