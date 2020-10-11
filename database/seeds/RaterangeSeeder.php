<?php

use Illuminate\Database\Seeder;
use App\Raterange;
class RaterangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Raterange::truncate();
        $ranges =  [
            [
                'name' => '1k',
                'value' => 1000
            ],
            [
                'name' => '2k',
                'value' => 2000
            ],
            [
                'name' => '3k',
                'value' => 3000
            ],
            [
                'name' => '4k',
                'value' => 4000
            ],
            [
                'name' => '5k',
                'value' => 5000
            ],
            [
                'name' => '10k',
                'value' => 10000
            ]
        ];
        Raterange::insert($ranges);
    }
}
