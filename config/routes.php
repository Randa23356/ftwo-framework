<?php

use Engine\Router;

/**
 * --------------------------------------------------------------------------
 * Manual Routes
 * --------------------------------------------------------------------------
 * Define your custom routes here.
 * 
 * Magic Routing is ENABLED:
 * If a route is not defined here, framework will look for:
 * /name -> NameController::index()
 * /name/action -> NameController::action()
 */

Router::get('/', function() {
    return view('welcome');
});

// Examples (Manual):
// Router::get('/login', 'AuthController@loginForm');


// Magic Routes (Automatic):
// /dashboard       -> DashboardController::index()
// /auth/login      -> AuthController::login()