<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        $countries = [
            [
                'name' => 'United state',
                'code' => 'US'
            ],
            [
                'name' => 'Canada',
                'code' => 'CA'
            ]
        ];
        Country::insert($countries);
    }
}
