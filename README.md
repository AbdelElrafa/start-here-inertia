# Start Here — Laravel Inertia React Starter Kit

A batteries-included Laravel starter kit with Inertia.js, React 19, and modern tooling for building production-ready applications.

## Features

### 🔐 Authentication (Laravel Fortify)

- Login / Register / Logout
- Email verification
- Password reset
- Two-factor authentication (2FA) with QR codes and recovery codes
- Password confirmation for sensitive actions

### 🧭 Wayfinder (dev-next)

Type-safe routing between Laravel and TypeScript:

- **Controller actions** — Import routes directly from `@/actions/`
- **Named routes** — Import from `@/routes/`
- **Model types** — Full TypeScript types for Eloquent models
- **Inertia shared data** — Typed `usePage().props`
- **Environment variables** — Typed `import.meta.env.VITE_*`
- **Form variants** — `.form()` method for Inertia forms

### 📊 Activity Logging (Spatie)

Automatic activity logging on all models:

- `LogsModelActivity` trait for easy integration
- Tracks creates, updates, and deletes
- Stores old and new values

### 🔒 Type Safety

- **PHPStan** at max level with cognitive complexity rules
- **TypeAs** — Type-safe value coercion
- **ConfigAs** — Type-safe config access
- **Strict models** — Prevents lazy loading and silent failures

### 🆔 UUID Support

- All models use UUID v7 via `HasUuids` trait
- Custom model stub generates UUIDs automatically
- Separate `uuid` column (keeps integer `id` for performance)

### 🧪 Testing & Quality

- **Pest** for elegant PHP testing
- **PHPStan** with Larastan for static analysis
- **Pint** for code formatting
- **Composer License Checker** for dependency auditing
- Parallel test execution

### 🎨 Frontend Stack

- **React 19** with automatic JSX runtime
- **Tailwind CSS v4** with Vite plugin
- **TypeScript** with strict mode
- **Radix UI** primitives for accessible components
- **Lucide** icons

## Quick Start

```bash
# Clone the template
gh repo create my-app --template AbdelElrafa/start-here-inertia

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start development
composer run dev
```

## Scripts

```bash
# Development
composer run dev          # Start PHP + Vite dev servers
npm run dev               # Vite dev server only
npm run build             # Production build

# Testing
composer test             # Run all checks (license, PHPStan, Pint, Pest)
php artisan test          # Run Pest tests only

# Code Quality
vendor/bin/pint           # Fix code style
vendor/bin/phpstan        # Static analysis
```

## Project Structure

```
app/
├── Concerns/
│   ├── LogsModelActivity.php    # Activity logging trait
│   ├── PasswordValidationRules.php
│   └── ProfileValidationRules.php
├── helpers.php                  # Type-safe user() helper
├── Models/
│   └── User.php                 # With UUIDs & activity logging
└── Providers/
    ├── AppServiceProvider.php   # Strict models, Vite macros
    └── FortifyServiceProvider.php

config/
├── activitylog.php              # Spatie activity log config
└── wayfinder.php                # Wayfinder generation options

stubs/
└── model.stub                   # Custom model template with UUIDs

docs/
└── development-sops/            # Standard operating procedures
```

## Configuration

### Wayfinder (`config/wayfinder.php`)

```php
'generate' => [
    'models' => true,                    // Generate model types
    'inertia.shared_data' => true,       // Generate shared props types
    'environment_variables' => true,     // Generate env types
    'enums' => true,                     // Generate PHP enum types
],
```

### PHPStan (`phpstan.neon.dist`)

```yaml
parameters:
    level: max
    cognitive_complexity:
        class: 50
        function: 8
```

## Creating Models

```bash
php artisan make:model Post -mf
```

Models are automatically generated with:
- `HasUuids` trait
- `LogsModelActivity` trait
- Guarded attributes
- `uniqueIds()` method

## License

MIT
