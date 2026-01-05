<?php

if (!function_exists('dd')) {
    function dd(...$vars) {
        foreach ($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
        die(1);
    }
}

if (!function_exists('view')) {
    function view($template, $data = []) {
        // Simple helper to instantiate ViewEngine later or used inside controller
        // Ideally this shortcuts to a renderer instance
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field() {
        return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('redirect')) {
    function redirect($url) {
        header("Location: $url");
        exit;
    }
}

if (!function_exists('config')) {
    function config($key, $default = null) {
        return \Engine\Boot::config($key, $default);
    }
}
