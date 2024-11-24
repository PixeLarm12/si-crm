<?php 

namespace App\Enums;

class ChartEnum extends AbstractEnum
{
    public const BASE_URL = 'https://quickchart.io/chart';
    public const REPORT_TYPE_DATE = 'group_by_date';
    public const REPORT_TYPE_STRING = 'group_by_string';
    public const REPORT_TYPE_RELATIONSHIOP = 'group_by_relationship';
    public const REPORT_CHART_TYPE_LINE = 'line';
    public const REPORT_CHART_TYPE_BAR = 'bar';
    public const REPORT_CHART_TYPE_PIE = 'pie';
}