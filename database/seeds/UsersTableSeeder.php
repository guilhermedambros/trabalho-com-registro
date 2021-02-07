<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Guilherme',
                'email'          => 'guilherme.dambros@gmail.com',
                'password'       => bcrypt('123123'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
