# Learner Progress Dashboard

## Getting Started

### Prerequisites
- PHP 8.2 or higher
- Composer
- NPM
- Database (MySQL, PostgreSQL, or SQLite)

### Installation

1. Clone the repository and navigate to the project directory

2. Install dependencies:
```bash
composer install
npm install
```

3. Copy the environment file:
```bash
cp .env.example .env
```

4. Configure your database in the `.env` file (use `sqlite`, `mysql`, or `pgsql` for `DB_CONNECTION`)

5. Generate the application key:
```bash
php artisan key:generate
```

6. Run migrations and seeders:
```bash
php artisan migrate --seed
```

7. Build frontend assets:
```bash
npm run build
# Or for development with hot-reloading:
npm run dev
```

8. Start the development server:
```bash
php artisan serve
```

9. Access the application at `http://localhost:8000/learner-progress`