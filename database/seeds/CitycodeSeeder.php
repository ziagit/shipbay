<?php

use Illuminate\Database\Seeder;
use App\Citycode;
use App\City;

class CitycodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Citycode::truncate();
        $zips =  [
            ['postal_code' => 'A0A 1P0'],

            ['postal_code' => 'B3H 1X3'],
            ['postal_code' => 'B3Z 2X6'],
            ['postal_code' => 'B3Z 2S2'],
            ['postal_code' => 'B3Z 2Y1'],

            ['postal_code' => 'A0A 1X0'],

            ['postal_code' => 'A1A 0A2'],
            ['postal_code' => 'A1A 0A4'],
            ['postal_code' => 'A1A 0A5'],

            ['postal_code' => 'A1A 0A18393'],
            ['postal_code' => 'A1A 0A18394'],
            ['postal_code' => 'A1A 0A18395'],
            ['postal_code' => 'A1A 0A18396'],
            ['postal_code' => 'A1A 0A18397'],
        ];

        Citycode::insert($zips);

        $city = City::find(1);
        $city->citycodes()->attach(1);

        $city = City::find(2);
        $city->citycodes()->attach([2, 3, 4, 5]);

        $city = City::find(3);
        $city->citycodes()->attach(6);

        $city = City::find(4);
        $city->citycodes()->attach([7,8,9]);

        $city = City::find(5);
        $city->citycodes()->attach([10,11,12,13,14]);

    }
}
