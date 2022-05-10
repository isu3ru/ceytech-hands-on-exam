<?php

namespace App\Controllers;

use App\Helpers\ViewHelper;
use App\Models\User;

class AdminController
{
    public function __construct()
    {
    }

    public function index()
    {
        $title = 'Dashboard';
        ViewHelper::render('admin/dashboard', compact('title'));
    }
}
