<?php

namespace App\Http\Controllers;

use App\Enums\SaleEnum;
use App\Http\Requests\SaleRequest;
use App\Services\SaleService;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends BaseController
{
	public function __construct(SaleService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}

	public function store(SaleRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(SaleRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()), Response::HTTP_CREATED);
	}

	public function destroy(string $id)
	{
		return $this->defaultResponse($this->service->deleteRecord($id), Response::HTTP_NO_CONTENT);
	}

	public function reportGenerate(string $period)
	{
		$title = ($period == SaleEnum::REPORT_MONTHLY) ? "monthly" : "annual";

		$options = [
			'chart_title' => 'Sale ' . $title,
			'report_type' => 'group_by_date',
			'model' => 'App\Models\Sale',
			'group_by_field' => 'date',
			'group_by_period' => ($period == SaleEnum::REPORT_MONTHLY) ? "month" : "year",
			'chart_type' => 'bar',
		];

		$chart = new LaravelChart($options);

		return view('sale_report', compact('chart'));
	}
}
