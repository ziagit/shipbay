<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();
        $contacts = [
            [
                'name'=> 'Zia',
                'phone' => '0775059616',
                'email'=> 'zia@shipbay.ca',
            ],
            [
                'name'=> 'Ali',
                'phone' => '0745340354',
                'email'=> 'ali@shipbay.ca',
            ]
        ];
        Contact::insert($contacts);
    }
}
