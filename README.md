# Social Network application

Social network application which gives possibility to make friend requests, write comments/messages.

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/Boris996/social-network.git

Switch to the repo folder

    cd social-network

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file (Database Connection)

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Install npm required packages

    npm install
    
Share Libraries into the public folder

    npm run dev

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Boris996/social-network.git
    cd social-network
    composer install
    cp .env.example .env
    php artisan key:generate
    npm install
    npm run dev
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
