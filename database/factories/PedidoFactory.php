<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Solicitante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomFloat(2, 100, 1000), 
            'status' => $this->faker->randomElement(['Novo', 'Em Revisão', 'Alterações Solicitadas', 'Aprovado', 'Rejeitado']),
            'solicitante_id' => Solicitante::factory(), 
            'grupo_id' => Grupo::factory(), 
        ];
    }
}
