@extends('app.layout.main')

@section('main')
<main class="py-16 pt-24 px-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

    <!-- Título -->
    <section class="mb-6">
        <h2 class="text-3xl dark:text-white uppercase font-bold text-center">Crear Categoría</h2>
    </section>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 x-init="setTimeout(() => show = false, 3000)"
                 class="fixed top-5 right-5 bg-green-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para registrar Categoría -->
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Título de la Categoría -->
            <x-input 
                label="Título" 
                name="title" 
                type="text" 
                placeholder="Ingrese el título de la categoría" 
                value="{{ old('title') }}" />

            <!-- Descripción -->
            <div class="mt-4">
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-semibold">
                    Descripción:
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-700 dark:text-white"
                    placeholder="Ingrese la descripción de la categoría">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo oculto para user_id (se asigna automáticamente) -->
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <!-- Botón de Envío -->
            <div class="flex justify-center mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Crear Categoría
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
