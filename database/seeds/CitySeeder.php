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
                'name' => 'CAPE BROYLE',
                'state_id' => 1
            ],
            [
                'name' => 'CLARKES BEACH',
                'state_id' => 1
            ],
            [
                'name' => 'COLEYS POINT SOUTH',
                'state_id' => 1
            ],
            [
                'name' => 'ST. JOHN\'S',
                'state_id' => 1
            ],
            [
                'name' => 'HALIFAX',
                'state_id' => 2
            ],
            [
                'name' => 'FRENCH VILLAGE',
                'state_id' => 2
            ],
            [
                'name' => 'GLEN HAVEN',
                'state_id' => 2
            ],
            [
                'name' => 'SEABRIGHT',
                'state_id' => 2
            ],
            [
                'name' => 'STRATFORD',
                'state_id' => 3
            ],
            [
                'name' => 'CHARLOTTETOWN',
                'state_id' => 3
            ],
            [
                'name' => 'MONCTON',
                'state_id' => 4
            ],
            [
                'name' => 'LUTES MOUNTAIN',
                'state_id' => 4
            ]
        ];

        City::insert($cities);

    }
}
