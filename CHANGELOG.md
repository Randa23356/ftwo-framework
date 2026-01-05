# FTwoDev Framework Changelog

## [1.5.0] - 2026-01-06

### 🚀 **Major Features Added**

#### **ORM Enhancement**
- ✅ **QueryBuilder Class** - Fluent interface for SQL queries
- ✅ **Active Record Pattern** - Magic methods & attribute management
- ✅ **Complete Relationship System** - hasOne, hasMany, belongsTo, belongsToMany, hasManyThrough
- ✅ **Automatic Timestamps** - created_at & updated_at management
- ✅ **Soft Deletes** - Trash system with restore functionality
- ✅ **Mass Operations** - Bulk insert/update/delete
- ✅ **Scopes** - Reusable query logic

#### **Validation System**
- ✅ **Validator Class** - Fluent interface with 25+ built-in rules
- ✅ **Custom Rule System** - Extensible validation rules
- ✅ **ValidatesRequests Trait** - Controller integration
- ✅ **ValidationHelper** - Quick validation helpers
- ✅ **Error Handling** - User-friendly error messages
- ✅ **ORM Integration** - Database validation (unique, exists)
- ✅ **API Support** - JSON validation responses
- ✅ **AJAX Support** - Real-time field validation

### 🔧 **Enhanced Bloom Auth**
- ✅ **Updated AuthController** - Using new validation system
- ✅ **Enhanced User Model** - With ORM features
- ✅ **Improved AuthModule** - Compatible with new ORM
- ✅ **Better Migration Schema** - Enhanced users table structure

### 📁 **New Files Added**
- `engine/QueryBuilder.php` - Query builder with fluent interface
- `engine/Validator.php` - Core validation class
- `engine/Traits/ValidatesRequests.php` - Controller validation trait
- `engine/ValidationHelper.php` - Validation helper functions
- `engine/Relationship.php` - Relationship system classes
- `VALIDATION_GUIDE.md` - Complete validation documentation

### 🔄 **Updated Files**
- `engine/ModelBase.php` - Enhanced with ORM features
- `engine/ControllerBase.php` - Added ValidatesRequests trait
- `core-modules/CLIModule/stubs/Auth/*` - Updated for ORM compatibility
- `composer.json` - Version bump to 1.5.0
- `engine/Boot.php` - Version bump to 1.5.0

### 🎯 **Breaking Changes**
- **ModelBase** - Legacy query methods renamed to `rawQuery()` (backward compatible)
- **AuthModule** - Updated to use new ORM system (backward compatible)

### 🛠️ **Improvements**
- **Performance** - Optimized query building and validation
- **Developer Experience** - Better error messages and debugging
- **Documentation** - Complete guides for ORM and Validation

### 🐛 **Bug Fixes**
- Fixed autoloader issues in install.php
- Fixed relationship class syntax errors
- Fixed validation rule parsing

---

## [1.4.0] - Previous Release

### Features
- Bloom Auth System
- CLI Commands
- Migration System
- View Engine
- Routing System

---

## 📋 **Upgrade Instructions**

### From v1.4.0 to v1.5.0

1. **Update Composer:**
```bash
composer update ftwodev/framework
```

2. **Refresh Autoloader:**
```bash
php ftwo ignite:refresh
```

3. **Run Bloom Auth (if using):**
```bash
php ftwo ignite:bloom
php ftwo ignite:migrate
```

4. **Update Controllers (Optional):**
```php
// Add validation to your controllers
use Engine\Traits\ValidatesRequests;

class YourController extends ControllerBase
{
    // Now you can use $this->validate()
}
```

### Migration from Manual Validation

```php
// Old way
if (empty($name)) $errors[] = 'Name required';

// New way
$validator = Validator::make($data, ['name' => 'required']);
```

---

## 🔮 **Coming Soon (v1.6.0)**
- API Development Kit
- Cache System
- Queue System
- Admin Panel Generator

---

**Note:** This version includes major ORM and Validation enhancements while maintaining backward compatibility.
