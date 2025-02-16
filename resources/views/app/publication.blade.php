@extends('app.layout.main')


@section('main')
    <main class="pt-[4rem]">

        <section class="grid grid-cols-1 lg:grid-cols-2 mx-1 lg:container lg:mx-auto py-5 gap-4">

            <div class="h-[85vh] w-full">
                <img class="w-full h-full" src="{{ asset('img/login.avif') }}" alt="Imagen de Publicación">
            </div>


            <!-- Mostrar la Publicación -->
            <div class="dark:text-white lg:h-[80vh] lg:overflow-y-auto  px-5 lg:px-10">
                <div class="flex flex-col gap-3 mb-3">
                    <h1 class="text-5xl font-bold">{{ $publication->title }}</h1>
                    <span class="text-xs text-end">Fecha: {{ $publication->created_at->format('d/m/Y') }}</span>
                </div>

                <!-- Descripción -->
                <div class="flex flex-col gap-1">
                    <p class="text-xl uppercase font-semibold font-sora">Descripción:</p>
                    <p class="font-poppins text-sm font-light">{{ $publication->description }}</p>
                </div>

                <!-- Subtemas Ordenados -->
                <div class="mt-6">
                    @forelse ($publication->sections as $section)
                        <div class="mb-6 dark:shadow-lg bg-slate-50 dark:bg-gray-800 dark:text-white">
                            <h3 class="text-xl font-sora uppercase font-semibold border-b">{{ $section->subheading }}</h3>
                            <p class="text-sm font-poppins font-light my-[.5rem]">{{ $section->content }}</p>

                            @if ($section->image === '')
                                <img src="{{ $section->image }}" alt="Imagen del subtema" class="w-full mt-2 rounded">
                            @endif
                        </div>

                    @empty
                        
                    @endforelse
                </div>
            </div>


        </section>


    </main>
@endsection
