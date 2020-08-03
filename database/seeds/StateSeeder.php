<?php

use Illuminate\Database\Seeder;
use App\State;
class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::truncate();

        $states =  [
            [
                'name' => 'New yark',
                'country_id' => 1
            ],
            [
                'name' => 'Alaska',
                'country_id' => 1
            ],
            [
                'name' => 'Arizona',
                'country_id' => 2
            ],
            [
                'name' => 'Vencover',
                'country_id' => 2
            ],
            [
                'name' => 'Torento',
                'country_id' => 2
            ]
        ];

        State::insert($states);
    }
}
