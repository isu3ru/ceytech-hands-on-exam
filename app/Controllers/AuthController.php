<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\UrlHelper;
use App\Helpers\ViewHelper;

class AuthController
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function login()
    {
        $title = 'Administrators Login';
        ViewHelper::render('admin/login', compact('title'));
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        SessionHelper::clean();
        UrlHelper::redirect('/admin/login');
    }
}
