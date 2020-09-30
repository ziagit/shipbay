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
                'name' => 'NL',
                'country_id' => 2
            ],
            [
                'name' => 'NS',
                'country_id' => 2
            ],
            [
                'name' => 'PE',
                'country_id' => 2
            ],
            [
                'name' => 'NB',
                'country_id' => 2
            ],
            [
                'name' => 'QC',
                'country_id' => 2
            ],
            [
                'name' => 'ON',
                'country_id' => 2
            ],
            [
                'name' => 'MB',
                'country_id' => 2
            ],
            [
                'name' => 'SK',
                'country_id' => 2
            ],
            [
                'name' => 'AB',
                'country_id' => 2
            ],
            [
                'name' => 'BC',
                'country_id' => 2
            ],
            [
                'name' => 'NU',
                'country_id' => 2
            ],
            [
                'name' => 'NT',
                'country_id' => 2
            ],
            [
                'name' => 'YT',
                'country_id' => 2
            ]
        ];

        State::insert($states);
    }
}
