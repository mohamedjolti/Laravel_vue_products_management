# ![Product Management ](logo.png)



> ### Product Managament using Laravel, vue js , vuex ( for state management),vuetify (as a libray for the UI)  that adheres to the [Product Management](https://github.com/mohamedjolti/Laravel_vue_products_management) spec and API.

This repo is functionality complete 
----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation)



Clone the repository

    git clone https://github.com/mohamedjolti/Laravel_vue_products_management.git

Switch to the repo folder

    cd Product_Management

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env



Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
open another terminal (**verify that node js is installed using'node -v'**)

    npm install 

Compile the packages installed in package.json file

    npm run watch
Start the local development server (**in another terminal**)

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git
    cd laravel-realworld-example-app
    composer install
    cp .env.example .env
    php artisan migrate
    npm install
    npm run  watch
    php artisan serve
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


    


# Code overview


## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

 

