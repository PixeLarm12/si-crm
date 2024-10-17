from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.ProductEnum import ProductEnum
import src.service.ProductService as productService

product_blueprint = Blueprint('product_controller', __name__)

@product_blueprint.route(f"{ProductEnum.BASE_ROUTE}", methods = ['GET'])
def index_products():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': productService.list()
    };

    