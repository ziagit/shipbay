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
                'address' => "Rattles Road",
                'zip' => 'A0A0A0',
                'city' => 'ALberta',
                'state' => 'NL',
                'locationtype_id' => 1,
                'country_id' => 1,
            ],
            [
                'address' => "Rattles Road",
                'zip' => 'A1A1A1',
                'city' => 'ALberta',
                'state' => 'NS',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ]
        ];
        Address::insert($address);
    }
}
