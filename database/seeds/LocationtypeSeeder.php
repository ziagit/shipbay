<?php

use Illuminate\Database\Seeder;
use App\Locationtype;
class LocationtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locationtype::truncate();

        $locationtype =  [
            [
              'title' => 'Business',
              'price' => 40
            ],
            [
              'title' => 'Residential',
              'price' => 41
            ],
            [
              'title' => 'Special Location',
              'price' => 42
            ]
          ];

          Locationtype::insert($locationtype);
    }
}
