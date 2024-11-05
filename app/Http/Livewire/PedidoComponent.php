<?php

namespace App\Http\Livewire;

use App\Models\PedidoHasMateriais;
use Livewire\Component;
use App\Models\Pedido;
use App\Models\Materiais;

class PedidoComponent extends Component
{
    public Pedido $pedido;
    public $materiais;
    public $pedidoMateriais = [];
    public $total = 0;


    protected $rules = [
        'pedidoMateriais.*.material_id' => 'required|exists:materiais,id',
        'pedidoMateriais.*.quantidade' => 'required|numeric|min:1',
    ];

    public function mount($pedidoId)
    {
        $this->pedido = Pedido::findOrFail($pedidoId);
        $this->materiais = Materiais::all();
        $this->pedidoMateriais = $this->pedido->materiais->map(function ($material) {
            return [
                'id' => $material->id,
                'material_id' => $material->material->id,
                'quantidade' => $material->quantidade,
                'sub_total' => $material->sub_total,
            ];
        })->toArray();

        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->total = array_reduce($this->pedidoMateriais, function ($carry, $material) {
            return $carry + ($material['sub_total'] ?? 0);
        }, 0);

        $this->pedido->total = $this->total;
        $this->pedido->save();
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'pedidoMateriais')) {
            $this->calcularSubTotal();
            // $this->calcularTotal();
        }
    }

    public function calcularSubTotal()
    {
        foreach ($this->pedidoMateriais as $index => $material) {
            if (isset($material['material_id']) && isset($material['quantidade'])) {
                $materialPreco = Materiais::find($material['material_id'])->preco ?? 0;
                $this->pedidoMateriais[$index]['sub_total'] = (float) $material['quantidade'] * (float) $materialPreco;
            }
        }
    }

    public function addMaterial()
    {
        $this->pedidoMateriais[] = ['material_id' => null, 'quantidade' => 1, 'sub_total' => 0];
    }

    public function removerMaterial($index)
    {

        if (isset($this->pedidoMateriais[$index]['id'])) {
            $pedidoMaterial = PedidoHasMateriais::findOrFail($this->pedidoMateriais[$index]['id']);
            if ($pedidoMaterial->id) {
                $pedidoMaterial->delete();
            }
        }
        unset($this->pedidoMateriais[$index]);
        $this->pedidoMateriais = array_values($this->pedidoMateriais);

        $this->calcularTotal();
        session()->flash('success', 'Material removido com sucesso!');
    }

    public function actualizarMaterial()
    {
        $this->validate();

        foreach ($this->pedidoMateriais as $materialData) {

            $this->pedido->materiais()->updateOrCreate(
                ['id' => $materialData['id'] ?? null],
                [
                    'material_id' => $materialData['material_id'],
                    'quantidade' => $materialData['quantidade'],
                    'sub_total' => $materialData['quantidade'] * Materiais::find($materialData['material_id'])->preco,
                ]
            );
        }

        $this->calcularTotal();
        session()->flash('success', 'Pedido atualizado com sucesso!');
    }



    public function render()
    {
        return view('livewire.pedido-component');
    }

    public function finalizarAlteracoes()
    {
        $this->pedido->status = 'Novo';
        $this->pedido->save();
        session()->flash('success', 'Pedido alterado com sucesso!');
    }
    public function aprovar()
    {
        if ($this->pedido->grupo->saldo_permitido >= $this->pedido->total) {
            if ($this->pedido->grupo->aprovador_id === auth()->user()->id) {
                $this->pedido->status = 'Aprovado';
                $this->pedido->save();
                session()->flash('success', 'Pedido aprovado com sucesso!');
            }
        } else {
            $this->pedido->status = 'Rejeitado';
            $this->pedido->save();
            session()->flash('error', 'Pedido rejeitado por causa do total do pedido!');
        }

    }

    public function solicitarAlteracoes()
    {
        $this->pedido->status = 'Alterações Solicitadas';
        $this->pedido->save();
        session()->flash('success', 'Alterações solicitadas com sucesso!');
    }

    public function rejeitar()
    {
        $this->pedido->status = 'Rejeitado';
        $this->pedido->save();
        session()->flash('success', 'Pedido rejeitado com sucesso!');
    }

}

