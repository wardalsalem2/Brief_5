<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ward',
                'email' => 'wardd@gmail.com',
                'password' => Hash::make('password1234'), 
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hamzeh',
                'email' => 'albaijathamzeh@gmail.com',
                'password' => Hash::make('password1234'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
<<<<<<< HEAD

            [
                'name' => 'Raghad',
                'email' => 'Raghad@gmail.com',
                'password' => Hash::make('password1234'),
                'role' => 'admin',
=======
            [
                'name' => 'sondos',
                'email' => 'sondos@gmail.com',
                'password' => Hash::make('password1234'),
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'omayma',
                'email' => 'omayma@gmail.com',
                'password' => Hash::make('password1234'),
                'role' => 'owner',
>>>>>>> 41a04dda0859af62488aeeae623c136d381ed746
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}