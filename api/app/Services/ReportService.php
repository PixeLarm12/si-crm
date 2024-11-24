<?php

namespace App\Services;

use App\Enums\ChartEnum;
use App\Enums\ReportEnum;
use App\Enums\SaleEnum;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Barryvdh\DomPDF\PDF;
use QuickChart;

class ReportService
{
	/**
	 * @var SaleRepository
	 */
	protected SaleRepository $saleRepository;

	public function __construct()
	{
		$this->saleRepository = new SaleRepository(new Sale());
	}

	/**
	 * Create Sale report per period.
	 *
	 * @param string $period ('monthly', 'annual')
	 */
	public function generateSalePerPeriodReport(string $period) : string
	{
		if (!in_array($period, [SaleEnum::REPORT_MONTHLY, SaleEnum::REPORT_ANNUAL])) {
			$period = SaleEnum::REPORT_ANNUAL;
		}

		$sales = $this->saleRepository->getSalesGroupedToReport($period);

		$quickChart = new QuickChart([
			'width'   => 700,
			'height'  => 400,
			'version' => '2',
		]);

		$config = [
			'type'    => ChartEnum::REPORT_CHART_TYPE_BAR,
			'data'    => [
				'labels'   => $sales['labels'],
				'datasets' => [
					[
						'label'           => 'Total sold ' . $period . ' ($)',
						'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
						'borderColor'     => 'rgb(255, 99, 132)',
						'borderWidth'     => 1,
						'data'            => $sales['dataset'],
					],
				],
			],
			'options' => [
				'title'   => [
					'display' => true,
					'text'    => 'Sales ' . $period,
				],
				'plugins' => [
					'datalabels' => [
						'anchor' => 'center',
						'align'  => 'center',
						'color'  => '#666',
						'font'   => [
							'weight' => 'normal',
						],
					],
				],
			],
		];

		$quickChart->setConfig($config);

		return 'data:image/png;base64,' . base64_encode($quickChart->toBinary());
	}

	/**
	 * Generate PDF file.
	 *
	 * @param string $html
	 * @param string $format (landscape or portrait)
	 * @return PDF
	 */
	public function generatePDF(string $html, string $format = ReportEnum::PAGE_FORMAT_PORTRAIT) : PDF
	{
		if (!in_array($format, [ReportEnum::PAGE_FORMAT_LANDSCAPE, ReportEnum::PAGE_FORMAT_PORTRAIT])) {
			$format = ReportEnum::PAGE_FORMAT_PORTRAIT;
		}

		$pdf = app('dompdf.wrapper');

		return $pdf->loadHTML($html)->setPaper('a4', $format);
	}
}