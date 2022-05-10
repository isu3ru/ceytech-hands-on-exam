<?php

namespace App\Helpers;

class SessionHelper
{
    /**
     * Set flashdata to session
     *
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function setFlashData($key, $data)
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
        }

        $_SESSION['flashdata'][$key] = $data;
    }

    /**
     * Clear flash data from session
     *
     * @return void
     */
    public static function clearFlashData()
    {
        unset($_SESSION['flashdata']);
        $_SESSION['flashdata'] = [];
    }

    /**
     * Get flash data from session
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function flashdata(string $key, $default = ''): mixed
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
            return $default;
        }

        if (array_key_exists($key, $_SESSION['flashdata'])) {
            return $_SESSION['flashdata'][$key] ?? '';
        }

        return $default;
    }

    /**
     * Clean the session data
     *
     * @return void
     */
    public static function clean()
    {
        self::clearFlashData();
        unset($_SESSION['user']);
        setcookie(session_name(), '', time() - 3600);
        session_destroy();
        session_regenerate_id(true);
    }
}
