# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**Learnify** — a Laravel 13 e-learning web application with Laravel Breeze authentication. Two-role system (student / teacher) with class management, enrollment, and a quiz engine.

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
php artisan storage:link             # Required for profile photo uploads
```

## Architecture

### Stack
- **Laravel 13** (PHP 8.3+), **Blade** templates, **Tailwind CSS v3**, **Alpine.js**, **Vite**
- **SQLite** by default (both dev and test). Switch to MySQL/Postgres via `DB_CONNECTION` in `.env`.
- **Laravel Breeze** provides auth scaffolding — extend, don't replace Breeze controllers.

### User roles
Two roles: `student` (default) and `teacher`, stored as a string column on `users`.

- `RoleMiddleware` (alias `role`) is registered in `bootstrap/app.php`. Usage: `middleware('role:teacher')`.
- After login, `AuthenticatedSessionController` checks `$user->role` to redirect each role to its dashboard.
- Controllers: `App\Http\Controllers\Student\DashboardController` and `App\Http\Controllers\Teacher\DashboardController` — each handles all routes for that role.
- Views: `resources/views/student/` and `resources/views/teacher/`.
- Routes: `/student/...` (name prefix `student.`) and `/teacher/...` (name prefix `teacher.`) in `routes/web.php`.

### Data model
```
User ──< Enrollment >── ClassRoom ── Quiz ──< QuizQuestion ──< QuizOption
                                                     │
                                               QuizAttempt ──< QuizAttemptAnswer
User ──< ChapterProgress
User ──< CalendarReminder
```

- `ClassRoom`: belongs to a teacher (`User`), has many students via `enrollments` pivot. Fields: `teacher_id`, `name`, `code` (e.g. `CLS-ABC123`, auto-generated), `color`, `subject`. Computed attributes: `$bg` (card background CSS class), `$colorClass`, `$subjectLabel`.
- `Quiz`: one per `ClassRoom`. Has many `QuizQuestion`s (ordered by `sort_order`).
- `QuizQuestion`: three types — `objective` (multiple choice with `QuizOption`s), `subjective` (free text, graded manually), `circuit` (free text with a circuit-diagram context). Stores `answer` and `hint` for subjective/circuit; options handle correct answer for objective.
- `QuizAttempt`: one per student per quiz. `submitted_at` is null while in progress, set on submission. Stores `score` (correct objective answers) and `total` (total objective questions).
- `QuizAttemptAnswer`: one record per question per attempt. `selected_option` for objective, `answer_text` for subjective/circuit, `is_correct` auto-set for objective only.
- `ChapterProgress`: tracks how far a student has read through a chapter. Fields: `student_id`, `chapter_slug` (e.g. `resistance`), `sections_reached` (0–3). Used to compute notes progress percentage (sections_reached / 3 * 100).
- `CalendarReminder`: per-teacher calendar events. Fields: `user_id`, `date`, `event_name`, `event_details`. CRUD via `teacher.reminders.*` routes; managed from the teacher dashboard calendar.
- Profile photos stored via `Storage::disk('public')` in `profile-photos/`. Path saved in `users.profile_photo_path`.

### Quiz flow
- **Teacher** creates/edits a quiz via the Alpine.js-powered quiz editor (`teacher.quiz-editor` view). Up to 10 questions. Saved via `POST /teacher/edit-quiz/{classRoom}` returning JSON.
- **Student** takes a quiz question-by-question (`GET /student/quiz/{classRoom}?q=N`). Answers are saved to an in-progress `QuizAttempt` on each step. Submitting the last question finalizes the attempt. Students can retake (deletes all prior attempts).

### Class enrollment
- Teacher creates a class → generates a unique `CLS-XXX999` code.
- Student searches by code (`GET /student/learning-module/search-class?code=...` returns JSON), then enrolls (`POST /student/learning-module/enroll`).
- Unenroll via `DELETE /student/learning-module/{classRoom}`.

### Layouts and components
- `resources/views/layouts/app.blade.php` — authenticated layout used by both roles.
- `resources/views/components/student/sidebar.blade.php` and `resources/views/components/teacher/sidebar.blade.php` — role-specific sidebars.
- Standard Breeze components (`x-input-label`, `x-text-input`, etc.) are in `resources/views/components/`.
- The login page (`resources/views/auth/login.blade.php`) uses a custom two-panel design with **inline `<style>` CSS** (not Tailwind) — keep this consistent for other custom auth pages.

### Auth & environment
- Email verification is scaffolded but **disabled** — `MustVerifyEmail` is commented out in `User.php`.
- `MAIL_MAILER=log` by default — emails go to `storage/logs/laravel.log`.
- Logo: `public/images/learnify-logo.png`.

## Deployment

**Decided option: Raw DigitalOcean Droplet ($6/mo)** — no Forge needed for a single app.

### Stack on the Droplet
- Ubuntu 22.04, Nginx + PHP 8.3-FPM, MySQL 8, Certbot (free SSL), Supervisor (queue worker)

### Key env vars to set on server
```env
APP_ENV=production
APP_KEY=          # php artisan key:generate --show
APP_URL=          # https://yourdomain.com
DB_CONNECTION=mysql
QUEUE_CONNECTION=database
```

### One-time setup steps (SSH into droplet)
1. Install: `apt install nginx php8.3 php8.3-fpm mysql-server composer nodejs`
2. Clone repo, run `composer install --no-dev`, `npm run build`
3. Configure Nginx server block pointing to `/public`
4. `php artisan migrate --force && php artisan storage:link`
5. Set up Supervisor for queue worker (`php artisan queue:listen`)
6. SSL via Certbot: `certbot --nginx`

### Deploys (manual)
```bash
git pull && composer install --no-dev && npm run build && php artisan migrate --force && php artisan config:cache && php artisan route:cache
```

> Storage disk is local — profile photos persist on the droplet. If you later need CDN/multi-server, swap to S3/Cloudflare R2.

### Physics notes (student)
- The only content module is "Resistance" (`student.chapter.resistance`). Students read it section-by-section; progress is saved via `POST /student/learning-module/physics/resistance/progress` which upserts a `ChapterProgress` record (`sections_reached` max 3).
- `ChapterProgress` drives the notes-progress percentage shown on the teacher dashboard and class-students view.
