# CRM
This is a CRM system made by students from UNESP Baury, Information System's course.

# Pay attention to

1. **ALWAYS** run Python commands into docker bash by accessing `docker exec -it crm-app bash`
2. Update `requirements.txt` when packages updated by running: `pip freeze > requirements.txt`
3. To quit from `venv/`, just run `deactivate`

# Steps to run local project 
- Check if `Docker Desktop` (Windows or Linux) are successfully installed in your local machine. We'll using `docker compose` and `docker` to run isolated project, non-requiring local installations of Python, for example.

1. Clone project running `git clone https://github.com/PixeLarm12/si-crm.git` or `git clone git@github.com:PixeLarm12/si-crm.git` if have SSH Key defined.
    - Access `root/` directory to start docker containers by running: `cd si-crm/`. If you change local folder's name, change it `cd <your-new-name>`.

2. Start docker containers running `docker-compose up -d --build` to build and up containers at first try.
    - **OBS.:** From here, everytime you need to up your containers again, run only `docker-compose up -d`, `--build` aren't necessary.

3. Access docker container terminal to run python commands running `docker exec -it crm-app bash` at your terminal. Check if are into `crm/`.

4. Access `localhost:5000` from your browser to check routes.

5. To exit bash, run `exit` at docker bash and then `docker-compose down` to turn off containers.

# Flask stuffs

- Sometimes flask does not update new routes correctly, so it may be necessary to drop container and up again.
    - `docker-compose down` then `docker-compose up -d --force-recreate`.

1. Keep it simple!
    - Keep simple route names and try to follow a pattern. For example, for `users` routes, try use `users/<route>` as pattern. And, avoid adding logic codes into `main.py` because are working as an Controller file.