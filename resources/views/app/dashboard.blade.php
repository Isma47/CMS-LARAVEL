@extends('app.layout.main')


@section('main')
    <main class="pt-[4rem]">

        <!-- Contenedor general con fondo degradado y altura mínima -->
        <div
            class="min-h-screen dark:bg-gradient-to-b bg-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 dark:text-white py-10">
            <div class="mx-auto container px-4 lg:px-0">

                <div class="flex flex-col lg:flex-row items-end lg:items-center justify-between my-[2rem] mb-[5rem]"
                    x-data="filterModal">
                    <!-- Encabezado principal -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-extrabold mb-2">PUBLICACIONES</h2>
                        <p class="text-slate-800 dark:text-gray-300 mb-6">Descubre todas las publicaciones en un solo lugar
                        </p>
                    </div>

                    <!-- Filtrar categorias -->
                    <div>
                        <button @click="toggleFilters"
                            class="font-semibold rounded py-2 px-5 text-sm bg-slate-800 hover:bg-slate-600 text-white dark:text-black  dark:bg-white dark:hover:bg-slate-200">Ver
                            categorias</button>
                    </div>

                    @include('components.app.filterCategorie')
                </div>

                <!-- Grid principal -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">
                    @foreach ($paginatePublications as $publication)
                    <form action="{{ route('publications.show', ['id' => $publication->id]) }}" method="GET" class="w-full">
                        <!-- Tarjeta interactiva con botón oculto -->
                        <button type="submit"
                            class="max-w-sm w-full h-[400px] bg-white rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-transform transform hover:-translate-y-1 cursor-pointer flex flex-col">
                            
                            <!-- Imagen -->
                            <div class="h-44 w-full">
                                <img class="w-full h-full object-cover" src="{{ asset('img/login.avif') }}" alt="Imagen de Publicación">
                            </div>
                    
                            <!-- Contenido interno -->
                            <div class="flex-grow flex flex-col justify-between px-5 py-4 text-gray-800">
                                <div>
                                    <h4 class="text-lg md:text-xl font-semibold text-center mb-2 line-clamp-1">
                                        {{ $publication->title }}
                                    </h4>
                                    <p class="text-sm text-gray-600 text-center mb-3 line-clamp-2">
                                        {{ $publication->description }}
                                    </p>
                                    <p class="text-sm font-semibold text-center">
                                        Categoría: <span class="text-blue-600">
                                            {{ $publication->category->nameCategorie ?? 'Sin categoría' }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-500 mb-4 text-center">
                                        Fecha de creación: {{ $publication->created_at->format('d/m/Y') }}
                                    </span>
                                    <div class="flex justify-center">
                                        <span
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ring-0 hover:ring-4 hover:ring-blue-500/50">
                                            Ver
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </form>
                    
                    @endforeach

                </div>

                <!-- Paginación -->
                <div class="mt-8 flex justify-center">
                    {{ $paginatePublications->appends(request()->input())->links() }}
                </div>


            </div>
        </div>





    </main>
@endsection
