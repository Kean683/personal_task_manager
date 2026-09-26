# Personal Task Manager

A straightforward and simple personal to-do app powered by Laravel.

## Student Information

- **Project Code:** WST21-PM-2026-SF
- **Student Name:** Marollano, Kean E.
- **Course & Year:** BSIT 7, 2nd year
- **Database Used:** SQLite (Laravel-compatible; can be swapped for MySQL/MariaDB via `.env`)

## Features

- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status
- Set Due Date
- Task Description

## Technologies

- Laravel
- PHP
- SQLite
- Blade
- HTML
- CSS

## Project Structure

The project follows the Laravel structure:

Route → Controller → Model → Database → Blade

## Installation

Clone the repository:

    git clone https://github.com/Kean683/personal_task_manager.git

Then, from the project root:

    composer install
    cp .env.example .env
    php artisan key:generate
    touch database/database.sqlite
    php artisan migrate
    php artisan serve
