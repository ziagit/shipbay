<?php

use Illuminate\Database\Seeder;
use App\Accessory;
use App\Carrier;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accessory::truncate();
        $accessories =  [
            [
                'name' => 'Business',
                'code' => 'bs'
            ],
            [
                'name' => 'Residential',
                'code' => 'rs'
            ],
            [
                'name' => 'Special location',
                'code' => 'sp'
            ],
            [
                'name' => 'Inside Pick-Up',
                'code' => 'in'
            ],
            [
                'name' => 'Tailgate',
                'code' => 'tl'
            ],
            [
                'name' => 'Appointment',
                'code' => 'ap'
            ],
            [
                'name' => 'Stackable',
                'code' => 'st'
            ],
            [
                'name' => 'Dangerous Goods',
                'code' => 'dg'
            ],
            [
                'name' => 'Temperature sensitive',
                'code' => 'tm'
            ],
        ];
        Accessory::insert($accessories);
        $accessory = Accessory::find(1);
        $carrier = Carrier::find(1);
        $carrier->accessories()->attach($accessory, ['src_value' => 10, 'des_value' => 12]);

        $accessory = Accessory::find(2);
        $carrier->accessories()->attach($accessory, ['src_value' => 15, 'des_value' => 17]);

        $accessory = Accessory::find(3);
        $carrier->accessories()->attach($accessory, ['src_value' => 18, 'des_value' => 20]);
        $accessory = Accessory::find(4);
        $carrier->accessories()->attach($accessory, ['src_value' => 1, 'des_value' => 2]);
        $accessory = Accessory::find(5);
        $carrier->accessories()->attach($accessory, ['src_value' => 8, 'des_value' => 2]);
        $accessory = Accessory::find(6);
        $carrier->accessories()->attach($accessory, ['src_value' => 8, 'des_value' => 9]);

        $accessory = Accessory::find(7);
        $carrier->accessories()->attach($accessory, ['src_value' => 0, 'des_value' => 2]);
        $accessory = Accessory::find(8);
        $carrier->accessories()->attach($accessory, ['src_value' => 0, 'des_value' => 2]);
        $accessory = Accessory::find(9);
        $carrier->accessories()->attach($accessory, ['src_value' => 0, 'des_value' => 9]);
    }
}
