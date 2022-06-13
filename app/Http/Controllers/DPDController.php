<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DPDService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DPDQueryCityRequest;

class DPDController
{

    /**
     * @var \App\Services\DPDService
     */
    private DPDService $DPDService;

    public function __construct(DPDService $DPDService)
    {
        $this->DPDService = $DPDService;
    }

    /**
     * Query Cities.
     *
     * @param \App\Http\Requests\DPDQueryCityRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function queryCities(DPDQueryCityRequest $request): JsonResponse
    {
        $cities = $this->DPDService->queryCities($request->validated());
        return response()->json($cities);
    }
}
