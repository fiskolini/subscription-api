# Subscription API

> Backend Code Challenge - Senior BE Developer, for **_Barkyn_**
>
> Solved by [Francisco Carvalho](http://francisco-carvalho.eu)

Table of contents
=================

<!--ts-->

* [Architecture](#architecture)
* [Usage](#usage)
* [Solution](#solution)
* [Improvements](#improvements)

<!--te-->

Architecture
============
The current solution was implemented using [DDD approach](https://martinfowler.com/bliki/DomainDrivenDesign.html).
> **Domain-driven design (DDD)** is the concept that the structure and language of software code (class names, class methods, class variables) should match the business domain.

Usage
=====
This solution uses Docker to enable testing easily in a local environment.

## Pre-requisites

* Docker running on the host machine
* Docker compose running on the host machine
* Basic knowledge of Docker

## Installation

To get started, the following steps needs to be taken:

* Clone the repo.
* `cd subscription-platform` to the project directory.

+ `cp .env.example .env` to use env config file.
+ Properly fill `.env` file with config.
+ `cp app/.env.example app/.env` for the application config.
+ Properly fill `app/.env` file with the config.
+ Run `docker-compose up -d` to start the containers.
+ Run `docker exec -it barkyn-php composer install` to install all PHP dependencies.
+ Visit http://localhost to access to application. Alternatively, you can add `barkyn.codes` to your `/etc/hosts` file
  and navigate to that url.

## Docker

The current docker configuration will create the following containers:

- **postgres** - to enable persistence layer;
- **web** - with nginx, to allow webserver;
- **php** - php 7.4 installation, as long as php-fpm and composer;
- **swagger** - swagger UI. Accessible trough http://localhost:8001 (or, again, trough http://barkyn.codes:8001).

Solution
========
The API should be running under `/api` base path (http://barkyn.codes/api).

**NOTE**: all of the `/customer` routes are using a `DummyMiddleware` to _simulate_ a real application. This mean that
every request should be giving a `Bearer` token. **The required token** should be placed under `app/.env` file,
in `BEARER_TOKEN` property.

### The current solution includes the following technologies:

- Slim PHP, to enable _REST_ API;
- Eloquent, ORM to abstract DB access;
- Phinx, to enable DB Migrations and Seeders;
- php-di, to enable DI container and Dependency Injection by Dependency Inversion principle;
- psr7, common interfaces for HTTP messages.

### Extra Credits:

Every code was written by the author, from the bootloader to this README.md file 😊. Using DDD approach, every Domain is
structured to have a single responsibility, from the HTTP Routes (inside `Infrastructure\Http`) or even
Repositories (`Persistence\Repositories`).

I respected SOLID principles, mostly **Single Responsibility**, **Liskov Substitution** by receiving interfaces, and **
Dependency Inversion** by dealing with dependency injection.



Improvements
============
This application contains the boilerplate to evolve the API and a simple CR~~UD~~. However, there are some missing
features that are incomplete.

#### 1. Code Coverage:

This solution doesn't have any code coverage.

#### 2. Features to take into account:

**Only** the `Customer` feature was taken into account. This decision was intention, since I strongly believe the whole
point of this exercise is to **check the code rather than the functionality itself**.
