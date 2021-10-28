# ![Laravel Example App](logo.png)


> ### Cloud Africa Technical Assessment spec and API.

This repo is functionality complete as per requirement!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x)


Clone the repository

    git clone https://github.com/FFOLA/cloud-africa-technical-assesment.git

Switch to the repo folder

    cd cloud-africa-technical-assesment

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/FFOLA/cloud-africa-technical-assesment.git
    cd cloud-africa-technical-assesment
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve   

The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

----------

# Code overview

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/InvoiceController` - Contains all the api controllers
- `app/Http/Requests/Invoice` - Contains api form requests
- `database/migrations` - Contains all the database migrations
- `routes` - Contains all the api routes defined in api.php file

## Environment variables

- `.env` - Environment variables can be set in this file

## API Postman Collection Link

- https://www.getpostman.com/collections/446f79833e14ea4aca37


***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.
