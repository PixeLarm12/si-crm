import os
from dotenv import load_dotenv
from flask import Flask
from flask_jwt_extended import (
    JWTManager
)
from src.controller.ClientController import client_blueprint
from src.controller.LeadController import lead_blueprint
from src.controller.OrderController import order_blueprint
from src.controller.ProductController import product_blueprint
from src.controller.ReportController import report_blueprint
from src.controller.SupportController import support_blueprint
from src.controller.UserController import user_blueprint
from src.controller.AuthController import auth_blueprint

# Necessary to find .env from root/
dotenv_path = os.path.join(os.path.dirname(os.path.dirname(__file__)), '.env')

load_dotenv(dotenv_path)

app = Flask(__name__)

app.config['JWT_SECRET_KEY'] = 'secret-key'
jwt = JWTManager(app)

urlPrefix = os.getenv('API_PREFIX')

# Registering ClientController
app.register_blueprint(client_blueprint, url_prefix=urlPrefix)

# Registering LeadController
app.register_blueprint(lead_blueprint, url_prefix=urlPrefix)

# Registering OrderController
app.register_blueprint(order_blueprint, url_prefix=urlPrefix)

# Registering ProductController
app.register_blueprint(product_blueprint, url_prefix=urlPrefix)

# Registering ReportController
app.register_blueprint(report_blueprint, url_prefix=urlPrefix)

# Registering SupportController
app.register_blueprint(support_blueprint, url_prefix=urlPrefix)

# Registering UserController
app.register_blueprint(user_blueprint, url_prefix=urlPrefix)

# Registering AuthController
app.register_blueprint(auth_blueprint, url_prefix=urlPrefix)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

