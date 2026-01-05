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
        $viewEngine = new \Engine\ViewEngine();
        return $viewEngine->render($template, $data);
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token() {
        return \Engine\Session::token();
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

if (!function_exists('env')) {
    function env($key, $default = null) {
        return \Engine\Env::get($key, $default);
    }
}

if (!function_exists('json')) {
    function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

if (!function_exists('session')) {
    function session($key = null, $value = null) {
        if ($key === null) {
            return \Engine\Session::all();
        }
        
        if ($value === null) {
            return \Engine\Session::get($key);
        }
        
        return \Engine\Session::put($key, $value);
    }
}

if (!function_exists('old')) {
    function old($key = null, $default = null) {
        return \Engine\Session::old($key, $default);
    }
}

if (!function_exists('back')) {
    function back() {
        $previousUrl = \Engine\Session::previousUrl();
        return redirect($previousUrl ?: '/');
    }
}

if (!function_exists('storage_path')) {
    function storage_path($path = '') {
        $storagePath = __DIR__ . '/../storage';
        return $path ? $storagePath . '/' . ltrim($path, '/') : $storagePath;
    }
}

if (!function_exists('framework_version')) {
    function framework_version() {
        return \Engine\Boot::VERSION;
    }
}
