<?php

use Illuminate\Database\Seeder;
use App\Statecode;
class StatecodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statecode::truncate();

        $states =  [
            [
                'postal_code' => '10001',
                'state_id' => 1
            ],
            [
                'postal_code' => '99501',
                'state_id' => 1
            ],
            [
                'postal_code' => '85001',
                'state_id' => 2
            ]
        ];

        Statecode::insert($states);
    }
}
