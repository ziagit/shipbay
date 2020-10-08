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
            'first_name' => 'Carrier 1',
            'last_name' => 'Carrier 1 last name',
            'company' => 'Amu CLoud',
            'website' => 'coffeequery.com',
            'detail' => 'You can write here details about one of your team members. You can give more details about what they do. Feel free to add some links for people to be able to follow them outside the site.',
            'logo' => 'no logo',
            'address_id'=> 1,
            'contact_id' => 1,
            'user_id' => 3,
        ];
        
        Carrier::insert($carriers);
    }
}
