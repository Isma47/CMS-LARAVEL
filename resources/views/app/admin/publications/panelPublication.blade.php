@extends('app.layout.main')

@section('main')
    <main class="py-16 pt-24 px-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

        <!-- Título -->
        <section class="mb-6">
            <h2 class="text-3xl dark:text-white uppercase font-bold text-center">Gestión de Publicaciones</h2>
        </section>

        <!-- Contenedor de la tabla -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden p-6">

            <!-- Tabla de publicaciones -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse dark:text-white">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Título</th>
                            <th class="py-3 px-4">Descripción</th>
                            <th class="py-3 px-4">Categoría</th>
                            <th class="py-3 px-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publications as $publication)
                            <tr class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <td class="py-3 px-4">{{ $publication->id }}</td>
                                <td class="py-3 px-4">{{ $publication->title }}</td>
                                <td class="py-3 px-4 truncate w-[200px]">{{ Str::limit($publication->description, 50) }}</td>
                                <td class="py-3 px-4">{{ $publication->category->nameCategorie ?? 'Sin categoría' }}</td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <!-- Editar -->
                                        <a href="{{ route('admin.publications.edit', $publication->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition duration-300">
                                            Editar
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('admin.publications.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="id" value="{{$publication->id}}">

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
                                    No hay publicaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6 flex justify-center">
                {{ $publications->links() }}
            </div>

        </div>

    </main>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-green-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mensaje de eliminación -->
    @if (session('delete'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-red-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50">
            {{ session('delete') }}
        </div>
    @endif
@endsection
