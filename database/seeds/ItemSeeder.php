<?php

use Illuminate\Database\Seeder;
use App\Item;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::truncate();
        $items =[
            'description' => 'Computer',
            'dimentional_weight' => 2087,
            'itemtype_id' => 1,
            'deliveryclass_id' => 1
        ];
        Item::insert($items);
    }
}
