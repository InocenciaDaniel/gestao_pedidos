@extends('layouts.app')

@section('content')

<div class="grid px-8 xl:p-0 gap-y-4">
    <div class="col-span-3 bg-white p-6 rounded-xl border border-gray-50 flex flex-col space-y-6">
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('store.pedido') }}">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Criar Novo Pedido</h2>

                    <div id="materialsContainer" class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="grupo_id" class="block text-sm/6 font-medium text-gray-900">Grupo</label>
                            <div class="mt-2">
                                <select id="grupo_id" name="grupo_id" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                    @foreach ($solicitantes as $solicitante)
                                        <option value="{{ $solicitante->Grupo->id }}">{{ $solicitante->Grupo->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="material-item flex items-center space-x-4 sm:col-span-6">
                            <div class="sm:col-span-3">
                                <label for="materiais[0]"
                                    class="block text-sm/6 font-medium text-gray-900">Material</label>
                                <div class="mt-2">
                                    <select id="materiais[0]" name="materiais[]"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                        @foreach ($materiais as $material)
                                            <option value="{{ $material->id }}">{{ $material->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="quantidade[0]"
                                    class="block text-sm/6 font-medium text-gray-900">Quantidade</label>
                                <div class="mt-2">
                                    <input required type="number" name="quantidades[]" id="quantidade[0]"
                                        class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                        min="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" onclick="addMaterial()"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-900 bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Adicionar Material
                </button>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold text-gray-900"
                    onclick="window.location.href='{{ route('home') }}'">
                    Voltar
                </button>

                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
    let materialIndex = 1;

    function addMaterial() {
        const materialsContainer = document.getElementById('materialsContainer');

        const materialItem = document.createElement('div');
        materialItem.classList.add('material-item', 'flex', 'items-center', 'space-x-4', 'sm:col-span-6', 'mt-4');
        materialItem.innerHTML = `
            <div class="sm:col-span-3">
                <label for="materiais[${materialIndex}]" class="block text-sm/6 font-medium text-gray-900">Material</label>
                <div class="mt-2">
                    <select id="materiais[${materialIndex}]" name="materiais[]"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                        @foreach ($materiais as $material)
                            <option value="{{ $material->id }}">{{ $material->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="quantidade[${materialIndex}]" class="block text-sm/6 font-medium text-gray-900">Quantidade</label>
                <div class="mt-2">
                    <input required type="number" name="quantidades[]" id="quantidade[${materialIndex}]"
                        class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                         min="1">
                </div>
            </div>

            <button type="button" onclick="removeMaterial(this)"
                class="text-red-500 hover:text-red-700 font-semibold text-lg">
                &times;
            </button>
        `;

        materialsContainer.appendChild(materialItem);
        materialIndex++;
    }

    function removeMaterial(button) {
        const materialItem = button.parentElement;
        materialItem.remove();
    }
</script>

@endsection