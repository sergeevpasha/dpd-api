<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DPDService;
use Illuminate\Http\JsonResponse;
use SergeevPasha\DPD\DTO\DeliveryDto;
use SergeevPasha\DPD\Libraries\DPDClient;
use App\Http\Requests\DPDQueryCityRequest;
use App\Http\Requests\DPDCalculatePriceRequest;
use App\Http\Requests\DPDFindByTrackNumberRequest;

class DPDController
{
    /**
     * DPD Client Instance.
     *
     * @var \SergeevPasha\DPD\Libraries\DPDClient
     */
    private DPDClient $client;

    /**
     * @var \App\Services\DPDService
     */
    private DPDService $DPDService;

    public function __construct(DPDClient $client, DPDService $DPDService)
    {
        $this->client     = $client;
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


    /**
     * @param \App\Http\Requests\DPDCalculatePriceRequest $request
     *
     * @throws \BenSampo\Enum\Exceptions\InvalidEnumKeyException
     * @throws \SoapFault
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateDeliveryPrice(DPDCalculatePriceRequest $request): JsonResponse
    {
        $delivery = DeliveryDto::fromArray($request->validated());
        $data     = $this->client->getPrice($delivery);
        return response()->json($data);
    }

    /**
     * Find track by number.
     *
     * @param \App\Http\Requests\DPDFindByTrackNumberRequest $request
     *
     * @throws \SoapFault
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @return \Illuminate\Http\JsonResponse
     */
    public function findByTrackNumber(DPDFindByTrackNumberRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data = $this->client->findByTrackNumber($data['number']);
        return response()->json($data);
    }
}
