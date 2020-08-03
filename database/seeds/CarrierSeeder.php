<?php

use Illuminate\Database\Seeder;
use App\Carrier;
class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrier::truncate();
        $carriers = [
            'first_name' => 'Zia',
            'last_name' => 'Akbari',
            'address' => 'House no. 13, 25th st',
            'company' => 'Amu CLoud',
            'website' => 'coffeequery.com',
            'phone' => '+9375059616',
            'detail' => 'You can write here details about one of your team members. You can give more details about what they do. Feel free to add some links for people to be able to follow them outside the site.',
            'logo' => 'no logo',
            'user_id' => 1,
            'country_id' => 1,
            'state_id' => 1,
            'city_id' => 1,
            'citycode_id' => 1,
        ];
        Carrier::insert($carriers);
    }
}
