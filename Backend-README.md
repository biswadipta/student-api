# Student API (MVC Laravel Application)

This repository contains a Laravel-based **Student API** structured using the **Model‑View‑Controller (MVC)** architectural pattern. Models live in `app/Models`, controllers under `app/Http/Controllers`, and views in `resources/views`. Routes are defined in the `routes` directory and requests flow through the MVC layers.

Follow the steps below to set up, run, and work with the project.

---

## 🚀 Prerequisites
- **PHP** (≥ 8.1)
- **Composer**
- **Node.js** & **npm** (or **Yarn**)
- A database server (MySQL, MariaDB, SQLite, etc.)
- [Optional] Laravel Valet / Sail / Homestead if you prefer

---

## 📁 Clone & Initial Setup

```bash
# clone repository
git clone https://github.com/biswadipta/student-api.git
cd student-api

# install PHP dependencies
composer install

# install frontend dependencies
npm install     # or yarn install
```

---
## ⚙ Environment Configuration

1. Copy the example environment file:

   ```bash
   cp .env.example .env
   ```

2. Edit `.env` and configure the following (add other services as needed):

   ```dotenv
   APP_NAME="Student API"
   APP_ENV=local
   APP_KEY=              # will be generated next
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql         # or sqlite/postgres/etc.
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=student_api
      DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Generate an application key:

   ```bash
   php artisan key:generate
   ```

---

## 🔧 Database

> **Tip:** Models such as `Student`, `User`, and `Admin` correspond to database tables and are located under `app/Models`.

```bash
# run migrations
php artisan migrate

# seed sample data (optional)
php artisan db:seed
```

Factories are available in `database/factories` for generating test data.

---

## 🎯 Run the Application

```bash
# start development server
php artisan serve --host=127.0.0.1 --port=8000 or just
 php artisan serve
```

Access the site at [http://localhost:8000](http://localhost:8000).

The MVC flow for web requests typically looks like:

1. **Route** defined in `routes/web.php` or `routes/api.php`
2. Business logic in `app/Http/Controllers/*`
3. schema logic using **Models** in `app/Models`
4. View rendering (for web) from `resources/views`

---

## ✅ Testing

Run PHPUnit tests:

```bash
php artisan test          # or ./vendor/bin/phpunit
```

To target a specific test:

```bash
php artisan test --filter=StudentControllerTest
```

Test classes live under `tests/Feature` and `tests/Unit`.

---

> 📌 *Never commit `.env` to version control.*

---

This README serves as a quick start; add further documentation (API endpoints, deployment guides, etc.) as the project evolves.

