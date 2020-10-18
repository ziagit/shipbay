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
            ['postal_code' => 'A0A4G0','address_id'=>1],
            ['postal_code' => 'B0P1N0','address_id'=>2],
        ];

        Citycode::insert($zips);

/*         $city = City::find(1);
        $city->citycodes()->attach(1);

        $city = City::find(2);
        $city->citycodes()->attach([2, 3, 4, 5]);

        $city = City::find(3);
        $city->citycodes()->attach(6);

        $city = City::find(4);
        $city->citycodes()->attach([7,8,9]);

        $city = City::find(5);
        $city->citycodes()->attach([10,11,12,13,14]); */

    }
}
