<?php

namespace Database\Seeders;

use App\Models\Solicitante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolicitantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Solicitante::create([
            'user_id' => 1,
            'grupo_id' => 1,
        ]);

        Solicitante::create([
            'user_id' => 1,
            'grupo_id' => 2,
        ]);

        Solicitante::create([
            'user_id' => 2,
            'grupo_id' => 1,
        ]);
    }
}
