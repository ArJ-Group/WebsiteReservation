<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {

        $users =  [
            [
                'name' => 'Omar Abdul R.A',
                'email' => 'admin1@gmail.com',
                'username' => 'AdminOmar',
                'phone' => '6582123533955',
                'password' => Hash::make('admin'),
                'is_admin' => true,
                'image' => 'images/adminDefault.jpg',
            ],
            [
                'name' => 'Widiareta Safitri',
                'email' => 'admin2@gmail.com',
                'username' => 'AdminWidi',
                'phone' => '65255464132135',
                'password' => Hash::make('admin'),
                'is_admin' => true,
                'image' => 'images/adminDefault.jpg',
            ],
        ];

        User::insert($users);
    }
}
