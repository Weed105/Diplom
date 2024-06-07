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
                'title' => 'Администратор',
            ],
            [
                'id'    => 2,
                'title' => 'Учреждение',
            ],
            [
                'id'    => 3,
                'title' => 'Студент',
            ]
        ];

        Role::insert($roles);
    }
}
