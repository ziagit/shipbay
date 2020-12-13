<?php

use App\Carrier;
use App\State;
use App\City;
use App\Citycode;
use Illuminate\Database\Seeder;
use App\Rate;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::truncate();
        $rates = [
            [
                'min_rate' => 25,
                '_0k_1k' => 9,
                '_1k_2k' => 8,
                '_2k_3k' => 7,
                '_3k_4k' => 6,
                '_4k_5k' => 5,
                '_5k_10k' => 4,
                'above_10k' => 3,
                'fsc' => 20,
                'transit_day' => 1,
                'carrier_id' => 1
            ],
            [
                'min_rate' => 10,
                '_0k_1k' => 5,
                '_1k_2k' => 4,
                '_2k_3k' => 3,
                '_3k_4k' => 2,
                '_4k_5k' => 2.8,
                '_5k_10k' => 2.5,
                'above_10k' => 2,
                'fsc' => 15,
                'transit_day' => 1,
                'carrier_id' => 1
            ]
        ];
        Rate::insert($rates);

        $rate = Rate::find(1);
        $rate->addresses()->attach([1,2]);
        $rate = Rate::find(2);
        $rate->addresses()->attach([1,1]);

    }
}
