@extends('app.layout.main')

@section('main')
<main class="py-16 pt-24 px-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

    <!-- Título -->
    <section class="mb-6">
        <h2 class="text-3xl dark:text-white uppercase font-bold text-center">Gestión de Categorías</h2>
    </section>

    <!-- Contenedor de la tabla -->
    <div class="mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden p-6">
        <!-- Botón para crear categoría -->

        <!-- Tabla de Categorías -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse dark:text-white">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nombre</th>
                        <th class="py-3 px-4">Descripción</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <td class="py-3 px-4">{{ $category->id }}</td>
                            <td class="py-3 px-4">{{ $category->nameCategorie }}</td>
                            <td class="py-3 px-4 truncate w-[200px]">{{ Str::limit($category->description, 50) }}</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-lg text-white text-sm font-bold {{ $category->status ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $category->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Editar -->
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition duration-300">
                                        Editar
                                    </a>
                                    <!-- Eliminar -->
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <!-- Campo oculto para enviar el ID de la categoría (opcional, ya que se pasa en la URL) -->
                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                    
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                            Eliminar
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-300">
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación (si usas paginate, de lo contrario omitir) -->
        <div class="mt-6 flex justify-center">
            {{ $categories->links() }}
        </div>
    </div>
</main>

<!-- Mensaje de Éxito -->
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
         class="fixed top-5 right-5 bg-green-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<!-- Mensaje de Eliminación -->
@if (session('delete'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
         class="fixed top-5 right-5 bg-red-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
        {{ session('delete') }}
    </div>
@endif
@endsection
