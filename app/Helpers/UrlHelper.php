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

    /**
     * Create slug from text
     *
     * @author https://lucidar.me/
     * @see https://lucidar.me/en/web-dev/how-to-slugify-a-string-in-php/
     * @param string $url
     * @return string
     */
    public static function slugify(string $urlString)
    {
        $text = strip_tags($urlString);
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        setlocale(LC_ALL, 'en_US.utf8');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public static function previousPage()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}
