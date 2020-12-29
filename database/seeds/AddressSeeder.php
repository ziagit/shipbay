<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::truncate();
        $address =  [
            [
                'street' => "Rattles Road",
                'street_number' => "123",
                'zip' => 'A0A4G0',
                'city' => 'Vancouver',
                'state' => 'BC',
                'country_id' => 1,
            ],
            [
                'street' => "PO BOX",
                'street_number' => "1392",
                'zip' => 'B0P1N0',
                'city' => 'Victoria',
                'state' => 'BC',
                'country_id' => 1,
            ],
            [
                'street' => "Central Ave",
                'street_number' => "257",
                'zip' => 'B0P1N0',
                'city' => 'Midway',
                'state' => 'BC',
                'country_id' => 1,
            ],
            [
                'street' => "ch. Bedford",
                'street_number' => "119",
                'zip' => 'B0P1N0',
                'city' => 'Regional District of Kootenay Boundary',
                'state' => 'BC',
                'country_id' => 1,
            ],
            [
                'street' => "STREET",
                'street_number' => "232",
                'zip' => 'B4R2G5',
                'city' => 'Maple Ridge',
                'state' => 'BC',
                'country_id' => 1,
            ],
            [
                'street' => "CLEVELAND Ave",
                'street_number' => "1392",
                'zip' => 'B8B0S8',
                'city' => 'Squamish',
                'state' => 'BC',
                'country_id' => 1,
            ],
            [
                'street' => "Rte",
                'street_number' => "2",
                'zip' => 'C0A2B0',
                'city' => 'SOURIS',
                'state' => 'BC',
                'country_id' => 1,
            ]
        ];
        Address::insert($address);
    }
}
