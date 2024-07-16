@extends('components.Master.main')
@section('content')
    @vite(['resources/js/Geral/list.js'])
    <div class="container mx-auto lg:pl-64 p-5 ">
        <div class="flex justify-center mt-10">
            <div class="w-full max-w-sm">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-xl font-bold mb-6 text-center text-red-800">Ficheiro não encontrado</h2>
                    <div class="text-gray-700 text-center">
                        <p>Oops! O ficheiro que procuras não foi encontrado.</p>
                        <p>Verifica se existe algum documento pdf associado no veiculo</p>
                    </div>
                    <div class="mt-8 text-center mr-2">
                        <button id="pageBack"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ">
                            Voltar a página anterior
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
