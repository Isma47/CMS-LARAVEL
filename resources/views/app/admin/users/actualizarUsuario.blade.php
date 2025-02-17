@extends('app.layout.main')



@section('main')
    <main class="py-[4rem]">

        <section class="py-6 px-4">
            <h2 class="text-3xl dark:text-white uppercase font-sora font-bold">Actualizar información del usuario</h2>
        </section>


        <!-- Formulario para manera la logica de envio de información -->
        @include('components.app.admin.formUserUpdate', [
            'route' => route('users.update'),
            'tittleForm' => 'Actualizar usuario',
        ])



        <!-- Alerta de actualizaicon -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="fixed top-5 right-5 bg-green-500 text-white text-sm px-4 py-2 rounded-lg shadow-lg transition-all">
                {{ session('success') }}
            </div>
        @endif


    </main>
@endsection
