import sys
import os

# Adicionar o diretório onde app.py está localizado ao sys.path
sys.path.append(os.path.join(os.path.dirname(__file__)))

from flask import Flask
from utils.ai import recommend_to_user

app = Flask(__name__)

@app.route("/")
def hello():
    return recommend_to_user()

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
