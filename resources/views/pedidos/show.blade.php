@extends('layouts.app')

@section('content')

@livewire('pedido-component', ['pedidoId' => $pedido->id])

@endsection