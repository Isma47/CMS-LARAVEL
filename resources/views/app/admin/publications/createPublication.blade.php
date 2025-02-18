@extends('app.layout.main')

@section('main')
    <main class="py-16 pt-24 px-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

        <!-- Título -->
        <section class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white uppercase text-center">Crear publicacion</h2>
        </section>

        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="fixed top-5 right-5 bg-green-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario con enctype para subir archivos -->
            <form action="{{ route('admin.publications.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <!-- Campo oculto para el ID (solo en edición) -->
                @isset($user)
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @endisset

                <!-- Título -->
                <x-input label="Título" name="title" type="text" placeholder="Ingrese el título"
                    value="{{ old('title', $publication->title ?? '') }}" />

                <!-- Descripción -->
                <div class="mt-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 font-semibold">Descripción:</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-700 dark:text-white">{{ old('description', $publication->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div class="mt-4">
                    <label for="categories_id" class="block text-gray-700 dark:text-gray-300 font-semibold">Categoría:</label>
                    <select name="categories_id" id="categories_id" required
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-700 dark:text-white">
                        <option value="" disabled {{ old('categories_id', $publication->categories_id ?? '') == '' ? 'selected' : '' }}>Selecciona una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('categories_id', $publication->categories_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->nameCategorie }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input File para subir imagenes -->
                <div class="mt-4">
                    <label for="image" class="block text-gray-700 dark:text-gray-300 font-semibold">Imagen:</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-700 dark:text-white">
                    @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón de Envío -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
