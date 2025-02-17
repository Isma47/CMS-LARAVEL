<header
    class="flex items-center justify-between w-full lg:py-1 fixed top-0 z-10 bg-white dark:bg-slate-800 shadow  dark:shadow-white"
    x-data="darkModeToggle">

    <div>
        <h2 class="dark:text-white text-xl px-4 font-bold"><a href="{{ route('dashboard') }}">{{ auth()->user()->name }} -
                {{ auth()->user()->role }}</a> </h2>
    </div>


    <nav class="flex flex-col lg:flex-row justify-end items-center lg:gap-8 gap-3 py-4 px-4 dark:text-white text-lg">


        @can('admin')
            <!-- si es administrador podra ver el boton para entrar a panel de administración -->
            <a href="{{ route('dashboard.admin') }}"
                class="text-sm bg-slate-800 text-white dark:bg-white dark:text-slate-800 px-2 py-1 rounded font-semibold">Editar
                contenido</a>
        @endcan
        <div class="flex gap-3">
            <i class="bi bi-moon-stars-fill" @click="toggleDarkMode()"></i>
            <i class="bi bi-door-open-fill"></i>
        </div>
    </nav>

</header>

<!-- Modo oscuro garcias a tailwind css -->
@vite(['resources/js/backMode.js'])
