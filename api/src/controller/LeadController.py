from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
import src.service.LeadService as leadService

lead_blueprint = Blueprint('lead_controller', __name__)

@lead_blueprint.route('/leads', methods = ['GET'])
def import_leads():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': leadService.importLeads()
    };

    