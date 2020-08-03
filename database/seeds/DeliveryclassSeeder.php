<?php

use App\Deliveryclass;
use Illuminate\Database\Seeder;

class DeliveryclassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deliveryclass::truncate();

        $classes =  [
            [
                'class' => 500,
                'price' => 10
            ],
            [
                'class' => 400,
                'price' => 12
            ],
            [
                'class' => 300,
                'price' => 20
            ],
            [
                'class' => 200,
                'price' => 23
            ],
        ];
        Deliveryclass::insert($classes);
    }
}
