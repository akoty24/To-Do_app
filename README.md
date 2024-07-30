p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel To-Do Application

This is a simple To-Do application built with Laravel. It includes features for managing users, categories, and tasks.

## Installation

Follow these steps to set up the project on your local machine:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/akoty24/To-Do_app.git
    cd To-Do_app
    ```

2. **Install dependencies:**
    ```bash
    composer install
    <!-- npm install -->
    <!-- npm run dev -->
    ```

3. **Copy the example environment file and configure the environment variables:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Update the `.env` file with your database configuration and other necessary settings.

4. **Run the migrations and seed the database:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    This will create the necessary database tables and insert the initial data:
    - A user with the following details:
        - Name: `mohamed`
        - Email: `mohamed@mohamed.com`
        - Password: `123456789` (hashed)
    - Categories: `Work`, `Personal`, `Urgent`
    - Sample tasks associated with the categories.

## Running the Application

1. **Start the local development server:**
    ```bash
    php artisan serve
    