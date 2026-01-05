<?php

namespace Engine;

class Boot
{
    private static $config = [];

    public static function run()
    {
        // 1. Load Config
        self::loadConfig();

        // 2. Start Session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // 3. Error Handling
        if (self::env('APP_DEBUG', true)) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
            error_reporting(0);
        }

        // 4. Dispatch Router
        try {
            $router = new Router();
            require_once __DIR__ . '/../config/routes.php';
            $router->dispatch();
        } catch (\Exception $e) {
            self::handleException($e);
        }
    }

    private static function loadConfig()
    {
        $configPath = __DIR__ . '/../config/';
        if (file_exists($configPath . 'app.php')) {
            self::$config['app'] = require $configPath . 'app.php';
        }
        if (file_exists($configPath . 'database.php')) {
            self::$config['database'] = require $configPath . 'database.php';
        }
    }

    public static function config($key, $default = null)
    {
        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        return $value;
    }

    public static function env($key, $default = null)
    {
        // Basic env simulation or load from generic config
        // In real world, use .env parser. Here we assume constants or config.
        // For simplicity, we check $_ENV or getenv
        $val = getenv($key);
        if ($val === false) {
             return $_ENV[$key] ?? $default;
        }
        return $val;
    }

    private static function handleException($e)
    {
        echo "<h1>FTwoDev Framework Error</h1>";
        echo "<p>" . $e->getMessage() . "</p>";
        if (self::env('APP_DEBUG', true)) {
             echo "<pre>" . $e->getTraceAsString() . "</pre>";
        }
    }
}
