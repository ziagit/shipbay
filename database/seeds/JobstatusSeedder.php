<?php

use App\Jobstatus;
use Illuminate\Database\Seeder;

class JobstatusSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jobstatus::truncate();

        $statuses =  [
            [
                'title' => 'Not picked yet',
                'key' => 'not-picked'
            ],
            [
                'title' => 'Picked up',
                'key' => 'pickedup'
            ],
            [
                'title' => 'On the way',
                'key' => 'en-route'
            ],
            [
                'title' => 'Arrived',
                'key' => 'arrived'
            ],
            [
                'title' => 'Delivered',
                'key' => 'delivered'
            ],
            [
                'title' => 'Received',
                'key' => 'received'
            ]
        ];

        Jobstatus::insert($statuses);
    }
}
