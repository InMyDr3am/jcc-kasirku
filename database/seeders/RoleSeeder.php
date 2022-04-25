<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = [
            [
                'role' => 'Admin Kasir',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'role' => 'Kasir',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
            
        \DB::table('role_user')->insert($role_user);
    }
}
