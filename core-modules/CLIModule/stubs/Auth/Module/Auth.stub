<?php

namespace CoreModules\AuthModule;

use Engine\ModelBase;
use Engine\Boot;

class Auth
{
    public static function attempt($username, $password)
    {
        $db = new ModelBase();
        // Assuming 'users' table exists. In a real scenario, this should be configurable.
        $user = $db->fetch("SELECT * FROM users WHERE username = :username", ['username' => $username]);

        if ($user && password_verify($password, $user['password'])) {
             $_SESSION['user_id'] = $user['id'];
             $_SESSION['user_name'] = $user['username'];
             return true;
        }

        return false;
    }

    public static function user()
    {
        if (isset($_SESSION['user_id'])) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['user_name']
            ];
        }
        return null;
    }

    public static function check()
    {
        return isset($_SESSION['user_id']);
    }

    public static function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        session_destroy();
    }
}
