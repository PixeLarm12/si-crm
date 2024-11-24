<?php

namespace App\Services;

use App\Enums\ChartEnum;
use App\Enums\SaleEnum;
use Barryvdh\DomPDF\PDF;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use QuickChart;

class ReportService
{
    /**
	 * Create Sale report per period.
	 *
	 * @param string $period ('monthly', 'annual')
	 */
	public function generateSalePerPeriodReport(string $period): string
	{
		$quickChart = new QuickChart([
			'width' => 500,
			'height' => 300,
			'version' => '2',
		]);

		$config = <<<EOD
			{
				type: 'bar',
				data: {
					labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
					datasets: [
					{
						label: 'Dataset 1',
						backgroundColor: 'rgba(255, 99, 132, 0.5)',
						borderColor: 'rgb(255, 99, 132)',
						borderWidth: 1,
						data: [-31, -70, -30, -33, -9, 14, -41],
					},
					{
						label: 'Dataset 2',
						backgroundColor: 'rgba(54, 162, 235, 0.5)',
						borderColor: 'rgb(54, 162, 235)',
						borderWidth: 1,
						data: [73, 41, 29, 61, -65, 59, 38],
					},
					],
				},
				options: {
					title: {
					display: true,
					text: 'Bar Chart',
					},
					plugins: {
					datalabels: {
						anchor: 'center',
						align: 'center',
						color: '#666',
						font: {
						weight: 'normal',
						},
					},
					},
				},
			}
		EOD;

		$quickChart->setConfig($config);
		return 'data:image/png;base64,' . base64_encode($quickChart->toBinary());
	}

    /**
	 * Generate PDF file.
	 *
	 * @param string $html 
	 * @return PDF
	 */
    public function generatePDF(string $html): PDF
    {
        $pdf = app('dompdf.wrapper');

		return $pdf->loadHTML($html)->setPaper('a4', 'landscape');
    }
}