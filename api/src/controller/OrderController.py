from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.OrderEnum import OrderEnum
import src.service.OrderService as orderService

order_blueprint = Blueprint('order_controller', __name__)

@order_blueprint.route(f"{OrderEnum.BASE_ROUTE}", methods = ['GET'])
def index_orders():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': orderService.list()
    };

    