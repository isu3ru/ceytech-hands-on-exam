<?php

namespace App\Controllers;

use App\Helpers\ViewHelper;

class SiteController
{
    public function index()
    {
        $title = 'Home Page';
        ViewHelper::render('web/home', compact('title'));
    }
}
