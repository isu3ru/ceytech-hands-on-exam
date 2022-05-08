<?php

namespace App\Helpers;

class UrlHelper
{

    public static function baseUrl()
    {
        return $_ENV['BASE_URL'];
    }
}
