@extends('auth.layout.main')


<!-- header -->



@section('main')

<main>

    <div class="xl:grid xl:grid-cols-2 lg:gap-4 items-center">
        <div class="hidden xl:block">
            <img src="{{ asset('img/login.avif') }}" alt="imagen login" class="w-full h-auto max-h-screen">
        </div>

        <div class="h-screen overflow-y-auto">
            @include('auth.layout.header')
            <!-- Formulario de inicio de sesión -->
            @include('components.forms.login')
        </div>
    </div>

</main>


@endsection