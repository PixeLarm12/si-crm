<?php

namespace App\Repositories;

use App\Enums\SaleEnum;
use App\Models\Sale;

class SaleRepository extends BaseRepository
{
	public function __construct(Sale $model)
	{
		parent::__construct($model);
	}

	public function getSalesGroupedToReport(string $period)
	{
		if (!in_array($period, [SaleEnum::REPORT_MONTHLY, SaleEnum::REPORT_ANNUAL])) {
			$period = SaleEnum::REPORT_ANNUAL;
		}

		$query = Sale::query();

		if ($period === SaleEnum::REPORT_MONTHLY) {
			$query->selectRaw("DATE_FORMAT(date, '%Y-%m') as period, SUM(total_price) as total")
				  ->groupBy('period')
				  ->orderBy('period', 'asc');
		} else {
			$query->selectRaw('YEAR(date) as period, SUM(total_price) as total')
				  ->groupBy('period')
				  ->orderBy('period', 'asc');
		}

		$sales = $query->get()->pluck('total', 'period')->toArray();

		$response = [
			'labels'  => [],
			'dataset' => [],
		];

		foreach ($sales as $date => $totalSale) {
			array_push($response['labels'], $date);
			array_push($response['dataset'], $totalSale);
		}

		return $response;
	}
}