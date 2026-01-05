# FTwoDev Validation System - Complete Guide

## 🚀 Validation System Overview

FTwoDev Framework now includes a powerful, flexible validation system with:
- **Fluent Interface** - Easy to use, chainable methods
- **Built-in Rules** - 25+ common validation rules
- **Custom Rules** - Extensible rule system
- **ORM Integration** - Unique validation with database
- **Error Handling** - User-friendly error messages
- **API Support** - JSON validation responses

---

## 📋 Table of Contents

1. [Basic Usage](#basic-usage)
2. [Available Rules](#available-rules)
3. [Custom Rules](#custom-rules)
4. [Error Handling](#error-handling)
5. [Controller Integration](#controller-integration)
6. [Validation Helpers](#validation-helpers)
7. [API Validation](#api-validation)
8. [Advanced Features](#advanced-features)

---

## 🔍 Basic Usage

### Simple Validation

```php
use Engine\Validator;

$data = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'secret123'
];

$validator = Validator::make($data, [
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:6'
]);

if ($validator->fails()) {
    $errors = $validator->errors();
    // Handle errors
}

if ($validator->passes()) {
    // Validation passed
}
```

### With Custom Messages

```php
$validator = Validator::make($data, [
    'name' => 'required',
    'email' => 'required|email'
], [
    'name.required' => 'Please enter your name',
    'email.required' => 'We need your email address',
    'email.email' => 'Please enter a valid email'
]);
```

---

## 📚 Available Rules

### **Required & Presence**
- `required` - Field must be present and not empty
- `filled` - Field must be present and not empty if present
- `present` - Field must be present (can be empty)

### **Data Types**
- `string` - Must be a string
- `integer` - Must be an integer
- `numeric` - Must be numeric
- `array` - Must be an array
- `boolean` - Must be true or false

### **String Rules**
- `min:8` - Minimum length
- `max:255` - Maximum length
- `between:3,50` - Length between min and max
- `size:10` - Exact length
- `alpha` - Only letters
- `alpha_num` - Letters and numbers
- `alpha_dash` - Letters, numbers, dashes, underscores

### **Format Rules**
- `email` - Valid email address
- `url` - Valid URL
- `regex:/pattern/` - Custom regex pattern

### **Database Rules**
- `unique:table,column` - Unique in database
- `unique:table,column,exceptId` - Unique except for specific ID
- `exists:table,column` - Must exist in database

### **Comparison Rules**
- `confirmed` - Must have matching confirmation field
- `same:field` - Must match another field
- `different:field` - Must be different from another field
- `in:value1,value2` - Must be in list of values
- `not_in:value1,value2` - Must not be in list of values

### **Date Rules**
- `date` - Valid date
- `date_format:Y-m-d` - Specific date format
- `before:tomorrow` - Must be before given date
- `after:yesterday` - Must be after given date

---

## 🎯 Custom Rules

### Add Custom Rule

```php
$validator = Validator::make($data, $rules);

$validator->addCustomRule('strong_password', function($attribute, $value, $parameters, $validator) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $value);
}, 'Password must contain uppercase, lowercase, and number.');

// Use in rules
$rules = [
    'password' => 'required|strong_password'
];
```

### Global Custom Rules

```php
// In your service provider or bootstrap
Validator::addCustomRule('indonesian_phone', function($attribute, $value) {
    return preg_match('/^(\+62|62|0)[0-9]{9,13}$/', $value);
}, 'Please enter a valid Indonesian phone number.');
```

---

## ⚠️ Error Handling

### Get All Errors

```php
if ($validator->fails()) {
    $errors = $validator->errors();
    
    // Array format:
    // [
    //     'name' => ['Name is required'],
    //     'email' => ['Email is invalid', 'Email already exists']
    // ]
}
```

### Get First Error

```php
$firstError = $validator->getFirstError();
$specificError = $validator->getFirstError('email');
```

### Check Specific Field

```php
if (isset($errors['email'])) {
    echo $errors['email'][0];
}
```

---

## 🎮 Controller Integration

### Using ValidatesRequests Trait

```php
<?php

namespace Projects\Controllers;

use Engine\ControllerBase;

class UserController extends ControllerBase
{
    public function store()
    {
        $data = [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
            'password_confirmation' => $this->input('password_confirmation')
        ];

        $validator = $this->validate($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // If validation fails, automatically redirects back with errors
        // If passes, continues execution

        // Create user...
        return redirect('/users')->with('success', 'User created!');
    }

    // Or define rules as methods
    protected function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function update($id)
    {
        $this->validateRequest(); // Uses getValidationRules()
        
        // Update logic...
    }
}
```

### Manual Validation in Controller

```php
public function register()
{
    $validator = Validator::make($this->getRequestData(), [
        'username' => 'required|min:3|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed'
    ]);

    if ($validator->fails()) {
        return $this->view('auth/register', [
            'errors' => $validator->errors(),
            'old' => $this->getRequestData()
        ]);
    }

    // Create user...
}
```

---

## 🛠️ Validation Helpers

### Quick Validations

```php
use Engine\ValidationHelper;

// Email validation
$emailValidator = ValidationHelper::email('user@example.com');
if ($emailValidator->fails()) {
    echo 'Invalid email';
}

// Password validation
$passwordValidator = ValidationHelper::password('secret123', true); // confirmed
$strongPasswordValidator = ValidationHelper::strongPassword('Secret123!');

// Phone validation
$phoneValidator = ValidationHelper::indonesianPhone('+62812345678');

// Date validation
$dateValidator = ValidationHelper::date('2023-12-31', 'Y-m-d');
```

### API Validation

```php
$result = ValidationHelper::apiValidate($request->all(), [
    'name' => 'required|string',
    'email' => 'required|email'
]);

if (!$result['success']) {
    return response()->json([
        'success' => false,
        'errors' => $result['errors']
    ], 422);
}

// Continue with validated data
$data = $result['data'];
```

### Array Validation

```php
$items = [
    ['name' => 'Item 1', 'price' => 100],
    ['name' => 'Item 2', 'price' => 'invalid']
];

$result = ValidationHelper::validateArray($items, [
    'name' => 'required|string',
    'price' => 'required|numeric|min:0'
]);

if (!$result['valid']) {
    $errors = $result['errors'];
    // Handle validation errors for each item
}
```

---

## 🌐 API Validation

### JSON Response

```php
public function apiStore(Request $request)
{
    $result = ValidationHelper::apiValidate($request->all(), [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published'
    ]);

    if (!$result['success']) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $result['errors']
        ], 422);
    }

    // Create with validated data
    $post = Post::create($result['data']);

    return response()->json([
        'success' => true,
        'data' => $post
    ]);
}
```

### AJAX Validation

```php
public function validateField(Request $request)
{
    $field = $request->input('field');
    $value = $request->input('value');

    $rules = [
        'username' => 'required|min:3|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ];

    $validator = Validator::make([$field => $value], [$field => $rules[$field]]);

    return response()->json([
        'valid' => $validator->passes(),
        'errors' => $validator->errors()[$field] ?? []
    ]);
}
```

---

## 🔧 Advanced Features

### Conditional Validation

```php
$data = $request->all();

// Sometimes validation (only if condition is met)
$validator = ValidationHelper::sometimes($data, 'phone_number', function($data) {
    return isset($data['has_phone']) && $data['has_phone'] === 'yes';
}, ['required', 'regex:/^[0-9]+$/']);

// Nested validation
$validator = ValidationHelper::validateNested($data, [
    'user.name' => 'required|string',
    'user.email' => 'required|email',
    'address.street' => 'required|string',
    'address.city' => 'required|string'
]);
```

### Batch Validation

```php
$users = [
    ['name' => 'John', 'email' => 'john@example.com'],
    ['name' => 'Jane', 'email' => 'invalid-email']
];

$result = ValidationHelper::validateArray($users, [
    'name' => 'required|string',
    'email' => 'required|email'
]);

if (!$result['valid']) {
    // Handle errors for invalid items
    foreach ($result['errors'] as $index => $errors) {
        echo "Item {$index} has errors: " . implode(', ', $errors);
    }
}
```

### ORM Integration

```php
// Unique validation with ORM
$validator = Validator::make($data, [
    'email' => 'required|email|unique:users,email,' . $userId, // except current user
    'username' => 'required|unique:users,username'
]);

// Exists validation
$validator = Validator::make($data, [
    'category_id' => 'required|exists:categories,id',
    'tag_id' => 'required|exists:tags,id'
]);
```

---

## 🎨 View Integration

### Display Errors in Views

```php
<!-- In your view template -->
<?php if (isset($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $field => $fieldErrors): ?>
                <?php foreach ($fieldErrors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Form field with error -->
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" value="<?= old('email') ?>" class="form-control">
    <?php if (isset($errors['email'])): ?>
        <div class="text-danger">
            <?= $errors['email'][0] ?>
        </div>
    <?php endif; ?>
</div>
```

### Old Input Helper

```php
// In ValidatesRequests trait, old input is automatically available
<input type="text" name="name" value="<?= old('name') ?>">
<textarea name="description"><?= old('description') ?></textarea>
```

---

## 🚀 Performance Tips

1. **Order Rules by Speed** - Put fast rules first (required, type checks)
2. **Use Specific Rules** - Use `numeric` instead of regex for numbers
3. **Cache Validation Rules** - For complex validation, cache rule definitions
4. **Early Returns** - Stop validation on first error for performance-critical apps

```php
// Good: Fast rules first
$rules = [
    'email' => 'required|email', // Fast check first
    'email' => 'unique:users,email' // Slower DB check last
];

// For API: Validate only what you need
$apiRules = [
    'name' => 'required|string|max:100', // Simple, fast
    'bio' => 'nullable|string|max:500'    // Optional, skip if empty
];
```

---

## 📚 Best Practices

1. **Consistent Error Messages** - Use consistent message formats
2. **User-Friendly Messages** - Write clear, helpful error messages
3. **Validate Early** - Validate as early as possible in the request lifecycle
4. **Secure Defaults** - Default to secure validation rules
5. **Test Validation** - Write tests for your validation rules

```php
// Good: Clear, specific rules
$rules = [
    'password' => 'required|min:8|confirmed',
    'email' => 'required|email|unique:users,email'
];

// Good: Helpful error messages
$messages = [
    'password.min' => 'Password must be at least 8 characters long',
    'email.unique' => 'This email is already registered. Try logging in?'
];
```

---

## 🔥 Migration from Old Validation

If you're using manual validation:

```php
// Old way
if (empty($name)) {
    $errors[] = 'Name is required';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email';
}

// New way
$validator = Validator::make($data, [
    'name' => 'required',
    'email' => 'required|email'
]);

if ($validator->fails()) {
    $errors = $validator->errors();
}
```

---

That's it! You now have a comprehensive validation system for your FTwoDev Framework! 🎉
