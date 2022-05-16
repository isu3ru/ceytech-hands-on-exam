<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\UrlHelper;
use App\Helpers\ViewHelper;
use App\Models\User;

class AdminController
{
    public function __construct()
    {
        if (!SessionHelper::has('admin')) {
            SessionHelper::clean();
            UrlHelper::redirect('/admin/login');
        }
    }

    public function index()
    {
        $title = 'Dashboard';
        ViewHelper::render('admin/dashboard', compact('title'));
    }
}
