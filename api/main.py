import os
from dotenv import load_dotenv
from flask import Flask,jsonify,request 
from src.controller import ClientController

dotenv_path = os.path.join(os.path.dirname(os.path.dirname(__file__)), '.env')

load_dotenv(dotenv_path)

app = Flask(__name__)

apiPrefix = os.getenv('API_PREFIX')

@app.route(f"/{apiPrefix}/clients", methods=['GET'])
def clientsIndex():
    return jsonify(ClientController.index());

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
