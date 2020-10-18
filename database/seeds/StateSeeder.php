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
                'name' => 'BC',
                'country_id' => 1
            ],
            [
                'name' => 'NL',
                'country_id' => 1
            ],
            [
                'name' => 'NS',
                'country_id' => 1
            ],
            [
                'name' => 'PE',
                'country_id' => 1
            ],
            [
                'name' => 'NB',
                'country_id' => 1
            ],
            [
                'name' => 'QC',
                'country_id' => 1
            ],
            [
                'name' => 'ON',
                'country_id' => 1
            ],
            [
                'name' => 'MB',
                'country_id' => 1
            ],
            [
                'name' => 'SK',
                'country_id' => 1
            ],
            [
                'name' => 'AB',
                'country_id' => 1
            ],
            [
                'name' => 'NU',
                'country_id' => 1
            ],
            [
                'name' => 'NT',
                'country_id' => 1
            ],
            [
                'name' => 'YT',
                'country_id' => 1
            ]
        ];

        State::insert($states);
    }
}
