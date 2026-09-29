# Personal Task Manager

A straightforward and simple personal to-do app powered by Laravel.

## Student Information

- **Project Code:** WST21-PM-2026-SF
- **Subject Time:** TTH (10:30AM - 12:00PM)
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

## Output
# Main Page
<img width="1920" height="960" alt="image" src="https://github.com/user-attachments/assets/0146097d-0934-4acd-aed7-fa203a5f7ed1" />

# Creating New Tasks
<img width="1920" height="958" alt="image" src="https://github.com/user-attachments/assets/3136faec-7a9c-4181-a05f-f8321cad9922" />

# Tasks in the Main Page
<img width="1920" height="962" alt="image" src="https://github.com/user-attachments/assets/c1979cbf-b4ac-4cb1-8e38-9751f65e58ea" />

# Completed Tasks
<img width="1919" height="960" alt="image" src="https://github.com/user-attachments/assets/c2472ee8-1a8d-4c3f-9d6f-7c64384e43d7" />


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
