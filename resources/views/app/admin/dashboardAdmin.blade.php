@extends('app.layout.main')


@section('main')
    <main class="pt-[4rem]">

        <section class="py-6 px-4">
            <h2 class="text-2xl dark:text-white uppercase font-sora font-bold">Publicaciones diponibles</h2>
        </section>


        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            <!-- Gestión de Usuarios -->
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                <i class="bi bi-person-fill text-4xl text-blue-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Gestión de Usuarios</h3>

                <div class="flex flex-col space-y-2">
                    <a href="{{ route('admin.createUser') }}" class="text-blue-500 hover:text-blue-700 font-semibold transition">Crear usuario</a>
                    <a href="{{ route('admin.updateUser') }}" class="text-blue-500 hover:text-blue-700 font-semibold transition">Administar usuarios</a>
                </div>
            </div>

            <!-- Gestión de Publicaciones -->
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                <i class="bi bi-file-earmark-text-fill text-4xl text-green-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Gestión de Publicaciones</h3>

                <div class="flex flex-col space-y-2">
                    <a href="{{ route('admin.publications.create') }}" class="text-green-500 hover:text-green-700 font-semibold transition">
                        Crear publicación
                    </a>
                    
                    <a href="{{ route('admin.publications') }}" class="text-green-500 hover:text-green-700 font-semibold transition">
                        Gestionar publicaciones
                    </a>
                    
                </div>
            </div>

            <!-- Gestión de Categorías -->
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                <i class="bi bi-tags-fill text-4xl text-purple-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Gestión de Categorías</h3>

                <div class="flex flex-col space-y-2">
                    <a href="{{ route('admin.categories.create') }}" class="text-purple-500 hover:text-purple-700 font-semibold transition">Crear
                        categoría</a>
                    <a href="{{ route('admin.categories')}}" class="text-purple-500 hover:text-purple-700 font-semibold transition">Gestionar categorias</a>

                </div>
            </div>
        </section>



    </main>


    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 bg-green-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif
@endsection
