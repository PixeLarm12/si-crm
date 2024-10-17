from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
import src.service.ClientService as clientService

client_blueprint = Blueprint('client_controller', __name__)

@client_blueprint.route('/clients')
def index_clients():
    return {
        'status': HttpResponseEnum.HTTP_NOT_FOUND,
        'error': False,
        'data': clientService.list()
    };

    