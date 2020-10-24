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
                'min_rate' => 30,
                '_0k_1k' => 10,
                '_1k_2k' => 9,
                '_2k_3k' => 8,
                '_3k_4k' => 7,
                '_4k_5k' => 6,
                '_5k_10k' => 5,
                'above_10k' => 4,
                'fsc' => 30,
                'transit_day' => 2,
                'carrier_id' => 1
            ]
        ];
        Rate::insert($rates);

        $rate = Rate::find(1);
        $rate->addresses()->attach([1,2]);
        $rate = Rate::find(2);
        $rate->addresses()->attach([2,1]);

    }
}
