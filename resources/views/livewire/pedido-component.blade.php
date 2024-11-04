<div class="grid px-8 xl:p-0 gap-y-4">
    <div class="col-span-3 bg-white p-6 rounded-xl border border-gray-50 flex flex-col space-y-3">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-base/7 font-semibold text-gray-900">Detalhes do Pedido #{{ $pedido->id }}</h2>
        <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }}</p>
        <p><strong>Estado:</strong> {{ $pedido->status == "Novo" ? 'Em Revisão' : $pedido->status }}</p>
        <p><strong>Solicitante:</strong>
            {{ $pedido->Solicitante->name ?? 'Solicitante não encontrado' }}</p>
        <p><strong>Grupo:</strong> {{ $pedido->grupo->nome }}</p>
        <p><strong>Saldo Permitido:</strong> {{ number_format($pedido->grupo->saldo_permitido, 2) }} </p>

        @foreach ($pedidoMateriais as $index => $material)
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mt-4">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-900">Material</label>
                    <select wire:model="pedidoMateriais.{{ $index }}.material_id"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                        <option value="">Selecione o material</option>
                        @foreach ($materiais as $materialOption)
                            <option value="{{ $materialOption->id }}">{{ $materialOption->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-900">Quantidade</label>
                    <input type="number" wire:model="pedidoMateriais.{{ $index }}.quantidade"
                        class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        min="1">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-900">Sub-total</label>
                    <input type="number" wire:model="pedidoMateriais.{{ $index }}.sub_total"
                        class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        disabled>
                </div>

                @if (Auth::user()->perfil == "Solicitante" &&  $pedido->Solicitante->id == Auth::user()->id)
                    @if ($pedido->status == "Alterações Solicitadas")
                        <button type="button" wire:click="removerMaterial({{ $index }})" class="text-red-500">Remover</button>
                        <button wire:click="actualizarMaterial({{ $index }})" class="text-blue-500">Actualizar</button>
                    @endif
                @endif
            </div>
        @endforeach
        <div class="border-b border-gray-900/10 pb-12"></div>
        @if (Auth::user()->perfil == "Solicitante"  &&  $pedido->Solicitante->id == Auth::user()->id)
            @if ($pedido->status == "Alterações Solicitadas")
                <div class="mt-4">
                    <button type="button" wire:click="addMaterial" class="bg-gray-200 px-3 py-2 rounded-md">
                        Adicionar Material
                    </button>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6 border-b border-gray-900/10 pb-12">
                    <button type="button" wire:click="finalizarAlteracoes"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500">
                        Finalizar Alterações
                    </button>
                </div>
            @endif
        @else
            @if ($pedido->status == "Novo")
                @if ($pedido->grupo->aprovador_id == Auth::user()->id)
                    <div class="mt-6 flex items-center justify-end gap-x-6 border-b border-gray-900/10 pb-12">
                        <button type="button" wire:click="aprovar"
                            class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500">Aprovar</button>

                        <button type="button" wire:click="solicitarAlteracoes"
                            class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white hover:bg-yellow-500">Solicitar
                            Alterações</button>
                        <button type="button" wire:click="rejeitar"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500">Rejeitar</button>
                    </div>
                @endif
            @endif
        @endif



    </div>
</div>