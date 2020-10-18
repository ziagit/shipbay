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
                'name' => 'Victoria',
                'state_id' => 1
            ],
            [
                'name' => 'Greenwood',
                'state_id' => 1
            ]
        ];

        City::insert($cities);

    }
}
