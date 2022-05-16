<?php

namespace App\Controllers;

use App\Helpers\ViewHelper;
use App\Models\Page;

class SiteController
{
    private $pages;

    public function __construct()
    {
        $pagesModel = new Page;
        $this->pages = $pagesModel->all(true);
    }

    /**
     * Show home page
     *
     * @return void
     */
    public function index()
    {
        $title = 'Home';
        $pagesModel = new Page;
        $pages = $this->pages;

        ViewHelper::render('web/home', compact('title', 'pages'));
    }

    /**
     * Show about us page
     *
     * @return void
     */
    public function about()
    {
        $title = 'About Us';
        $pagesModel = new Page;
        $pages = $this->pages;

        ViewHelper::render('web/about', compact('title', 'pages'));
    }

    /**
     * Show 404 not found page
     *
     * @return void
     */
    public function show404()
    {
        $title = 'Page Not Found';
        $pagesModel = new Page;
        $pages = $this->pages;

        ViewHelper::render('web/404', compact('title', 'pages'));
    }

    /**
     * Show page
     * @param string $id
     * @return void
     * @throws \Exception
     */
    public function page()
    {
        $id = filter_input(INPUT_GET, 'id');

        $title = 'Page';
        $pagesModel = new Page;
        $page = $pagesModel->getPageById($id);
        $pages = $this->pages;

        ViewHelper::render('web/page', compact('title', 'page', 'pages'));
    }

    /**
     * Show website login page
     *
     * @return void
     */
    public function login()
    {
        $title = 'Login';
        $pagesModel = new Page;
        $pages = $this->pages;

        ViewHelper::render('web/auth/login', compact('title', 'pages'));
    }

    /**
     * Show website registration page
     *
     * @return void
     */
    public function register()
    {
        $title = 'Register';
        $pagesModel = new Page;
        $pages = $this->pages;

        ViewHelper::render('web/auth/register', compact('title', 'pages'));
    }
}
