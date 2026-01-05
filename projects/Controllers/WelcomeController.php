<?php

namespace Projects\Controllers;

use Engine\ControllerBase;

class WelcomeController extends ControllerBase
{
    public function index()
    {
        return $this->view('welcome');
    }
}
