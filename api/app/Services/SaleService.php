<?php

namespace App\Services;

use App\Enums\ChartEnum;
use App\Enums\SaleEnum;
use App\Repositories\SaleRepository;
use Illuminate\Database\Eloquent\Model;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class SaleService extends BaseService
{
	public function __construct(SaleRepository $repository)
	{
		parent::__construct($repository);
	}

	/**
	 * Create a new record with Repository.
	 *
	 * @param array $data
	 * @return Model
	 */
	public function saveRecord(array $data) : Model
	{
		$sale = $this->repository->create($data);

		$sale->items()->createMany($data['items']);

		return $sale;
	}

	/**
	 * Update record with Repository by ID.
	 *
	 * @param int $id
	 * @param array $data
	 * @return Model
	 */
	public function updateRecord(int $id, array $data) : bool
	{
		$sale = $this->repository->find($id);

		$sale->update($data);

		if ($data['items']) {
			$sale->items()->delete();

			$sale->items()->createMany($data['items']);
		}

		return (bool) $sale;
	}

	public function generateReport(string $period): LaravelChart
	{
		$title = ($period == SaleEnum::REPORT_MONTHLY) ? "monthly" : "annual";

		$options = [
			'chart_title' => 'Sale ' . $title,
			'report_type' => ChartEnum::REPORT_TYPE_DATE,
			'model' => 'App\Models\Sale',
			'group_by_field' => 'date',
			'group_by_period' => ($period == SaleEnum::REPORT_MONTHLY) ? "month" : "year",
			'chart_type' => ($period == SaleEnum::REPORT_MONTHLY) ? ChartEnum::REPORT_CHART_TYPE_LINE : ChartEnum::REPORT_CHART_TYPE_BAR,
		];

		return new LaravelChart($options);
	}
}