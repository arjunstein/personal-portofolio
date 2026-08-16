# AGENTS.md — Developer Portfolio & CMS

This document provides architectural context, development standards, Docker workflows, and coding conventions for AI agents and developers working on this codebase.

---

## 1. Project Overview

- **Project Type**: Personal Developer Portfolio & Content Management System (CMS)
- **Framework**: Laravel 12.x (PHP 8.3)
- **Frontend / Reactivity**: Livewire 4.x, Livewire Volt, Alpine.js, Tailwind CSS v4
- **Database**: SQLite (local/testing) & MySQL support
- **Containerization**: Docker Compose (PHP-FPM 8.3 with OPcache & JIT, Nginx with Gzip & static caching, Node.js 20)
- **Build Tool**: Vite 7.x

---

## 2. Directory & Architecture Map

```
my-portfolio/
├── app/
│   ├── Http/Controllers/    # Standard controllers (Auth, etc.)
│   ├── Http/Middleware/     # Page view tracking, auth guards
│   ├── Livewire/            # Livewire components (Dashboard, Projects, Skills, Experiences, etc.)
│   └── Models/              # Eloquent models (Profile, Skill, Experience, Project, Message, User)
├── database/
│   ├── migrations/          # Schema definitions
│   └── seeders/             # Initial demo data & admin credentials
├── docker/
│   ├── Dockerfile           # Optimized PHP 8.3-FPM with OPcache & JIT
│   ├── nginx.conf           # Gzip compression, asset caching, security headers
│   └── php/                 # Custom php.ini, opcache.ini, fpm-pool.conf
├── resources/
│   ├── css/app.css          # Tailwind CSS v4 design tokens, glassmorphism, fonts
│   ├── js/app.js            # Frontend scripts & Alpine integration
│   └── views/
│       ├── layouts/         # Master layouts (dashboard, app, guest)
│       ├── livewire/        # Livewire Blade view templates
│       └── welcome.blade.php # Main public portfolio landing page (Bento Grid layout)
├── routes/
│   ├── web.php              # Public & protected dashboard routes
│   └── auth.php             # Authentication routes (Breeze/Volt)
├── tests/
│   ├── Feature/             # Feature & authentication tests
│   └── Unit/                # Unit test suite
└── docker-compose.yml       # Container orchestration (app, nginx, node)
```

---

## 3. Docker & Execution Rules

> [!IMPORTANT]
> **Always run PHP, Composer, Artisan, and NPM commands using Docker Compose.**
> Do not attempt to run `php` or `npm` directly on the host machine unless explicitly requested.

### Common Docker Commands

| Action | Command |
| :--- | :--- |
| **Start Containers** | `docker compose up -d` |
| **Rebuild Containers** | `docker compose up -d --build` |
| **Run Test Suite** | `docker compose exec app php artisan test` |
| **Run Migrations** | `docker compose exec app php artisan migrate` |
| **Run Seeders** | `docker compose exec app php artisan db:seed` |
| **Build Frontend (Vite)** | `docker compose run --rm node npm run build` |
| **Vite Dev Server** | `docker compose run --rm -p 5174:5173 node npm run dev` |
| **Clear Laravel Cache** | `docker compose exec app php artisan optimize:clear` |
| **Interactive Tinker** | `docker compose exec app php artisan tinker` |

---

## 4. UI/UX & Styling Standards

The project follows a **Modern Dark Tech & Glassmorphism** aesthetic:

- **Typography**:
  - Headings / Display: `'Space Grotesk', sans-serif`
  - Body Text: `'Plus Jakarta Sans', sans-serif`
  - Code / Tech Tags / Numbers: `'JetBrains Mono', monospace`
- **Color Palette**:
  - Background Canvas: `#080c14` (Deep cosmic dark)
  - Surface / Panels: `#0f172a` (`rgba(15, 23, 42, 0.65)` with backdrop-blur)
  - Card Surfaces: `#141e33` (`.glass-card`, `.glass-card-hover`)
  - Accent Gradients: Purple (`#8b5cf6`), Indigo (`#6366f1`), Cyan (`#06b6d4`), Emerald (`#10b981`)
- **UI Guidelines**:
  - Use Bento Box Grid layouts with varied spans for high visual interest.
  - Maintain WCAG AA 4.5:1 text contrast ratio on dark backgrounds.
  - Interactive elements must have smooth hover transitions (150ms–300ms) and visible focus rings.
  - Use SVG icons (Heroicons/Lucide) exclusively. **Never use emojis as icons**.
  - All public views must be mobile-responsive (375px, 768px, 1024px, 1440px).

---

## 5. Backend & Laravel Conventions

Follow modern Laravel 12 & Livewire 4 conventions:

1. **Routing**:
   - Group dashboard routes under `dashboard.` name prefix and `['auth', 'verified']` middleware.
   - Use Route Model Binding where applicable.
2. **Livewire Components**:
   - Keep business logic in dedicated models or action classes.
   - Use `wire:loading` states on all form submission and asynchronous action buttons.
   - Always validate user inputs with `$this->validate()` or Form Requests.
3. **Database & Eloquent**:
   - Prevent N+1 queries by eager-loading relationships (`with(...)`).
   - Use explicit `$fillable` or `$guarded` attributes on Eloquent models.
4. **Testing**:
   - Every route and user flow should have a corresponding test in `tests/Feature/`.
   - Ensure all feature tests use `RefreshDatabase` trait.
   - Always run `docker compose exec app php artisan test` before concluding tasks.
