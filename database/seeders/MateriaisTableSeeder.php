<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materiais;
use Illuminate\Support\Facades\DB;

class MateriaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materiais::create([
            'nome' => 'Bloco de notas',
            'descricao' => 'Material de Escritório',
            'preco' => 500.00,
        ]);

        Materiais::create([
            'nome' => 'Caneta esferográfica',
            'descricao' => 'Material Escritório',
            'preco' => 300.00,
        ]);

        Materiais::create([
            'nome' => 'Multímetro digital',
            'descricao' => 'Material Eletrônicos',
            'preco' => 1500.00,
        ]);

        Materiais::create([
            'nome' => 'Fonte de alimentação ajustável',
            'descricao' => 'Material Eletrônicos',
            'preco' => 5000.00,
        ]);
    }
}
