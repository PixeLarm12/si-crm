from flask import Flask, request
from dotenv import load_dotenv

import os

load_dotenv()

API_PREFIX = os.getenv("API_PREFIX", "") 

app = Flask(__name__)

@app.route(f"{API_PREFIX}/helloworld", methods=['GET'])
def hello_world():
    return "<p>Hello, World!</p>"
