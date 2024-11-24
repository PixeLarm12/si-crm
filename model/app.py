import sys
import os
from flask import Flask, request, jsonify

# Adicionar o diretório onde app.py está localizado ao sys.path
sys.path.append(os.path.join(os.path.dirname(__file__)))

from utils.ai import recommend_to_user

app = Flask(__name__)

@app.route("/", methods=["POST"])
def recommend():
    return recommend_to_user(request.get_json())

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
