# Learner Progress Dashboard - Coding Challenge

## Features
- View learners with enrolled courses and % progress
- Filter learners by course name
- Sort learners by progress percentage (ascending/descending)
- Search learners by name (first or last)
- Pagination with Bootstrap 5 styling
- Blade component for reusable learner cards
- Public route – no authentication required
- Tested: feature + unit tests included

## Clone the Project
```bash
git clone https://github.com/thulanijoyisa/learner-progress-dashboard.git
```
Access directory:
```bash
cd learner-progress-dashboard
```
## Getting Started
1. Run `composer install`
2. Configure your `.env` file from the example `cp .env.example .env`
3. Generate the App Key: `php artisan key:generate`
4. Run migrations and seeders: `php artisan migrate --seed`
5. Start the development server: `php artisan serve`
6. Running tests for features + model logic :  `php artisan test`
     
