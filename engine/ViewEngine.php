<?php

namespace Engine;

class ViewEngine
{
    protected $viewPath;
    protected $layout = null;
    protected $sections = [];
    protected $currentSection = null;

    public function __construct()
    {
        $this->viewPath = __DIR__ . '/../projects/Views/';
    }

    public function render($template, $data = [])
    {
        $templatePath = $this->viewPath . str_replace('.', '/', $template) . '.ftwo.php';
        
        if (!file_exists($templatePath)) {
            throw new \Exception("View file not found: {$templatePath}");
        }

        // Add session data to view data
        $data['errors'] = Session::flash('errors') ?: [];
        $data['message'] = Session::flash('message');
        $data['success'] = Session::flash('success');
        $data['warning'] = Session::flash('warning');
        $data['info'] = Session::flash('info');

        // Extract data to generic variables
        extract($data, EXTR_SKIP);

        // Start output buffering
        ob_start();
        
        try {
            include $templatePath;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        $content = ob_get_clean();

        // If layout is defined, render layout with content
        if ($this->layout) {
            $layoutPath = $this->viewPath . str_replace('.', '/', $this->layout) . '.ftwo.php';
            if (!file_exists($layoutPath)) {
                throw new \Exception("Layout file not found: {$layoutPath}");
            }
            
            // Pass content as a variable to layout or use section system
            // Simplify: $content available in layout
            ob_start();
            include $layoutPath;
            return ob_get_clean();
        }

        return $content;
    }

    public function extends($layout)
    {
        $this->layout = $layout;
    }

    public function section($name)
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function endSection()
    {
        if (!$this->currentSection) {
            return;
        }
        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = null;
    }

    public function yield($name)
    {
        return $this->sections[$name] ?? '';
    }

    public function e($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
