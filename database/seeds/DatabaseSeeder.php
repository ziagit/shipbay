<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(CountrySeeder::class);
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
    }
}
