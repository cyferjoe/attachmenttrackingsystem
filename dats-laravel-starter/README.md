# Digital Attachment Tracking System - Laravel Starter Pack

This package gives you a **Laravel 11 starter implementation** for your JKUAT BBIT final year project:
**Digital Attachment Tracking System (DATS)**.

It is designed around the project proposal modules:
- user registration and authentication
- role-based access for **student** and **lecturer**
- attachment opportunity posting
- student applications
- digital logbook entries
- lecturer review and feedback
- manual page and API endpoints for Postman testing

## What this download contains

- `starter-pack/` - Laravel files to copy into a fresh Laravel 11 project
- `docs/BACKEND_IMPLEMENTATION_GUIDE.md` - step-by-step backend guide
- `docs/ERD.md` - entity relationship diagram in Mermaid
- `postman/DATS_API.postman_collection.json` - API test collection
- `scripts/install_on_fresh_laravel.sh` - helper installer
- `docs/Digital_Attachment_Tracking_System_Proposal.docx` - your proposal copy

## Recommended stack

- Backend: Laravel 11 (PHP 8.2+)
- Database: MySQL or PostgreSQL
- Frontend: Bootstrap 5 + JavaScript
- Testing: Postman + PHP Feature Tests
- Version control: Git + GitHub

## Fast setup on your machine

### 1. Prerequisites
Install:
- PHP 8.2 or later
- Composer
- MySQL or PostgreSQL
- Git
- Node.js (optional, only if you later want Vite asset compilation)

### 2. Create a fresh Laravel project
```bash
composer create-project laravel/laravel dats-laravel
```

### 3. Copy the starter code into the new Laravel project
Option A:
```bash
cp -R starter-pack/* dats-laravel/
```

Option B:
```bash
bash scripts/install_on_fresh_laravel.sh dats-laravel
```

### 4. Configure your database
For MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dats_db
DB_USERNAME=root
DB_PASSWORD=
```

For PostgreSQL:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dats_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 5. Run Laravel setup
```bash
cd dats-laravel
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open:
```text
http://127.0.0.1:8000
```

## Demo accounts

These are seeded into the database:

- Lecturer: `lecturer@jkuat.ac.ke` / `password123`
- Student: `student@students.jkuat.ac.ke` / `password123`

## Main routes

### Web
- `/` - landing page
- `/login` - shared login
- `/register/student` - student sign up
- `/register/lecturer` - lecturer sign up
- `/dashboard` - smart dashboard
- `/opportunities` - browse opportunities
- `/student/applications` - student applications
- `/student/logbooks` - student logbook list
- `/student/logbooks/create` - create logbook entry
- `/lecturer/opportunities/create` - lecturer posts opportunities
- `/lecturer/reviews` - lecturer review center
- `/manual` - embedded user manual

### API
- `POST /api/v1/register/student`
- `POST /api/v1/register/lecturer`
- `POST /api/v1/login`
- `GET /api/v1/me`
- `POST /api/v1/logout`
- `GET /api/v1/opportunities`
- `POST /api/v1/opportunities`
- `POST /api/v1/opportunities/{opportunity}/apply`
- `GET /api/v1/logbooks`
- `POST /api/v1/logbooks`
- `PATCH /api/v1/logbooks/{logbookEntry}/review`

## GitHub push steps

```bash
git init
git add .
git commit -m "Initial DATS Laravel project"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/dats-laravel.git
git push -u origin main
```

## Notes

This package was prepared as a **starter pack overlay** for a fresh Laravel 11 app because Composer was not available in the build environment used to generate this archive. The PHP source files were syntax-linted, and the structure is ready to copy into a new Laravel project on your machine.
