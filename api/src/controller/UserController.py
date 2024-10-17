from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.UserEnum import UserEnum
import src.service.UserService as userService

user_blueprint = Blueprint('user_controller', __name__)

@user_blueprint.route(f"{UserEnum.BASE_ROUTE}", methods = ['GET'])
def index_user():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': userService.list()
    };

    