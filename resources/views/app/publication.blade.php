@extends('app.layout.main')

@section('main')
<main class="pt-16 pb-8 bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto px-4">
        <div class=" bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col items-center py-[2rem]">
            <!-- Sección de Imagen -->
            <div class="lg:w-1/3 h-64 lg:h-auto">
                <img src="{{ $publication->name_img ? Storage::url('publications/' . $publication->name_img) : asset('img/login.avif') }}" alt="Imagen de Publicación" class="w-full h-full object-cover">
            </div>
            <!-- Sección de Contenido -->
            <div class="lg:w-2/3 p-6">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">{{ $publication->title }}</h1>
                <span class="block text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Fecha: {{ $publication->created_at->format('d/m/Y') }}
                </span>
                <div class="prose dark:prose-dark dark:text-white">
                    <p>{{ $publication->description }}</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
