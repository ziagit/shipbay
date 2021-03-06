<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

        //if you get error; NameSeeder does not exist
        // run this
        //composer dump-autoload
        //php artisan optimize
        //php artisan db:seed
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ItemtypeSeeder::class);
        $this->call(LocationtypeSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(RaterangeSeeder::class);
        $this->call(JobstatusSeedder::class);
        $this->call(ShipperSeeder::class);
        $this->call(CarrierSeeder::class);
        $this->call(AccessorySeeder::class);
        $this->call(RateSeeder::class);
        $this->call(ItemSeeder::class);

        $this->call(AboutSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(CarrierFaqSeeder::class);
        $this->call(ShipperFaqSeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(PrivacySeeder::class);
    }
}
