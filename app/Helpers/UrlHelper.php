<?php

namespace App\Helpers;

class UrlHelper
{

    /**
     * Get the base url
     *
     * @return string
     */
    public static function baseUrl(): string
    {
        return $_ENV['BASE_URL'];
    }

    /**
     * Get the correct URL for the path
     *
     * @param string $path
     * @return string $siteUrl
     */
    public static function siteUrl(string $path): string
    {
        if (!$path) {
            return self::baseUrl();
        }

        // check if path starts with a slash and add if not
        if ($path[0] !== '/') {
            $path = '/' . $path;
        }

        return self::baseUrl() . $path;
    }

    /**
     * Is current path
     * @param string $path
     * @return bool
     */
    public static function isCurrentPath(string $path): bool
    {
        return $_SERVER['REQUEST_URI'] === $path;
    }

    /**
     * Redirect to the given route
     *
     * @param string $route
     * @return void
     */
    public static function redirect(string $route)
    {
        header('Location: ' . self::siteUrl($route));
        exit;
    }
}
