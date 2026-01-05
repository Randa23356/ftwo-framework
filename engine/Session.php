<?php

namespace Engine;

class Session
{
    private static $started = false;

    public static function start()
    {
        if (!self::$started && session_status() === PHP_SESSION_NONE) {
            // Configure session settings
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
            
            session_start();
            self::$started = true;
        }
    }

    public static function put($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function forget($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function flush()
    {
        self::start();
        $_SESSION = [];
    }

    public static function destroy()
    {
        self::start();
        session_destroy();
        self::$started = false;
    }

    public static function regenerate($deleteOld = true)
    {
        self::start();
        session_regenerate_id($deleteOld);
    }

    public static function flash($key, $value = null)
    {
        if ($value === null) {
            // Get flash data
            $flashKey = '_flash_' . $key;
            $value = self::get($flashKey);
            self::forget($flashKey);
            return $value;
        } else {
            // Set flash data
            self::put('_flash_' . $key, $value);
        }
    }

    public static function flashNow($key, $value)
    {
        self::put('_flash_now_' . $key, $value);
    }

    public static function getFlashNow($key, $default = null)
    {
        self::start();
        return $_SESSION['_flash_now_' . $key] ?? $default;
    }

    public static function all()
    {
        self::start();
        return $_SESSION;
    }

    public static function token()
    {
        self::start();
        if (!isset($_SESSION['_token'])) {
            $_SESSION['_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_token'];
    }

    public static function previousUrl($url = null)
    {
        if ($url === null) {
            return self::get('_previous_url');
        } else {
            self::put('_previous_url', $url);
        }
    }

    public static function errors($errors = null)
    {
        if ($errors === null) {
            return self::flash('errors', []);
        } else {
            self::flash('errors', $errors);
        }
    }

    public static function old($key = null, $default = null)
    {
        $oldInput = self::flash('old_input', []);
        
        if ($key === null) {
            return $oldInput;
        }
        
        return $oldInput[$key] ?? $default;
    }

    public static function flashInput($input)
    {
        self::flash('old_input', $input);
    }
}