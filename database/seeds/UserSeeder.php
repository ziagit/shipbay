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
        $users =  [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'Shipper A',
                'email' => 'shipper@gmail.com',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'Carrier A',
                'email' => 'carrier@gmail.com',
                'password' => Hash::make('123')
            ]
        ];

        User::insert($users);

        $role = Role::find(1);
        $user = User::find(1);
        $user->roles()->attach($role);
        $role = Role::find(2);
        $user = User::find(2);
        $user->roles()->attach($role);
        $role = Role::find(3);
        $user = User::find(3);
        $user->roles()->attach($role);
    }
}
