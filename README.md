# ADAPT

## Project
Researchers publish increasing amounts of data in archives called data repositories. It is important that the right descriptive terms (metadata) are added to datasets, allowing data to be found and reused. Data repositories typically allow the addition of generic metadata, but cannot be easily adapted to accommodate discipline-specific metadata schemas and vocabularies developed by international research communities. In this project we have developed an open-source toolbox that helps researchers to easily assign discipline-specific and internationally recognized metadata to their data publications. This makes it easier for other researchers to find this data and increases the potential for its future re-use.

The software is setup to read a JSON formatted file to render a form is used to enter the metadata. Submitted metadata is processed and send to defined source in a custom defined output formatter.

## Getting started

#### Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:UtrechtUniversity/adapt.git

Switch to the repo folder

    cd adapt

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

    git clone git clone git@github.com:UtrechtUniversity/adapt.git
    cd laravel-realworld-example-app
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve