<?php

namespace App\Http\Controllers;

use App\Enums\SaleEnum;
use App\Http\Requests\SaleRequest;
use App\Services\ReportService;
use App\Services\SaleService;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends BaseController
{
	/**
	 * @var ReportService
	 */
	protected ReportService $reportService;

	public function __construct(SaleService $service)
	{
		parent::__construct($service);

		$this->reportService = new ReportService();
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
		$chart = $this->reportService->generateSalePerPeriodReport($period);

		$html = view(SaleEnum::REPORT_VIEW, compact('chart'))->render();

		$pdf = $this->reportService->generatePDF($html);

		return $pdf->stream('report_sale_' . $period . '.pdf');
	}
}
