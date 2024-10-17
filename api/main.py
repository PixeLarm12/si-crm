import os
from dotenv import load_dotenv
from flask import Flask,jsonify,request 
from src.controller.ClientController import client_blueprint

# Necessary to find .env from root/
dotenv_path = os.path.join(os.path.dirname(os.path.dirname(__file__)), '.env')

load_dotenv(dotenv_path)

app = Flask(__name__)

urlPrefix = os.getenv('API_PREFIX')

# Registering ClientController
app.register_blueprint(client_blueprint, url_prefix=urlPrefix)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

