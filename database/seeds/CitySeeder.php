<?php

use App\City;
use Illuminate\Database\Seeder;

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
                'name' => 'Vancouver',
                'state_id' => 1
            ],
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
