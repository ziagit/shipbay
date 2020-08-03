<?php

use Illuminate\Database\Seeder;
use App\Itemtype;
class ItemtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Itemtype::truncate();

        $itemtype =  [
            [
              'title' => 'Pallets',
            ],
            [
              'title' => 'Pieces',
            ],
            [
              'title' => 'Bundles',
            ],
            [
              'title' => 'Box',
            ],
            [
              'title' => 'Crate',
            ]
          ];

          Itemtype::insert($itemtype);
    }
}
