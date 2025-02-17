@extends('app.layout.main')



@section('main')

<main class="py-[4rem]">

    <section class="py-6 px-4">
        <h2 class="text-3xl dark:text-white uppercase font-sora font-bold">Crea un nuevo usuario</h2>
    </section>


    <!-- Formulario para manera la logica de envio de información -->
    @include('components.app.admin.formUser', ['route' => route('user.create'), 'tittleForm' => 'Registrar usuario'])


</main>

@endsection