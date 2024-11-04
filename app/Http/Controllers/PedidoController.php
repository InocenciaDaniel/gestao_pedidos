<?php

namespace App\Http\Controllers;

use App\Models\Materiais;
use App\Models\Pedido;
use App\Models\PedidoHasMateriais;
use App\Models\Solicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class PedidoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $materiais = Materiais::all();

        $solicitantes = Solicitante::where('user_id', auth()->user()->id)->get();

        return view('pedidos.create', compact('materiais', 'solicitantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'materiais' => 'required|array',
            'materiais.*' => 'exists:materiais,id',
            'quantidades' => 'required|array',
            'quantidades.*' => 'integer|min:1',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        DB::beginTransaction();
        try {

            $pedido = Pedido::create([
                'total' => 0,
                'status' => 'Novo',
                'solicitante_id' => auth()->user()->id,
                'grupo_id' => $request->grupo_id,
            ]);

            $total = 0;

            foreach ($request->materiais as $index => $materialId) {
                $quantidade = $request->quantidades[$index];

                $material = Materiais::findOrFail($materialId);
                $subTotal = $material->preco * $quantidade;

                PedidoHasMateriais::create([
                    'pedido_id' => $pedido->id,
                    'material_id' => $materialId,
                    'quantidade' => $quantidade,
                    'sub_total' => $subTotal,
                ]);

                $total += $subTotal;
            }
            $pedido->update(['total' => $total]);

            DB::commit();
            return redirect()->route('show.pedido', ['id' => $pedido->id])->with('success', 'Pedido criado com sucesso!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao criar o pedido: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $materiais = Materiais::all();
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido', 'materiais'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
