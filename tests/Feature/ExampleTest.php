<?php

namespace Tests\Feature;

use App\Models\Grupo;
use App\Models\Pedido;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function aplicação_retorna_uma_resposta_sucesso_se_usuario_autenticado()
    {
        $user = User::factory()->create([
            'perfil' => 'Aprovador',
        ]);
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
    }

    /** @test */
    public function aplicação_retorna_uma_resposta_falhada_se_usuario_nao_autenticado()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }

    
}
