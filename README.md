# Personal Portfolio - Laravel 12 + Livewire 4 + Tailwind 4

Modern personal portfolio website with admin dashboard built using Laravel 12, Livewire 4, and Tailwind CSS 4. Features smooth scroll SPA navigation on landing page and full SPA experience in dashboard.

## Features

### Landing Page
- ✅ Smooth scroll SPA with active section detection
- ✅ Modern dark theme with gradient accents
- ✅ Hero section with animated gradient text
- ✅ About section with profile information
- ✅ Skills section grouped by category with progress bars
- ✅ Featured projects showcase
- ✅ Contact form with Livewire
- ✅ Responsive design

### Dashboard
- ✅ Full SPA with Livewire 4 wire:navigate
- ✅ Projects CRUD with image upload
- ✅ Skills management with drag-to-reorder
- ✅ Work experience timeline
- ✅ Messages inbox with read/unread status
- ✅ Profile settings
- ✅ Statistics cards
- ✅ Dark theme UI

## Tech Stack

- **Laravel 12** - PHP Framework
- **Livewire 4** - Full-stack framework with SPA mode
- **Tailwind CSS 4** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework (bundled with Livewire)
- **SQLite** - Database
- **Docker** - Containerization
- **Vite** - Frontend build tool

## Prerequisites

- Docker & Docker Compose
- Git

## Installation

### 1. Clone or navigate to project directory

```bash
cd my-portfolio
```

### 2. Start Docker containers

```bash
docker-compose up -d --build
```

### 3. Install dependencies

```bash
# Install PHP dependencies
docker exec portfolio-app composer install

# Install Node dependencies
docker exec portfolio-node npm install
```

### 4. Setup environment

```bash
# Copy environment file (already done)
docker exec portfolio-app cp .env.example .env

# Generate application key (already done)
docker exec portfolio-app php artisan key:generate

# Create SQLite database
docker exec portfolio-app touch database/database.sqlite
```

### 5. Run migrations and seeders

```bash
docker exec portfolio-app php artisan migrate --seed
```

### 6. Create storage symlink

```bash
docker exec portfolio-app php artisan storage:link
```

### 7. Build frontend assets

```bash
docker exec portfolio-node npm run build
```

## Running the Application

### Development mode

```bash
# Start all containers
docker-compose up -d

# Run Vite dev server for hot reload (optional)
docker exec portfolio-node npm run dev
```

### Access the application

- **Landing Page**: http://localhost:8000
- **Dashboard**: http://localhost:8000/dashboard
- **Login**: http://localhost:8000/login

### Default Admin Credentials

- **Email**: admin@example.com
- **Password**: password

## Docker Commands

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View logs
docker-compose logs -f

# Access PHP container
docker exec -it portfolio-app bash

# Access Node container
docker exec -it portfolio-node sh

# Run artisan commands
docker exec portfolio-app php artisan [command]

# Run npm commands
docker exec portfolio-node npm [command]
```

## Project Structure

```
my-portfolio/
├── app/
│   ├── Livewire/          # Livewire components
│   └── Models/            # Eloquent models
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/           # Demo data seeders
├── docker/
│   ├── Dockerfile         # PHP-FPM container
│   └── nginx.conf         # Nginx configuration
├── resources/
│   ├── css/
│   │   └── app.css        # Tailwind CSS
│   ├── js/
│   │   └── app.js         # Alpine.js & Livewire
│   └── views/
│       ├── welcome.blade.php    # Landing page
│       ├── layouts/             # Layout files
│       └── livewire/            # Livewire views
├── routes/
│   └── web.php            # Application routes
├── docker-compose.yml     # Docker services
└── vite.config.js         # Vite configuration
```

## Database Schema

### Tables
- **users** - Admin users
- **profiles** - Portfolio profile (name, bio, social links)
- **projects** - Portfolio projects with tech stack
- **skills** - Skills with levels and categories
- **experiences** - Work experience timeline
- **messages** - Contact form submissions

## Features Detail

### Livewire 4 SPA Mode
All dashboard navigation uses `wire:navigate` for instant page transitions without full page reloads. Progress bar shows during navigation.

### Landing Page Smooth Scroll
Alpine.js handles smooth scrolling between sections with active state detection using Intersection Observer API.

### File Uploads
- Project images stored in `storage/app/public/projects`
- Profile photos stored in `storage/app/public/profile`
- Max file size: 2MB
- Supported formats: jpg, jpeg, png, webp

### Dark Theme
Consistent dark theme throughout:
- Background: `#0a0a0a` to `#1a1a1a`
- Cards: `#1e1e1e`
- Accent: Purple-Indigo gradient

## Common Tasks

### Add new project
1. Login to dashboard
2. Go to Projects → Create New Project
3. Fill form and upload image
4. Mark as "Featured" to show on landing page

### Manage skills
1. Go to Skills in dashboard
2. Click "Add New Skill"
3. Use up/down arrows to reorder
4. Skills are grouped by category

### View messages
1. Go to Messages in dashboard
2. Click message to view details
3. Mark as read/unread or delete

### Update profile
1. Go to Profile in dashboard
2. Update information and social links
3. Upload new photo if needed

## Troubleshooting

### Port already in use
Edit `docker-compose.yml` and change ports:
```yaml
ports:
  - "8080:80"  # Change 8000 to 8080
```

### Assets not loading
```bash
docker exec portfolio-node npm run build
docker exec portfolio-app php artisan storage:link
```

### Database errors
```bash
docker exec portfolio-app php artisan migrate:fresh --seed
```

### Clear cache
```bash
docker exec portfolio-app php artisan config:clear
docker exec portfolio-app php artisan cache:clear
docker exec portfolio-app php artisan view:clear
```

## Development

### Running tests
```bash
docker exec portfolio-app php artisan test
```

### Code formatting
```bash
docker exec portfolio-app ./vendor/bin/pint
```

### Create new Livewire component
```bash
docker exec portfolio-app php artisan make:livewire ComponentName
```

## Production Deployment

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Generate new `APP_KEY`
4. Use MySQL/PostgreSQL instead of SQLite
5. Configure proper mail driver
6. Enable HTTPS
7. Set up queue workers
8. Configure scheduled tasks

## License

Open source - feel free to use for your own portfolio.

## Support

For issues or questions, open an issue on GitHub.

---

Built with ❤️ using Laravel 12, Livewire 4, and Tailwind CSS 4
