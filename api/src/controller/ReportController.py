from flask import Blueprint
from src.enum.HttpResponseEnum import HttpResponseEnum
from src.enum.ReportEnum import ReportEnum
import src.service.ReportService as reportService

report_blueprint = Blueprint('report_controller', __name__)

@report_blueprint.route(f"{ReportEnum.BASE_ROUTE}", methods = ['GET'])
def generate_orders_report():
    return {
        'status': HttpResponseEnum.HTTP_OK,
        'error': False,
        'data': reportService.ordersReports()
    };

    