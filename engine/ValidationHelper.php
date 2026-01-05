<?php

namespace Engine;

class ValidationHelper
{
    /**
     * Quick validation with common rules
     */
    public static function email($email)
    {
        return Validator::make(['email' => $email], ['email' => 'required|email']);
    }

    public static function password($password, $confirmed = false)
    {
        $rules = ['password' => 'required|min:8'];
        if ($confirmed) {
            $rules['password'] .= '|confirmed';
        }

        return Validator::make(['password' => $password], $rules);
    }

    public static function username($username)
    {
        return Validator::make(['username' => $username], [
            'username' => 'required|string|min:3|max:20|alpha_num'
        ]);
    }

    public static function phone($phone)
    {
        return Validator::make(['phone' => $phone], [
            'phone' => 'required|regex:/^[0-9\-\+\(\)\s]+$/'
        ]);
    }

    public static function url($url)
    {
        return Validator::make(['url' => $url], ['url' => 'required|url']);
    }

    public static function date($date, $format = null)
    {
        $rules = ['date' => 'required|date'];
        if ($format) {
            $rules['date'] .= "|date_format:{$format}";
        }

        return Validator::make(['date' => $date], $rules);
    }

    public static function numeric($number, $min = null, $max = null)
    {
        $rules = ['number' => 'required|numeric'];
        
        if ($min !== null && $max !== null) {
            $rules['number'] .= "|between:{$min},{$max}";
        } elseif ($min !== null) {
            $rules['number'] .= "|min:{$min}";
        } elseif ($max !== null) {
            $rules['number'] .= "|max:{$max}";
        }

        return Validator::make(['number' => $number], $rules);
    }

    public static function file($file, $allowedTypes = [], $maxSize = null)
    {
        $rules = ['file' => 'required'];
        
        if (!empty($allowedTypes)) {
            $rules['file'] .= '|in:' . implode(',', $allowedTypes);
        }

        if ($maxSize) {
            $rules['file'] .= "|max:{$maxSize}";
        }

        return Validator::make(['file' => $file], $rules);
    }

    /**
     * Custom validation rules
     */
    public static function strongPassword($password)
    {
        $validator = Validator::make(['password' => $password], ['password' => 'required']);
        
        $validator->addCustomRule('strong_password', function($attribute, $value) {
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', $value);
        }, 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.');

        return $validator;
    }

    public static function indonesianPhone($phone)
    {
        $validator = Validator::make(['phone' => $phone], ['phone' => 'required']);
        
        $validator->addCustomRule('id_phone', function($attribute, $value) {
            return preg_match('/^(\+62|62|0)[0-9]{9,13}$/', $value);
        }, 'Please enter a valid Indonesian phone number.');

        return $validator;
    }

    public static function nik($nik)
    {
        $validator = Validator::make(['nik' => $nik], ['nik' => 'required']);
        
        $validator->addCustomRule('nik', function($attribute, $value) {
            return preg_match('/^[0-9]{16}$/', $value);
        }, 'NIK must be 16 digits.');

        return $validator;
    }

    /**
     * Batch validation
     */
    public static function validateMultiple(array $data, array $rules, array $messages = [])
    {
        return Validator::make($data, $rules, $messages);
    }

    /**
     * API validation helper
     */
    public static function apiValidate(array $data, array $rules, array $messages = [])
    {
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ];
        }

        return [
            'success' => true,
            'data' => $data
        ];
    }

    /**
     * Form validation with CSRF
     */
    public static function formValidate(array $data, array $rules, array $messages = [])
    {
        // Add CSRF validation if not present
        if (!isset($rules['_token'])) {
            $rules['_token'] = 'required';
            $messages['_token.required'] = 'CSRF token is required';
        }

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Conditional validation
     */
    public static function sometimes(array $data, string $field, callable $condition, array $rules, array $messages = [])
    {
        if ($condition($data)) {
            return Validator::make($data, [$field => $rules], $messages);
        }

        return Validator::make($data, [], $messages);
    }

    /**
     * Validate array of items
     */
    public static function validateArray(array $items, array $itemRules, array $messages = [])
    {
        $errors = [];
        $validated = [];

        foreach ($items as $index => $item) {
            $validator = Validator::make($item, $itemRules, $messages);
            
            if ($validator->fails()) {
                $errors[$index] = $validator->errors();
            } else {
                $validated[$index] = $item;
            }
        }

        return [
            'valid' => empty($errors),
            'validated' => $validated,
            'errors' => $errors
        ];
    }

    /**
     * Validate nested data
     */
    public static function validateNested(array $data, array $rules, array $messages = [])
    {
        $flattenedData = [];
        $flattenedRules = [];

        foreach ($rules as $key => $rule) {
            if (strpos($key, '.') !== false) {
                $flattenedRules[$key] = $rule;
            } else {
                $flattenedRules[$key] = $rule;
            }
        }

        return Validator::make($data, $flattenedRules, $messages);
    }
}
