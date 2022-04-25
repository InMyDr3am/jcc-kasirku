<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Muhammad Fauzi',
                'role_user_id' => '1',
                'username' => 'fauzir',
                'email' => 'fauzi.r@gmail.com',
                'password' => Hash::make('12345678'),  
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => 'Fajar Diki',
                'role_user_id' => '2',
                'username' => 'fajad',
                'email' => 'fajar@gmail.com',
                'password' => Hash::make('12345678'),  
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            
        ];
            
        \DB::table('users')->insert($user);
    }
}
