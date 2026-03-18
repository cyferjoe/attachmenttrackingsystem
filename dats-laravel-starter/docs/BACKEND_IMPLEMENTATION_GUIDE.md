# Step-by-Step Backend Implementation Guide
## Digital Attachment Tracking System (Laravel + MySQL/PostgreSQL)

This guide shows you how to build the backend for your project using:

- **Laravel (PHP)** for business logic and routing
- **MySQL or PostgreSQL** for storage
- **Bootstrap + JavaScript** for the interface
- **Git + GitHub** for version control
- **Postman** for API testing

---

## Step 1: Understand the backend modules

From your project proposal, the core backend modules are:

1. student registration and login  
2. lecturer registration and login  
3. role-based access control  
4. opportunity posting  
5. student applications  
6. digital logbooks  
7. lecturer review and feedback  
8. notifications and analytics later as extensions  

For the first working version, build the modules in this order:

- authentication
- roles
- opportunities
- applications
- logbooks
- lecturer reviews
- API for Postman
- reporting extensions

---

## Step 2: Create a fresh Laravel project

```bash
composer create-project laravel/laravel dats-laravel
cd dats-laravel
```

Why Laravel:
- fast routing
- built-in validation
- secure password hashing
- session authentication
- database migrations
- clean MVC structure

---

## Step 3: Configure MySQL or PostgreSQL

Open `.env` and set your DB values.

### MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dats_db
DB_USERNAME=root
DB_PASSWORD=
```

### PostgreSQL
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dats_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

Then run:
```bash
php artisan key:generate
```

---

## Step 4: Design the database tables

You need these main tables:

### users
Stores both students and lecturers.

Important fields:
- id
- name
- email
- reg_no
- department
- role
- password
- api_token

### opportunities
Stores attachment posts created by lecturers.

### applications
Stores student applications for opportunities.

### logbook_entries
Stores weekly attachment reports submitted by students and reviewed by lecturers.

Run the migrations:
```bash
php artisan migrate
```

---

## Step 5: Create models and relationships

Backend relationships used in this project:

- one lecturer has many opportunities
- one student has many applications
- one opportunity has many applications
- one student has many logbook entries
- one lecturer reviews many logbook entries

Model relationships are already included in the starter files under:
- `app/Models/User.php`
- `app/Models/Opportunity.php`
- `app/Models/Application.php`
- `app/Models/LogbookEntry.php`

---

## Step 6: Implement role-based authentication

Two sign-up flows are required:

- `/register/student`
- `/register/lecturer`

A shared login route is used:
- `/login`

The backend stores the role inside the `users` table:
- `student`
- `lecturer`

A custom middleware called `EnsureRole` protects routes such as:
- student-only routes
- lecturer-only routes

---

## Step 7: Build the student backend features

Student actions:
- register
- login
- view open opportunities
- apply for attachment
- see application status
- submit weekly logbook entries

Important controllers:
- `RegisteredUserController`
- `AuthenticatedSessionController`
- `OpportunityController`
- `ApplicationController`
- `LogbookController`

---

## Step 8: Build the lecturer backend features

Lecturer actions:
- register
- login
- create opportunity posts
- see student applications
- approve or reject applications
- review submitted logbooks
- add lecturer feedback

Important controllers:
- `DashboardController`
- `OpportunityController`
- `ApplicationController`
- `LecturerReviewController`

---

## Step 9: Add API endpoints for Postman testing

Why this matters:
- your lecturer/supervisor can see that your backend is testable
- APIs make future mobile app integration easier

Included API endpoints:
- register student
- register lecturer
- login
- get current user
- create opportunity
- apply to opportunity
- create logbook entry
- review logbook entry

API security:
- login generates a bearer token
- token is stored hashed in the database
- custom middleware checks the token

Use the Postman collection in:
`postman/DATS_API.postman_collection.json`

---

## Step 10: Add Bootstrap + JavaScript views

Although you asked for backend implementation, your backend becomes easier to demonstrate with a simple UI.

Included frontend pages:
- home page
- student registration
- lecturer registration
- login
- student dashboard
- lecturer dashboard
- opportunities
- applications
- logbooks
- lecturer review center
- manual page

Frontend uses:
- Bootstrap 5 CDN
- small JavaScript helpers for password toggle and form confirmations

---

## Step 11: Seed test data

Run:
```bash
php artisan db:seed
```

This creates:
- 1 demo lecturer
- 1 demo student
- 2 sample opportunities

Demo login:
- Lecturer: `lecturer@jkuat.ac.ke` / `password123`
- Student: `student@students.jkuat.ac.ke` / `password123`

---

## Step 12: Test the project

### Web test checklist
1. register a student  
2. register a lecturer  
3. log in with both accounts  
4. create an opportunity as lecturer  
5. apply as student  
6. submit a weekly logbook  
7. review it as lecturer  

### Postman test checklist
1. log in as lecturer and copy the bearer token  
2. create an opportunity via API  
3. log in as student and copy token  
4. apply to that opportunity  
5. submit a logbook  
6. log in as lecturer and review the logbook  

---

## Step 13: Use Git and GitHub

```bash
git init
git add .
git commit -m "Initial Laravel backend for DATS"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/dats-laravel.git
git push -u origin main
```

Recommended branch strategy:
- `main` for stable version
- `develop` for active work
- feature branches like:
  - `feature/auth`
  - `feature/logbooks`
  - `feature/api`

---

## Step 14: Future backend improvements

After your first demo works, add:

- company registration and verification
- supervisor allocation
- file uploads for CV and letters
- notifications by email
- PDF report generation
- analytics dashboard
- admin/coordinator role
- audit trails
- PHPUnit feature coverage

---

## Suggested viva/demo explanation

When presenting your backend, explain it like this:

> I used Laravel because it supports MVC architecture, secure authentication, validation, migrations, and clean route management. I implemented separate lecturer and student registration, role-based authorization, opportunity posting, student applications, digital logbook submission, lecturer review, and testable API endpoints using Postman. The database is compatible with MySQL and PostgreSQL, and the source code is versioned with Git and GitHub.

---

## File map

- `starter-pack/app/Http/Controllers/` - backend logic
- `starter-pack/app/Http/Middleware/` - access control
- `starter-pack/app/Models/` - Eloquent models
- `starter-pack/database/migrations/` - schema
- `starter-pack/database/seeders/` - sample data
- `starter-pack/resources/views/` - Bootstrap pages
- `starter-pack/routes/web.php` - browser routes
- `starter-pack/routes/api.php` - Postman routes

---

## Final command summary

```bash
composer create-project laravel/laravel dats-laravel
cp -R starter-pack/* dats-laravel/
cd dats-laravel
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
