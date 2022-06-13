<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Default countries.
     *
     * @var array
     */
    protected array $countries = [
        [
            'name'         => 'Россия',
            'abbreviation' => 'RU',
            'flag'         => '/svg/flags/russia.svg'
        ],
        [
            'name'         => 'Казахстан',
            'abbreviation' => 'KZ',
            'flag'         => '/svg/flags/kazakhstan.svg',
        ],
        [
            'name'         => 'Беларусь',
            'abbreviation' => 'BY',
            'flag'         => '/svg/flags/belarus.svg',
        ],
        [
            'name'         => 'Украина',
            'abbreviation' => 'UA',
            'flag'         => '/svg/flags/ukraine.svg',
        ],
        [
            'name'         => 'Киргизия',
            'abbreviation' => 'KG',
            'flag'         => '/svg/flags/kyrgyzstan.svg',
        ],
    ];

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->getOutput()->progressStart(count($this->countries));
        foreach ($this->countries as $country) {
            Country::updateOrCreate($country);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
