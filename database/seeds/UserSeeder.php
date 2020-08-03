<?php

use App\Role;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = new User();
        $user->name = 'zia';
        $user->email = 'zia@gmail.com';
        $user->password = Hash::make('123');

        $user->save();
        
        $role = Role::find(1);
        $user->roles()->attach($role);
    }
}
