@extends('app.layout.main')


@section('main')
    <section class="pt-[4rem]">

        <div class="flex justify-between px-3 md:px-10 py-8 dark:text-white">

            <h3 class="text-2xl uppercase font-extrabold">Mis publicaciones</h3>

            <form action="">
                <ul>
                    <li>Filtos....</li>
                </ul>
            </form>

        </div>


        <!-- Contenedorpara ostra  las publicaciones  -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 px-3 md:px-10 gap-5">


            <div class="w-full mx-auto bg-white shadow rounded overflow-hidden">
                <!-- Contenedor de la imagen con tamaño fijo -->
                <div class="h-36 w-full">
                    <img class="w-full h-full object-cover" src="{{ asset('img/login.avif') }}" alt="Imagen de Login">
                </div>

                <!-- Contenedor de contenido -->
                <div class="px-4 py-3">
                    <h4 class="text-xl font-semibold mb-2 text-center">Título</h4>

                    <span class="text-xs text-gray-700 mb-[.5rem] inline-block">Fecha de creación: 10/22/22</span>

                    <button
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded transition duration-300">
                        Entrar
                    </button>
                </div>
            </div>

        </div>

    </section>
@endsection
