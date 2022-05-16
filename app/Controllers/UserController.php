<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\UrlHelper;
use App\Helpers\ViewHelper;
use App\Models\User;
use Rakit\Validation\Validator;

class UserController
{
    public function __construct()
    {
        if (!SessionHelper::has('admin')) {
            SessionHelper::clean();
            UrlHelper::redirect('/admin/login');
        }
    }

    public function users()
    {
        $title = 'Users';

        $user = new User();
        $users = $user->all();

        ViewHelper::render('admin/users/index', compact('title', 'users'));
    }
}
