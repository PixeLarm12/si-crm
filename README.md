# Cine Choice
This is a CRM system made by students from UNESP Bauru, Information System's course, called Cine Choice.

Basically, the system are to buy movies and has the management of sales, products and an AI trained model to recommend movies to user based on their purchase history. In addition, the system have import, PDF reports and notifications

Made by:
Ana Beatriz Martins Ribeiro - 221022473
Milena de Toledo Araujo - 221024743
Lucas Ramos Domingues - 221025847
Pedro Henrique Roratto - 221026932


# Pay attention to

1. **ALWAYS** run Laravel commands into docker bash by accessing `docker exec -it crm-php bash`

2. Follow **CSR Pattern**, **SOLID** and related that are described here to keep code organized. 

3. It's **NECESSARY** to run `php-cs-fixer` before open PR to do not block merging.
    - `vendor/bin/php-cs-fixer fix`

# Normal workflow

1. Start containers by running `docker-compose up -d`

2. Access `localhost/api` to access localhost API rest

# How to setup local project
- Check if `Docker Desktop` (Windows or Linux) are successfully installed in your local machine. We'll using `docker compose` and `docker` to run isolated project, non-requiring local installations of Python and Composer, for example.

1. Clone project running `git clone https://github.com/PixeLarm12/si-crm.git` or `git clone git@github.com:PixeLarm12/si-crm.git` if have SSH Key defined.
    - Access `root/` directory to start docker containers by running: `cd si-crm/`. If you change local folder's name, change it `cd <your-new-name>`.
        - cp `.env.example .env`
        - cp `api/.env.example api/.env`      

2. Start docker containers running `docker-compose up -d --build` to build and up containers at first try.
    - **OBS.:** From here, everytime you need to up your containers again, run only `docker-compose up -d`, `--build` aren't necessary.

3. Access docker container terminal to run python commands running `docker exec -it crm-php bash` at your terminal. 

4. Run, in sequence: 
    - `chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache`
    - `chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache`
    - `composer install`
    - `php artisan key:generate`
    - `php artisan jwt:secret`

5. Run `php artisan migrate:fresh --seed` to fill database

6. Access `localhost/api` from your browser to check routes.

7. To exit bash, run `exit` at docker bash and then `docker-compose down` to turn off containers.

# Testing

To run tests, access docker bash by running `docker exec -it crm-php bash` and then run `php artisan test` to run all tests.

# Laravel Code Design

We are using **CSR pattern (Controller-Service-Repository pattern)** or **Service Layer Pattern** to handle with API Rest.
Basically, the application are divided into *Controller, Service and Repository* 

**Controller:** handle with HTTP Requests and JSON Responses and call appropriate service's method to process.

**Service:** are business logic's layer. Responsible for http requests processment and all logic involved.

**Repository:** reserved for database directly contact. It's really recommended that only use repository's method from some service's method.

## Abstractions (BaseFiles)

It's useful files that has some commons methods to centralize in one file and be extendable from any class and be able to be overrided as needed. By the way, there are:

**BaseRepository:** abstract know methods for Laravel Resource (create, read, show, update, delete) thats manage with database

**BaseService:** have the same Laravel Resource methods but with 'Record' suffix. Use related method from Repository instantiated to access database following *CSR pattern*

**BaseController:** have Service instantiated to be able to handle with http requests correctly and also follow *CSR pattern* calling related service methods. `BaseController` have an default method to create default response to API Rest.

# References

* Laravel Reports Docs: [Access here](https://quickchart.io/documentation/)
