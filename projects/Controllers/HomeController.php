<?php

namespace Projects\Controllers;

use Engine\ControllerBase;

class HomeController extends ControllerBase
{
    public function index()
    {
        return $this->view('welcome');
    }

    public function about()
    {
        return $this->view('about');
    }
}
