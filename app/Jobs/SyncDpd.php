<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\City;
use App\Models\Country;
use App\Models\Terminal;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use SergeevPasha\DPD\Libraries\DPDClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncDpd implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 1;

    /**
     * DPD Client
     *
     * @var \SergeevPasha\DPD\Libraries\DPDClient
     */
    protected DPDClient $DPDClient;

    public function __construct(DPDClient $DPDClient)
    {
        $this->DPDClient = $DPDClient;
    }

    /**
     * Sync Dpd Data
     *
     * @throws \Throwable
     * @return void
     */
    public function handle(): void
    {
        foreach (Country::cursor() as $country) {
            $cities = $this->DPDClient->getCountryCities($country->abbreviation);
            /** @var \SergeevPasha\DPD\DTO\CityDto $city */
            foreach ($cities as $city) {
                City::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'city_id'    => $city->cityId,
                    ], [
                        'name'         => $city->name,
                        'code'         => $city->code,
                        'abbreviation' => $city->abbreviation,
                        'region_code'  => $city->regionCode,
                        'region_name'  => $city->regionName,
                        'min_index'    => $city->indexMin,
                        'max_index'    => $city->indexMax

                    ]
                );
            }
        }

        /** @var \SergeevPasha\DPD\DTO\TerminalDto $terminal */
        foreach ($this->DPDClient->getTerminals() as $terminal) {
            $city = City::where('city_id', '=', $terminal->cityId)->first(['id', 'country_id']);
            if ($city) {
                Terminal::updateOrCreate(
                    [
                        'country_id' => $city->country_id,
                        'city_id'    => $city->id,
                        'name'       => $terminal->name,
                        'code'       => $terminal->code,
                    ], [
                        'index'               => $terminal->index,
                        'region_code'         => $terminal->regionCode,
                        'region_name'         => $terminal->regionName,
                        'city_code'           => $terminal->cityCode,
                        'city_name'           => $terminal->cityName,
                        'street'              => $terminal->street,
                        'street_abbreviation' => $terminal->streetAbbr,
                        'house'               => $terminal->house,
                        'structure'           => $terminal->structure,
                        'ownership'           => $terminal->ownership,
                        'description'         => $terminal->description,
                        'latitude'            => $terminal->latitude,
                        'longitude'           => $terminal->longitude,
                    ]
                );
            }
        }
    }

    /**
     * Failed Job
     *
     * @param $exception
     *
     * @throws \Throwable
     * @return void
     */
    public function failed($exception): void
    {
        Log::critical('Dpd Sync Failed!', ['error' => $exception->getMessage()]);
    }
}
