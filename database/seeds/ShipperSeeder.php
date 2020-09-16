<?php

use App\Shipper;
use Illuminate\Database\Seeder;

class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipper::truncate();
        $shipper = [
            'first_name' => 'Shipper 1',
            'last_name' => 'Shipper 1 last name',
            'address' => 'House no. 13, 25th st',
            'phone' => '0775059616',
            'user_id' => 2,
        ];
        Shipper::insert($shipper);
    }
}
