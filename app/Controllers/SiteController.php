<?php

namespace App\Controllers;

use App\Helpers\ViewHelper;

class SiteController
{
    /**
     * Show home page
     *
     * @return void
     */
    public function index()
    {
        $title = 'Home';
        ViewHelper::render('web/home', compact('title'));
    }

    /**
     * Show about us page
     *
     * @return void
     */
    public function about()
    {
        $title = 'About Us';
        ViewHelper::render('web/about', compact('title'));
    }

    /**
     * Show 404 not found page
     *
     * @return void
     */
    public function show404()
    {
        $title = 'Page Not Found';
        ViewHelper::render('web/404', compact('title'));
    }
}
