from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.ClientEnum import ClientEnum
import src.service.ClientService as clientService

client_blueprint = Blueprint('client_controller', __name__)

@client_blueprint.route(f"{ClientEnum.BASE_ROUTE}", methods = ['GET'])
def index_clients():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': clientService.list()
    };

    