# Pre-requisites
* Docker running on the host machine
* Docker compose running on the host machine
* Basic knowledge of Docker


# Installation
To get started, the following steps needs to be taken:
* Clone the repo.
* `cd subscription-platform` to the project directory.
+ `cp .env.example .env` to use env config file
+ Properly fill `.env` file with config.
+ Run `docker-compose up -d` to start the containers.
+ Visit http://localhost to access to application. Alternatively, you can add `barkyn.codes` to your `/etc/hosts` file and navigate to that url.

## Docker
#### PostgreSQL

Try to connect 127.0.0.1:5432 to access Postgres
