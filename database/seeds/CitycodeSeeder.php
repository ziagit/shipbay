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
            [
                'postal_code' => '10001',
            ],
            [
                'postal_code' => '86390',
            ],
            [
                'postal_code' => '10309',
            ],
            [
                'postal_code' => '99501',
            ],
            [
                'postal_code' => '99801',
            ]
        ];

        Citycode::insert($zips);

        $city = City::find(1);
        $city->citycodes()->attach([1,2]);

        $city = City::find(2);
        $city->citycodes()->attach([3,4]);

        $city= City::find(3);
        $city->citycodes()->attach(5);
    }
}
