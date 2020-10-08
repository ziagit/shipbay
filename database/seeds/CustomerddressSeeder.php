<?php

use App\Customeraddress;
use Illuminate\Database\Seeder;

class CustomeraddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customeraddress::truncate();
        $addresses = [
            [
                'country_id'=> 1,
                'state_id'=> 1,
                'city_id' => 1,
                'zip_id' => 1,
                'address_id' => 1,
            ],
            [
                'country_id'=> 1,
                'state_id'=> 2,
                'city_id' => 2,
                'zip_id' => 2,
                'address_id' => 1,

            ]
        ];
        Customeraddress::insert($addresses);
    }
}
