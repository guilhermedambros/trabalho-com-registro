<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Gestor',
            ],
            [
                'id'    => 3,
                'title' => 'Associado',
            ],
            [
                'id'    => 4,
                'title' => 'Prestador de serviço',
            ],
        ];

        Role::insert($roles);
    }
}
