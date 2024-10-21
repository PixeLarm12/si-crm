from flask import Blueprint, request, jsonify
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.AuthEnum import AuthEnum
import src.service.AuthService as authService

auth_blueprint = Blueprint('auth_controller', __name__)

@auth_blueprint.route(f"{AuthEnum.BASE_ROUTE}/login", methods = ['POST'])
def login():
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
    
    data = authService.getRequestData(request.get_json())

    if data['error']:
        response = { 
            'status': HttpResponseEnum.HTTP_BAD_REQUEST,
            'message': data['message']
        }

        return jsonify(response), response['status']
     
    authResponse = authService.login(data['data'])

    if authResponse['error']:
        response = { 
            'status': HttpResponseEnum.HTTP_NOT_FOUND,
            'message': data
        }

        return jsonify(response), response['status']

    response = { 
        'status': HttpResponseEnum.HTTP_OK,
        'data': authResponse
    }

    return jsonify(response), response['status']