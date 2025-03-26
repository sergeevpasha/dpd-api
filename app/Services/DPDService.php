<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class DPDService
{
    /**
     * @var \App\Models\City
     */
    private City $cityRepository;

    public function __construct(City $city)
    {
        $this->cityRepository = $city;
    }

    /**
     * Query Cities.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function queryCities(array $data): Collection
    {
        $searchTerms = explode(' ', $data['query']);
        $tsQuery = implode(' & ', array_map(fn($term) => $term . ':*', $searchTerms));

        return $this->cityRepository::whereRaw("to_tsvector('russian', name) @@ to_tsquery('russian', ?)")
            ->setBindings([$tsQuery])
            ->with('terminals')
            ->get();
    }
}
