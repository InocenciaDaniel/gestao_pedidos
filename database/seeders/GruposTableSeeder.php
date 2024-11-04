<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create([
            'nome' => 'Grupo 1',
            'saldo_permitido' => 5000.00,
            'aprovador_id' => 3,
        ]);

        Grupo::create([
            'nome' => 'Grupo 2',
            'saldo_permitido' => 100.00,
            'aprovador_id' => 4,
        ]);
    }
}
