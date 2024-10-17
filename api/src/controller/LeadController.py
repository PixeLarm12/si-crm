from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.LeadEnum import LeadEnum
import src.service.LeadService as leadService

lead_blueprint = Blueprint('lead_controller', __name__)

@lead_blueprint.route(f"{LeadEnum.BASE_ROUTE}", methods = ['GET'])
def import_leads():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': leadService.importLeads()
    };

    