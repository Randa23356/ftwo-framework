<?php

namespace Engine\Traits;

use Engine\Validator;
use Engine\Session;

trait ValidatesRequests
{
    protected function validate(array $data, array $rules, array $messages = [])
    {
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $this->handleValidationErrors($validator);
        }

        return $validator;
    }

    protected function handleValidationErrors($validator)
    {
        // Store errors in session for redirect
        Session::flash('errors', $validator->errors());
        Session::flash('old', $this->getRequestData());

        // Redirect back with errors
        redirect($_SERVER['HTTP_REFERER'] ?? '/');
    }

    protected function getRequestData()
    {
        // Get request data from POST/GET
        return array_merge($_POST, $_GET);
    }

    protected function getValidationRules()
    {
        return [];
    }

    protected function getValidationMessages()
    {
        return [];
    }

    protected function validateRequest()
    {
        $data = $this->getRequestData();
        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();

        return $this->validate($data, $rules, $messages);
    }

    // Helper methods for common validations
    protected function validateEmail($email)
    {
        return Validator::make(['email' => $email], ['email' => 'required|email']);
    }

    protected function validatePassword($password)
    {
        return Validator::make(['password' => $password], [
            'password' => 'required|min:8|confirmed'
        ]);
    }

    protected function validateRequired($data, array $fields)
    {
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field] = 'required';
        }

        return Validator::make($data, $rules);
    }

    protected function validateNumeric($data, array $fields)
    {
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field] = 'numeric';
        }

        return Validator::make($data, $rules);
    }

    protected function validateUnique($table, $field, $value, $except = null)
    {
        $rule = "unique:{$table},{$field}";
        if ($except) {
            $rule .= ",{$except}";
        }

        return Validator::make([$field => $value], [$field => $rule]);
    }
}
