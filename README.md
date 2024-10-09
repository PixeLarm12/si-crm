# si-crm
This is a CRM system made by students from UNESP Baury, Information System's course.

# Warnings

1. Update `requirements.txt` when packages updated by running: `pip freeze > requirements.txt`

# Setup api/ folder 
- Check if `Python` are successfully installed into your computer.

1. Clone project running `git clone https://github.com/PixeLarm12/si-crm.git` or `git clone git@github.com:PixeLarm12/si-crm.git` if have SSH Key defined.
    - Copy .env: 
        - **Ubuntu/macOS**: `cp .env.example .env` 
        - **Windows**: `copy .env.example .env` 
    - After clone, run `cd si-crm/api` 

2. Create virtual environment:
    - Run: 
        - **Ubuntu/macOS**: `python3 -m venv venv` 
        - **Windows**: `py -3 -m venv venv` 
    - Then: 
        - **Ubuntu/macOS**: `. venv/bin/activate` to start virtual environment
        - **Windows**: `venv\Scripts\activate` to start virtual environment

3. Install dependencies
    - Run: `pip install -r requirements.txt` to install all dependencies for your virtual environment

4. Run Flask:
    - Run: `flask --app main run`
    - Access `localhost:5000/api/` to access api routes.
        - **Obs.:** Terminal will thrown where port localhost are running, so **ALWAYS** check. Normally, will use port 5000, but it's not a law.