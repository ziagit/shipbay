<?php

use App\Deliveryclass;
use App\Statecode;
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
        $this->call(StateSeeder::class);
        $this->call(StatecodeSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CitycodeSeeder::class);
        $this->call(ItemtypeSeeder::class);
        $this->call(LocationtypeSeeder::class);
        $this->call(JobstatusSeedder::class);
        $this->call(DeliveryclassSeeder::class);
        $this->call(CarrierSeeder::class);
        $this->call(AccessorySeeder::class);
        $this->call(RateSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ItemSeeder::class);
    }
}
