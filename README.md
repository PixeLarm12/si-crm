# CRM
This is a CRM system made by students from UNESP Bauru, Information System's course.

# Pay attention to

1. **ALWAYS** run Python commands into docker bash by accessing `docker exec -it crm-app bash`
2. Update `requirements.txt` when packages updated by running: `pip freeze > requirements.txt`
3. To quit from `venv/`, just run `deactivate`

# Normal workflow

1. Start containers by running `docker-compose up -d`

2. Access `localhost:5000/api/<route>` to access localhost API rest

3. Everytime new route add or need to clear flask cache, run `docker-compose restart crm-app`
    - To check some debug (as `print()`), run `docker-compose logs crm-app` to see container logs


# How to setup local project
- Check if `Docker Desktop` (Windows or Linux) are successfully installed in your local machine. We'll using `docker compose` and `docker` to run isolated project, non-requiring local installations of Python, for example.

1. Clone project running `git clone https://github.com/PixeLarm12/si-crm.git` or `git clone git@github.com:PixeLarm12/si-crm.git` if have SSH Key defined.
    - Access `root/` directory to start docker containers by running: `cd si-crm/`. If you change local folder's name, change it `cd <your-new-name>`.
        - cp `.env.example .env`
        - cp `api/.env.example api/.env`      

2. Start docker containers running `docker-compose up -d --build` to build and up containers at first try.
    - **OBS.:** From here, everytime you need to up your containers again, run only `docker-compose up -d`, `--build` aren't necessary.

3. Access docker container terminal to run python commands running `docker exec -it crm-php bash` at your terminal. 

4. Run `composer install` and `php artisan key:generate`

5. Run `php artisan migrations:migrate` to fill database

6. Access `localhost:5000` from your browser to check routes.

7. To exit bash, run `exit` at docker bash and then `docker-compose down` to turn off containers.