import os
from dotenv import load_dotenv
from flask import Flask,jsonify,request 
from src.controller.ClientController import client_blueprint
from src.controller.LeadController import lead_blueprint
from src.controller.OrderController import order_blueprint
from src.controller.ProductController import product_blueprint
from src.controller.ReportController import report_blueprint
from src.controller.SupportController import support_blueprint

# Necessary to find .env from root/
dotenv_path = os.path.join(os.path.dirname(os.path.dirname(__file__)), '.env')

load_dotenv(dotenv_path)

app = Flask(__name__)

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

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

