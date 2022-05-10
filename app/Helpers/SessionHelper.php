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
        unset($_SESSION['admin']);
        unset($_SESSION['userdata']);
        setcookie(session_name(), '', time() - 3600);
        session_destroy();
        session_regenerate_id(true);
    }

    public static function old(string $key, mixed $default = '')
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
            return $default;
        }

        if (!array_key_exists('_old_input', $_SESSION['flashdata'])) {
            $_SESSION['flashdata']['_old_input'] = [];
            return $default;
        }

        if (array_key_exists($key, $_SESSION['flashdata']['_old_input'])) {
            return $_SESSION['flashdata']['_old_input'][$key] ?? '';
        }

        return $default;
    }

    public static function populateOldInput(array $data)
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
        }

        if (!array_key_exists('_old_input', $_SESSION['flashdata'])) {
            $_SESSION['flashdata']['_old_input'] = [];
        }

        foreach ($data as $key => $value) {
            $_SESSION['flashdata']['_old_input'][$key] = $value;
        }
    }

    public static function error(string $key)
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
            return '';
        }

        if (!array_key_exists('_old_input', $_SESSION['flashdata'])) {
            $_SESSION['flashdata']['_old_input'] = [];
            return '';
        }

        if (array_key_exists($key, $_SESSION['flashdata']['_old_input'])) {
            return $_SESSION['flashdata']['_errors']->first($key) ?? '';
        }

        return '';
    }

    public static function errors()
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
            return '';
        }

        if (!array_key_exists('_errors', $_SESSION['flashdata'])) {
            $_SESSION['flashdata']['_errors'] = [];
            return '';
        }

        return $_SESSION['flashdata']['_errors'];
    }

    public static function populateErrors($errors)
    {
        if (!array_key_exists('flashdata', $_SESSION)) {
            $_SESSION['flashdata'] = [];
        }

        if (!array_key_exists('_errors', $_SESSION['flashdata'])) {
            $_SESSION['flashdata']['_errors'] = [];
        }

        $_SESSION['flashdata']['_errors'] = $errors;
    }

    public static function set(string $key, mixed $value)
    {
        if (!array_key_exists('userdata', $_SESSION)) {
            $_SESSION['userdata'] = [];
        }

        $_SESSION['userdata'][$key] = $value;
    }

    public static function get(string $key, mixed $default = '')
    {
        if (!array_key_exists('userdata', $_SESSION)) {
            $_SESSION['userdata'] = [];
        }

        return $_SESSION['userdata'][$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        if (!array_key_exists('userdata', $_SESSION)) {
            $_SESSION['userdata'] = [];
        }

        return array_key_exists($key, $_SESSION['userdata']) && $_SESSION['userdata'][$key] !== null;
    }

    public static function remove(string $key): bool
    {
        if (!array_key_exists('userdata', $_SESSION)) {
            return true;
        }

        unset($_SESSION['userdata'][$key]);

        return !array_key_exists($key, $_SESSION['userdata']);
    }
}
