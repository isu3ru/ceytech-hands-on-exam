<?php

namespace App\Helpers;

class ViewHelper
{
    public static function render($view, $data = [])
    {
        extract($data);

        require_once VIEWS_PATH . '/' . $view . '.php';
    }
}
