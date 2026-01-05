<?php

namespace Engine;

use Engine\Traits\ValidatesRequests;

class ControllerBase
{
    use ValidatesRequests;

    protected $viewEngine;

    public function __construct()
    {
        $this->viewEngine = new ViewEngine();
        $this->checkCsrf();
    }

    protected function view($template, $data = [])
    {
        // Expose $this->e() or similar via ViewEngine if needed, 
        // but ViewEngine handles its own context.
        return $this->viewEngine->render($template, $data);
    }

    protected function json($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        return json_encode($data);
    }

    protected function input($key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    protected function redirect($url)
    {
        // Store current URL as previous URL
        Session::previousUrl($_SERVER['REQUEST_URI'] ?? '/');
        
        header("Location: $url");
        exit;
    }

    protected function redirectBack()
    {
        return $this->redirect(Session::previousUrl() ?: '/');
    }

    protected function withErrors($errors)
    {
        Session::errors($errors);
        Session::flashInput($_REQUEST);
        return $this->redirectBack();
    }

    protected function with($key, $value)
    {
        Session::flash($key, $value);
        return $this;
    }

    protected function validate($rules)
    {
        // Simple validation placeholder
        // In real world, use a Validation library
        foreach ($rules as $field => $rule) {
             if (!isset($_REQUEST[$field]) && strpos($rule, 'required') !== false) {
                 throw new \Exception("Validation failed: $field is required");
             }
        }
    }

    private function checkCsrf()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_REQUEST['csrf_token'] ?? null;
            if (!$token || $token !== Session::token()) {
                throw new \Exception("CSRF Token Mismatch");
            }
        }
    }
}
