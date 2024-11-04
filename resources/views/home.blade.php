@extends('layouts.app')

@section('content')

<style>
    .table-fixed {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .table-fixed th,
    .table-fixed td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .table-fixed th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-transform: uppercase;
    }

    .table-fixed tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-fixed tbody tr:hover {
        background-color: #e2e2e2;
    }

    .table-fixed td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="grid px-8 xl:p-0 gap-y-4">

    <div class="col-span-3 bg-white p-6 rounded-xl border border-gray-50 flex flex-col space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-sm text-gray-600 font-bold tracking-wide">Lista de Pedidos</h2>
            @if (Auth::user()->perfil == "Solicitante")
                <a href="{{ route('create.pedido') }}"
                    class="px-4 py-2 text-xs bg-blue-100 text-blue-500 rounded uppercase tracking-wider font-semibold hover:bg-blue-300">Criar
                    Novo Pedido</a>
            @endif
        </div>
        <table class="table-fixed">
            <thead>
                <tr>
                    <th class="w-1/6">Nº Pedido</th>
                    <th class="w-1/6">Total do Pedido</th>
                    <th class="w-1/6">Solicitante</th>
                    <th class="w-1/6">Grupo</th>
                    <th class="w-1/6">Aprovador do Grupo</th>
                    <th class="w-1/6">Saldo Permitido</th>
                    <th class="w-1/6">Estado</th>
                    <th class="w-1/6">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>#{{ $pedido->id }}</td>
                        <td>{{ $pedido->total }}</td>
                        <td>{{ $pedido->Solicitante->name ?? 'Solicitante não encontrado' }}</td>
                        <td>{{ $pedido->Grupo->nome }}</td>
                        <td>{{ $pedido->Grupo->Aprovador->name }}</td>
                        <td>{{ $pedido->Grupo->saldo_permitido }}</td>
                        <td>{{ $pedido->status }}</td>
                        <td>
                            <a href="{{ route('show.pedido', ['id' => $pedido->id]) }}"
                                class="px-4 py-2 text-xs bg-blue-100 text-blue-500 rounded uppercase tracking-wider font-semibold hover:bg-blue-300">
                                Visualizar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection