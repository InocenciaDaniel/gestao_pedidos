<?php

namespace Tests\Unit;

use App\Http\Livewire\PedidoComponent;
use App\Models\Grupo;
use App\Models\User;
use Database\Factories\GrupoFactory;
use Tests\TestCase;
use App\Models\Pedido;
use App\Models\Materiais;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;
}
