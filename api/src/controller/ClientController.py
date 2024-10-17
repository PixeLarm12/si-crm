from src.enum.HttpResponseEnum import HttpResponseEnum
import src.service.ClientService as clientService

# @index listing clients
def index():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': clientService.list()
    };