from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.SupportEnum import SupportEnum
import src.service.SupportService as supportService

support_blueprint = Blueprint('support_controller', __name__)

@support_blueprint.route(f"{SupportEnum.BASE_ROUTE}", methods = ['GET'])
def index_support():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': supportService.list()
    };

    