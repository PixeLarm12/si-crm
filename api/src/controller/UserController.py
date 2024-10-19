from flask import Blueprint, request, jsonify
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.UserEnum import UserEnum
import src.service.UserService as userService

user_blueprint = Blueprint('user_controller', __name__)

@user_blueprint.route(f"{UserEnum.BASE_ROUTE}", methods = ['GET'])
def index_user():
    data = userService.list()

    if not data:
        response = {
            'status': HttpResponseEnum.HTTP_NO_CONTENT,
            'data': data
        }
    else:
        response = {
            'status': HttpResponseEnum.HTTP_OK,
            'data': data
        }

    return jsonify(response), response['status']
    

@user_blueprint.route(f"{UserEnum.BASE_ROUTE}", methods = ['POST'])
def store_user():
    if request.method != 'POST':
        response = {
            'status': HttpResponseEnum.HTTP_FORBIDDEN,
            'message': {
                'message': 'This route accepts only POST routes'
            }
        }

        return jsonify(response), response['status']
    
    if not request.is_json:
        response = {
            'status': HttpResponseEnum.HTTP_FORBIDDEN,
            'message': {
                'message': 'This route needs header Content-Type: application/json'
            }
        }

        return jsonify(response), response['status']
    
    data = userService.getRequestData(request.get_json())

    if data['error']:
        response = { 
            'status': HttpResponseEnum.HTTP_BAD_REQUEST,
            'message': data['message']
        }

        return jsonify(response), response['status']
     
    storeResponse = userService.store(data['data'])

    response = { 
        'status': HttpResponseEnum.HTTP_CREATED,
        'data': storeResponse
    }

    return jsonify(response), response['status']

@user_blueprint.route(f"{UserEnum.BASE_ROUTE}/<id>", methods = ['PUT', 'PATCH'])
def update_user(id):
    response = {
        'status': HttpResponseEnum.HTTP_CREATED,
        'data': userService.update(id)
    }

    return jsonify(response), response['status']

@user_blueprint.route(f"{UserEnum.BASE_ROUTE}/<id>", methods = ['DELETE'])
def delete_user():
    response = {
        'status': HttpResponseEnum.HTTP_OK,
        'data': userService.delete(id)
    }

    return jsonify(response), response['status']