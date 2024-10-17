from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
import src.service.ProductService as productService

product_blueprint = Blueprint('product_controller', __name__)

@product_blueprint.route('/products', methods = ['GET'])
def index_products():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': productService.list()
    };

    