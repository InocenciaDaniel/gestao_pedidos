<?php

namespace Tests\Feature;

use App\Models\Grupo;
use App\Models\Pedido;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function somente_solicitantes_podem_criar_pedidos()
    {

        $user_solicitante = User::factory()->create([
            'perfil' => 'Solicitante',
        ]);

        $response = $this->actingAs($user_solicitante)
            ->post(route('store.pedido'), [
                'grupo_id' => 1,
                'materiais' => [
                    '0' => 1,
                    '1' => 2,
                ],
                'quantidades' => [
                    '0' => 10,
                    '1' => 5,
                ],
            ])
            ->assertStatus(302);
        $response->assertSessionHas('success', 'Pedido criado com sucesso!');
    }

    /** @test */
    public function somente_aprovador_do_grupo_pode_aprovar_pedido()
    {
        $user_solicitante = User::factory()->create([
            'perfil' => 'Solicitante',
        ]);

        $aprovador = User::factory()->create(['perfil' => 'Aprovador']);

        $grupo = Grupo::factory()->create(
            [
                'saldo_permitido' => 5000,
                'aprovador_id' => $aprovador->id,
            ]
        );

        $response = $this->actingAs($user_solicitante)
            ->post(route('store.pedido'), [
                'grupo_id' => $grupo->id,
                'materiais' => ['0' => 1,],
                'quantidades' => ['0' => 1,],
            ])
            ->assertStatus(302);

        $pedido = Pedido::latest()->first();

        $response->assertSessionHas('success', 'Pedido criado com sucesso!');
        Livewire::actingAs($aprovador)
        ->test('pedido-component', ['pedidoId' => $pedido->id])
        ->call('aprovar')
        ->assertHasNoErrors();
    }
}
