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
                'name' => 'Is it an appointment',
                'code' => 'ap'
            ],
            [
                'name' => 'Stackable',
                'code' => 'st'
            ],
            [
                'name' => 'Temperature sensitive',
                'code' => 'tm'
            ],
            [
                'name' => 'Dangerous Goods',
                'code' => 'dg'
            ]
        ];
        Accessory::insert($accessories);
        $accessory = Accessory::find(1);
        $carrier = Carrier::find(1);
        $carrier->accessories()->attach($accessory, ['src_value' => 10, 'des_value' => 12]);

        $accessory = Accessory::find(2);
        $carrier->accessories()->attach($accessory, ['src_value' => 15, 'des_value' => 17]);

        $accessory = Accessory::find(3);
        $carrier->accessories()->attach($accessory, ['src_value' => 18, 'des_value' => 20]);
    }
}
