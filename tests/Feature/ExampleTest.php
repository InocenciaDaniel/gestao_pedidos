<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response()
    {
        // Cria um usuário com o campo perfil preenchido
        $user = User::factory()->create([
            'perfil' => 'Solicitante' // ou o valor padrão que você precisa
        ]);

        // Autentica o usuário e tenta acessar a rota
        $response = $this->actingAs($user)->get('home');

        $response->assertStatus(200);
    }

    public function test_example()
    {
        $user = User::factory()->create([
            'perfil' => 'Solicitante'
        ]);

        $response = $this->actingAs($user)->get('home');

        $response->assertStatus(200);
    }

    public function test_the_application_redirects()
    {
        $response = $this->get('home');

        $response->assertStatus(302); // Verifica o redirecionamento
    }
}
