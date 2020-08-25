# RDNDEVSBOOK WITH LARAVEL LUMEN

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.
## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).


### RDNDEVSBOOK - Api with Lumen, Lumen Passport and Mysql


Clone the repository

    git clone https://github.com/rodineiti/lumen-rdndevsbook.git

Switch to the repo folder

    cd lumen-rdndevsbook

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
Set Database SQLITE in .env

    DB_CONNECTION=mysql

Generate a new application key

    php artisan key:generate

Dump script SQL in to database

    rdndevsbook.sql

PASSPORT - Create the encryption keys needed to generate secure access tokens

    php artisan passport:install

Start the local development server

    php -S localhost:8000 -t public
    
    Lumen (7.2.1) (Laravel Components ^7.0)

You can now access the server at http://localhost:8000

#### Endpoints

![image](https://user-images.githubusercontent.com/25492122/91220293-558d0200-e6f2-11ea-96a9-358a87856943.png)
