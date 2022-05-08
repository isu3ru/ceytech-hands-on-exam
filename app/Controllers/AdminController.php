<?php

namespace App\Controllers;

use App\Helpers\ViewHelper;

class AdminController
{
    public function __construct()
    {
    }
    public function index()
    {
        echo 'admin home';
    }

    public function login()
    {
        $title = 'Administrators Login';
        ViewHelper::render('admin/login', compact('title'));
    }
}
