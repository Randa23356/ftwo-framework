# FTwoDev Framework

<div align="center">

![FTwoDev Framework](https://img.shields.io/badge/FTwoDev-Framework-green?style=for-the-badge)
![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue?style=for-the-badge)
![Version](https://img.shields.io/badge/Version-1.4.0-yellow?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)

**The Engine for Modern Creators**

*A native PHP 8 boilerplate built for velocity. FTwoDev gives you the precision of raw PHP with the elegance of a premium framework.*

[Installation](#installation) • [Quick Start](#quick-start) • [Documentation](#documentation) • [Commands](#commands) • [Features](#features)

</div>

---

## 🚀 Features

- **⚡ High Velocity** - Zero dependencies, zero bloat. Lightning fast execution
- **🎯 Magic Routing** - Instant URL to controller mapping without configuration
- **🌸 Bloom Auth** - Premium authentication starter kit ready in seconds
- **🗄️ Database Flow** - Advanced migration and model system using PDO
- **🎨 Template Engine** - Modern view architecture with layouts and sections
- **🛠️ Creative CLI** - Powerful `ftwo` command-line tool for scaffolding
- **🔒 Security First** - Built-in XSS protection and secure defaults
- **📱 Modern PHP** - Built for PHP 8+ with latest language features
- **🌍 Environment Config** - .env file support for configuration management
- **📊 Session Management** - Comprehensive session handling with flash messages
- **🎭 Dynamic Views** - Smart UI that adapts to framework state
- **🔄 Version Management** - Built-in version tracking and display

---

## 📋 Requirements

- PHP 8.0 or higher
- Composer
- MySQL/MariaDB (for database features)
- Web server (Apache/Nginx) or PHP built-in server

---

## 🔧 Installation

### Via Composer (Recommended)

```bash
composer create-project ftwodev/framework my-project
# Setup wizard runs automatically!
cd my-project
php ftwo ignite
```

### Manual Installation

```bash
git clone https://github.com/Randa23356/ftwo-framework.git my-project
cd my-project
composer install
php install.php  # Run setup wizard manually
```

---

## ⚡ Quick Start

### 1. Environment Setup

The framework automatically generates a `.env` file during installation, but you can also create it manually:

```bash
# Generate .env file from .env.example
php ftwo ignite:env
```

### 2. Framework Setup

```bash
# Basic setup (creates default controllers)
php ftwo ignite:setup

# OR install with authentication
php ftwo ignite:bloom
```

### 3. Start Development Server

```bash
php ftwo ignite
# Server starts at http://localhost:8000
```

### 4. Create Your First Controller

```bash
php ftwo craft:controller UserController
```

That's it! Your framework is ready to use.

---

## 📚 Documentation

### Directory Structure

```
FDFramework/
├── config/                 # Configuration files
│   ├── app.php             # Application settings
│   ├── database.php        # Database configuration
│   ├── middleware.php      # Middleware configuration
│   ├── routes.php          # Route definitions
│   └── session.php         # Session configuration
├── core-modules/           # Core framework modules
│   ├── CLIModule/          # Command-line interface
│   └── LoggerModule/       # Logging functionality
├── engine/                 # Framework core engine
│   ├── Boot.php            # Application bootstrap
│   ├── ControllerBase.php  # Base controller class
│   ├── Env.php             # Environment configuration
│   ├── ModelBase.php       # Base model class
│   ├── Router.php          # Routing engine
│   ├── Session.php         # Session management
│   ├── Utils.php           # Helper functions
│   └── ViewEngine.php      # Template engine
├── projects/               # Your application code
│   ├── Controllers/        # Application controllers
│   ├── Models/            # Application models
│   ├── Views/             # Application views
│   ├── Middlewares/       # Custom middlewares
│   ├── Migrations/        # Database migrations
│   └── Services/          # Service classes
├── public/                # Public web directory
│   ├── index.php          # Application entry point
│   └── assets/            # Static assets
├── storage/               # Storage directory
│   ├── logs/              # Application logs
│   └── sessions/          # Session files
├── .env.example           # Environment configuration template
├── .env                   # Environment configuration (auto-generated)
└── vendor/                # Composer dependencies
```

### Configuration

#### Environment Variables (`.env`)

FTwoDev uses environment variables for configuration. The `.env` file is automatically generated during installation:

```bash
APP_NAME="Your App Name"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_KEY=base64:generated-key

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

SESSION_DRIVER=file
SESSION_LIFETIME=120
```

#### Application Settings (`config/app.php`)

```php
return [
    'name' => env('APP_NAME', 'FTwoDev Application'),
    'env' => env('APP_ENV', 'local'),          // local, production
    'debug' => env('APP_DEBUG', true),
    'url' => env('APP_URL', 'http://localhost:8000'),
    'timezone' => env('APP_TIMEZONE', 'Asia/Jakarta'),
    'key' => env('APP_KEY', 'your-app-key'),
];
```

#### Database Configuration (`config/database.php`)

```php
return [
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'dbname' => env('DB_DATABASE', 'ftwodev_db'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
];
```

#### Session Configuration (`config/session.php`)

```php
return [
    'driver' => env('SESSION_DRIVER', 'file'),
    'lifetime' => env('SESSION_LIFETIME', 120), // minutes
    'files' => storage_path('sessions'),
    'cookie' => env('SESSION_COOKIE', 'ftwodev_session'),
    'secure' => env('SESSION_SECURE_COOKIE', false),
    'http_only' => true,
];
```

---

## 🛠️ Commands

The `ftwo` CLI tool provides powerful commands for development:

### System Commands (IGNITE)

| Command | Description |
|---------|-------------|
| `php ftwo ignite` | Start development server |
| `php ftwo ignite:setup` | Setup basic framework structure |
| `php ftwo ignite:bloom` | Install Bloom Auth starter kit |
| `php ftwo ignite:env` | Generate .env file from .env.example |
| `php ftwo ignite:migrate` | Run database migrations |
| `php ftwo ignite:rollback` | Rollback last migration batch |
| `php ftwo ignite:fresh` | Drop all tables & re-run migrations |
| `php ftwo ignite:refresh` | Refresh & sync framework classes |

### Scaffolding Commands (CRAFT)

| Command | Description | Example |
|---------|-------------|---------|
| `php ftwo craft:controller` | Create a new controller | `php ftwo craft:controller UserController` |
| `php ftwo craft:model` | Create a new model | `php ftwo craft:model User` |
| `php ftwo craft:view` | Create a new view | `php ftwo craft:view profile` |
| `php ftwo craft:service` | Create a new service class | `php ftwo craft:service EmailService` |
| `php ftwo craft:migration` | Create a new migration | `php ftwo craft:migration create_users_table` |

### Utility Commands

| Command | Description |
|---------|-------------|
| `php ftwo version` | Show framework version |
| `php ftwo --version` | Show framework version |
| `php ftwo -v` | Show framework version |
| `php ftwo make:session-table` | Create session table migration |

---

## 🎯 Routing

### Manual Routes

Define routes in `config/routes.php`:

```php
use Engine\Router;

// Basic routes
Router::get('/', 'HomeController@index');
Router::post('/users', 'UserController@store');
Router::put('/users/{id}', 'UserController@update');
Router::delete('/users/{id}', 'UserController@destroy');

// Closure routes
Router::get('/about', function() {
    return view('about');
});
```

### Magic Routing

FTwoDev automatically maps URLs to controllers:

- `/users` → `UserController::index()`
- `/users/create` → `UserController::create()`
- `/users/profile` → `UserController::profile()`
- `/admin/dashboard` → `AdminController::dashboard()`

---

## 🎨 Views & Templates

### Creating Views

Views are stored in `projects/Views/` with `.ftwo.php` extension:

```php
<!-- projects/Views/welcome.ftwo.php -->
<?php $this->extends('layout'); ?>

<?php $this->section('title'); ?>
Welcome Page
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<h1>Welcome to FTwoDev!</h1>
<p>Start building amazing applications.</p>
<?php $this->endSection(); ?>
```

### Layout System

Create layouts in `projects/Views/`:

```php
<!-- projects/Views/layout.ftwo.php -->
<!DOCTYPE html>
<html>
<head>
    <title><?= $this->section('title') ?></title>
</head>
<body>
    <div class="container">
        <?= $this->section('content') ?>
    </div>
</body>
</html>
```

### Rendering Views

In controllers:

```php
class HomeController extends ControllerBase
{
    public function index()
    {
        return $this->view('welcome', [
            'name' => 'John Doe',
            'users' => $this->getUsers()
        ]);
    }
}
```

---

## 🗄️ Database & Models

### Creating Models

```bash
php ftwo craft:model User
```

```php
<?php
namespace Projects\Models;

use Engine\ModelBase;

class User extends ModelBase
{
    protected $table = 'users';
    
    public function getAllUsers()
    {
        return $this->query("SELECT * FROM users");
    }
    
    public function createUser($data)
    {
        return $this->query(
            "INSERT INTO users (name, email) VALUES (?, ?)",
            [$data['name'], $data['email']]
        );
    }
}
```

### Migrations

Create migrations:

```bash
php ftwo craft:migration create_users_table
```

```php
<?php
namespace Projects\Migrations;

use Engine\MigrationBase;

class CreateUsersTable extends MigrationBase
{
    public function up()
    {
        $this->execute("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function down()
    {
        $this->execute("DROP TABLE users");
    }
}
```

Run migrations:

```bash
php ftwo ignite:migrate      # Run pending migrations
php ftwo ignite:rollback     # Rollback last batch
php ftwo ignite:fresh        # Drop all & re-run migrations
```

---

## 🎛️ Controllers

### Creating Controllers

```bash
php ftwo craft:controller UserController
```

```php
<?php
namespace Projects\Controllers;

use Engine\ControllerBase;
use Projects\Models\User;

class UserController extends ControllerBase
{
    public function index()
    {
        $users = (new User())->getAllUsers();
        return $this->view('users/index', compact('users'));
    }
    
    public function create()
    {
        return $this->view('users/create');
    }
    
    public function store()
    {
        $data = [
            'name' => $this->input('name'),
            'email' => $this->input('email')
        ];
        
        (new User())->createUser($data);
        return redirect('/users');
    }
}
```

### Controller Methods

Available methods in `ControllerBase`:

```php
// View rendering
$this->view('template', $data);

// Input handling
$this->input('field_name');
$this->input('field_name', 'default_value');

// Redirects
redirect('/path');

// JSON responses
return json(['status' => 'success']);
```

---

## 🌸 Bloom Auth System

Install the complete authentication system:

```bash
php ftwo ignite:bloom
php ftwo ignite:migrate
```

### What Bloom Includes:

- **AuthController** - Login, register, logout functionality
- **DashboardController** - Protected dashboard
- **AuthMiddleware** - Route protection
- **User Migration** - Database table for users
- **Auth Views** - Login, register, dashboard templates
- **Auth Routes** - Pre-configured authentication routes

### Available Routes After Bloom:

- `/login` - Login page
- `/register` - Registration page  
- `/dashboard` - Protected dashboard
- `/logout` - Logout functionality

### Using Authentication

```php
// In controllers
use CoreModules\AuthModule\Auth;

// Check if user is authenticated
if (Auth::check()) {
    // User is logged in
}

// Get current user
$user = Auth::user();

// Login attempt
if (Auth::attempt($username, $password)) {
    // Login successful
}

// Logout
Auth::logout();
```

---

## 🛡️ Middleware

### Creating Middleware

```php
<?php
namespace Projects\Middlewares;

use Engine\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle($request, $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        return $next($request);
    }
}
```

### Applying Middleware

In `config/middleware.php`:

```php
return [
    'auth' => Projects\Middlewares\AuthMiddleware::class,
];
```

---

## 🔧 Services

Create service classes for business logic:

```bash
php ftwo craft:service EmailService
```

```php
<?php
namespace Projects\Services;

class EmailService
{
    public function sendWelcomeEmail($user)
    {
        // Email sending logic
    }
    
    public function sendPasswordReset($email)
    {
        // Password reset logic
    }
}
```

---

## 🚀 Deployment

### Production Setup

1. **Environment Configuration**
   ```php
   // config/app.php
   'env' => 'production',
   'debug' => false,
   ```

2. **Web Server Configuration**
   - Point document root to `public/` directory
   - Enable URL rewriting (`.htaccess` included)

3. **Optimize Autoloader**
   ```bash
   composer install --no-dev --optimize-autoloader
   php ftwo ignite:refresh
   ```

4. **Database Migration**
   ```bash
   php ftwo ignite:migrate
   ```

---

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

### Development Setup

```bash
git clone https://github.com/Randa23356/ftwo-framework.git
cd ftwo-framework
composer install
php ftwo ignite:setup
```

---

## 📄 License

FTwoDev Framework is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🆘 Support

- **Documentation**: [https://ftwodev.com/docs](https://ftwodev.com/docs)
- **Issues**: [GitHub Issues](https://github.com/Randa23356/ftwo-framework/issues)
- **Discussions**: [GitHub Discussions](https://github.com/Randa23356/ftwo-framework/discussions)
- **Email**: dev@ftwodev.com

---

## 🙏 Acknowledgments

Built with ❤️ by the FTwoDev Team.

Special thanks to all contributors and the PHP community.

---

<div align="center">

**[⬆ Back to Top](#ftwodev-framework)**

Made with ❤️ by [FTwoDev Team](https://github.com/Randa23356)

</div>

---

## 🌍 Environment Configuration

FTwoDev supports environment-based configuration using `.env` files:

### Setup Environment

```bash
# Generate .env file (done automatically during installation)
php ftwo ignite:env
```

### Environment Variables

```bash
# Application
APP_NAME="My Application"
APP_ENV=local                    # local, production
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_KEY=base64:generated-key

# Database
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_database
DB_USERNAME=root
DB_PASSWORD=secret

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_COOKIE=ftwodev_session
```

### Using Environment Variables

```php
// In code
$appName = env('APP_NAME', 'Default App');
$debug = env('APP_DEBUG', false);

// In config files
'name' => env('APP_NAME', 'FTwoDev Application'),
'debug' => env('APP_DEBUG', true),
```

### Helper Functions

```php
env('APP_NAME');                    // Get environment variable
config('app.name');                 // Get config value
framework_version();                // Get framework version
```

---

## 📊 Session Management

FTwoDev includes a comprehensive session management system:

### Basic Session Operations

```php
use Engine\Session;

// Set session data
Session::put('key', 'value');
session('key', 'value');           // Helper function

// Get session data
$value = Session::get('key', 'default');
$value = session('key');           // Helper function

// Check if exists
Session::has('key');

// Remove session data
Session::forget('key');
Session::flush();                  // Clear all
```

### Flash Messages

```php
// Set flash message (available for next request only)
Session::flash('success', 'Operation successful!');
Session::flash('errors', ['Error 1', 'Error 2']);

// Get flash message (auto-removed after retrieval)
$message = Session::flash('success');

// In views (automatically available)
<?php if ($success): ?>
    <div class="alert-success"><?= $success ?></div>
<?php endif; ?>
```

### Form Handling with Sessions

```php
// In controller
public function store() {
    $name = $this->input('name');
    
    if (!$name) {
        return $this->withErrors(['Name is required']);
    }
    
    return $this->with('success', 'Saved!')->redirect('/');
}

// In view
<input type="text" name="name" value="<?= old('name') ?>">
<?php if ($errors): ?>
    <div class="alert-error">
        <?php foreach ($errors as $error): ?>
            <div><?= $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
```

### CSRF Protection

```php
// In forms
<?= csrf_field() ?>
// Generates: <input type="hidden" name="csrf_token" value="...">

// Manual token
$token = csrf_token();
```

### Session Configuration

Configure sessions in `config/session.php`:

```php
return [
    'driver' => env('SESSION_DRIVER', 'file'),
    'lifetime' => env('SESSION_LIFETIME', 120),
    'files' => storage_path('sessions'),
    'cookie' => env('SESSION_COOKIE', 'ftwodev_session'),
];
```

---

## 🎭 Dynamic Views

FTwoDev features intelligent views that adapt to your application state:

### Smart Navigation

The framework automatically detects whether Bloom Auth is installed and adjusts the navigation accordingly:

**Fresh Install:**
- Home, Features, Docs links
- "Install Bloom Auth" call-to-action

**After Bloom Install:**
- Home, Login, Register links (when not logged in)
- Home, Dashboard, Logout links (when logged in)

### Adaptive Welcome Page

The welcome page changes based on framework state:

```php
<?php if (file_exists(__DIR__ . '/../Controllers/AuthController.php')): ?>
    <!-- Bloom is installed - show auth-ready content -->
<?php else: ?>
    <!-- Fresh install - show getting started content -->
<?php endif; ?>
```

### Interactive Installation Guide

For fresh installations, the welcome page includes:
- Interactive modal with Bloom installation instructions
- Step-by-step command guide
- Feature showcase and benefits

---

## 🔄 Version Management

FTwoDev includes built-in version management:

### Version Commands

```bash
php ftwo version        # Show version info
php ftwo --version      # Show version info
php ftwo -v            # Show version info
```

### Version in Code

```php
// Get framework version
$version = framework_version();     // Returns "1.4.0"

// Access version constant
$version = \Engine\Boot::VERSION;   // "1.4.0"
```

### Version in Views

```php
<!-- Display current version -->
Version <?= framework_version() ?> is live
```

---

## 🌸 Enhanced Bloom Auth System

The Bloom Auth system has been enhanced with better integration:

### Automatic Route Registration

When you install Bloom, routes are automatically added to your `routes.php`:

```php
// Auth Routes (Added by Bloom)
Router::get('/login', 'AuthController@showLogin');
Router::post('/login', 'AuthController@login');
Router::get('/register', 'AuthController@showRegister');
Router::post('/register', 'AuthController@register');
Router::get('/logout', 'AuthController@logout');
Router::get('/dashboard', 'DashboardController@index');
```

### What Bloom Includes (Updated)

- **AuthController** - Enhanced with session integration
- **DashboardController** - Protected dashboard with user context
- **AuthMiddleware** - Route protection with session management
- **User Migration** - Database table for users
- **Auth Views** - Responsive login, register, dashboard templates
- **Auth Module** - Session-based authentication
- **Dynamic Navigation** - Auto-updating navigation based on auth state

### Enhanced Authentication Flow

```php
// Enhanced session-based authentication
use CoreModules\AuthModule\Auth;

// Check authentication with session integration
if (Auth::check()) {
    $user = Auth::user();
    // User data available in session
}

// Login with session management
if (Auth::attempt($username, $password)) {
    // Session automatically managed
    // Flash messages for feedback
    return redirect('/dashboard');
}

// Logout with session cleanup
Auth::logout();
// All session data properly cleared
```

---

## 🚀 What's New in v1.4.0

### Major Features Added

- **🌍 Environment Configuration** - Complete .env file support
- **📊 Session Management** - Comprehensive session handling system
- **🎭 Dynamic Views** - Smart UI adaptation based on framework state
- **🔄 Version Management** - Built-in version tracking and display
- **🌸 Enhanced Bloom Auth** - Improved authentication with session integration
- **🛠️ New CLI Commands** - Additional commands for better development experience

### New Commands

- `php ftwo ignite:env` - Generate .env file
- `php ftwo ignite:fresh` - Drop all tables & re-run migrations
- `php ftwo version` - Show framework version
- `php ftwo make:session-table` - Create session table migration

### Enhanced Features

- **Automatic .env generation** during installation
- **Session-based CSRF protection**
- **Flash message system** for user feedback
- **Dynamic navigation** based on authentication state
- **Interactive installation guides**
- **Improved error handling** with session integration

---