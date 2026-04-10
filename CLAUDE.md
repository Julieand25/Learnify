# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**Learnify** — a Laravel 13 e-learning web application with Laravel Breeze authentication. Currently in early setup: auth scaffold is in place, core learning features (courses, enrollments, etc.) have not yet been built.

## Commands

### Development (all-in-one)
```bash
composer dev
# Starts: php artisan serve, queue:listen, pail (log viewer), and npm run dev (Vite) concurrently
```

### Individual servers
```bash
php artisan serve          # Laravel dev server → http://localhost:8000
npm run dev                # Vite HMR for CSS/JS
```

### Build frontend assets
```bash
npm run build
```

### Database
```bash
php artisan migrate                  # Run pending migrations
php artisan migrate:fresh --seed     # Wipe and re-seed
php artisan tinker                   # REPL with full app context
```

### Testing
```bash
composer test                        # Clear config cache then run full suite
php artisan test                     # Run all tests
php artisan test --filter TestName   # Run a single test class or method
php artisan test tests/Feature/Auth/LoginTest.php  # Run a specific file
```

Tests use SQLite in-memory (`DB_DATABASE=:memory:`) — no real database needed.

### Code style
```bash
./vendor/bin/pint                    # Auto-fix PHP style (Laravel Pint)
./vendor/bin/pint --test             # Check without fixing
```

### First-time setup
```bash
composer setup
# Runs: composer install, copies .env, generates app key, migrates, npm install, npm run build
```

## Architecture

### Stack
- **Laravel 13** (PHP 8.3+), **Blade** templates, **Tailwind CSS v3**, **Alpine.js**, **Vite**
- **SQLite** by default (both dev and test). Switch to MySQL/Postgres via `DB_CONNECTION` in `.env`.
- **Laravel Breeze** provides all auth scaffolding — do not replace Breeze controllers, extend them instead.

### Key directories
- `app/Http/Controllers/Auth/` — Breeze auth controllers (login, register, password reset, email verification). Do not modify these unless intentionally changing auth flow.
- `app/Http/Controllers/` — application controllers go here (e.g. `CourseController`, `EnrollmentController`)
- `app/Models/` — Eloquent models. Only `User` exists currently.
- `routes/web.php` — main app routes. Auth routes are in `routes/auth.php` (auto-required).
- `resources/views/` — Blade views. Auth views are in `views/auth/`. Shared UI components are in `views/components/`. Layouts are in `views/layouts/`.
- `database/migrations/` — only the three default Laravel tables exist (users, cache, jobs). All new features need migrations.

### Auth flow
- Login page (`resources/views/auth/login.blade.php`) has a **custom full-page design** (not using `x-guest-layout`) — two-panel layout with Learnify branding on the left, teal form panel on the right, using Poppins font loaded from Google Fonts.
- All other auth views (`register`, `forgot-password`, etc.) still use the default `x-guest-layout` Breeze layout — these will need the same custom treatment eventually.
- Email verification is scaffolded but **disabled** — `MustVerifyEmail` is commented out in `User.php`. The dashboard route uses `verified` middleware, so enabling it requires uncommenting that interface.
- Logo image must be placed at `public/images/learnify-logo.png`.

### Frontend
- Tailwind config is in `tailwind.config.js`. Vite config is in `vite.config.js`.
- The login page uses **inline `<style>` CSS** (not Tailwind) — keep this consistent for other custom auth pages.
- Alpine.js is available globally via `resources/js/app.js`.

### Environment
- `MAIL_MAILER=log` by default — emails are written to `storage/logs/laravel.log`, not sent.
- `DB_CONNECTION=sqlite` with no file path means it uses `database/database.sqlite`. Create it with `touch database/database.sqlite` if missing.

### User roles
The app has two roles: `student` (default) and `teacher`. Both share the same login page but are redirected to separate dashboards after login.

- Role is stored as an `enum('student', 'teacher')` column on the `users` table (not yet migrated — still to be built).
- Redirect logic lives in `app/Http/Controllers/Auth/AuthenticatedSessionController.php` — check `$user->role` there to send each role to the correct dashboard.
- A `RoleMiddleware` (alias `role`) guards routes — registered in `bootstrap/app.php`. Usage: `middleware('role:teacher')`.
- Controllers are namespaced by role: `App\Http\Controllers\Student\` and `App\Http\Controllers\Teacher\`.
- Views follow the same split: `resources/views/student/` and `resources/views/teacher/`.
- Routes are grouped by role with a prefix: `/student/...` (name prefix `student.`) and `/teacher/...` (name prefix `teacher.`).
