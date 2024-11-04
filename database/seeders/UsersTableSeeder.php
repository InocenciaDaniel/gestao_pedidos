<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Inocencia Daniel',
            'email' => 'inocenciadaniel@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password1234'),
            'perfil' => 'Solicitante',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Daniel Domingos',
            'email' => 'domingos@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password1234'),
            'perfil' => 'Solicitante',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Antonio Pedro',
            'email' => 'antonio@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password1234'), 
            'perfil' => 'Aprovador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Carlos Mateus',
            'email' => 'carlos@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password1234'), 
            'perfil' => 'Aprovador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
