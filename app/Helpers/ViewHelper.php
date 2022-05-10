<?php

namespace App\Helpers;

class ViewHelper
{

    public static function render($view, $data = [])
    {
        // extract data sent
        extract($data);

        // render the view
        require_once VIEWS_PATH . '/' . $view . '.php';

        // clear any flash data
        SessionHelper::clearFlashData();
    }
}
