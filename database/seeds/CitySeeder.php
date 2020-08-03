<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        $cities =  [
            [
                'name' => 'Holtsville',
                'state_id' => 1
            ],
            [
                'name' => 'Fishers Island',
                'state_id' => 1
            ],
            [
                'name' => 'Staten Island',
                'state_id' => 1
            ],
            [
                'name' => 'Anchorage',
                'state_id' => 2
            ],
            [
                'name' => 'Sitka',
                'state_id' => 2
            ]
        ];

        City::insert($cities);

    }
}
