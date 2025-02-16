<header class="flex items-center justify-between w-full py-1 fixed top-0 z-10 bg-white dark:bg-slate-800 shadow  dark:shadow-white" x-data="darkModeToggle">

    <div>
        <h2 class="dark:text-white text-xl px-4 font-bold"><a href="{{ route('dashboard') }}">{{ auth()->user()->name }} - {{ auth()->user()->role }}</a>  </h2>
    </div>

    <nav class="flex justify-end gap-8 py-4 px-4 dark:text-white text-lg">
        <i class="bi bi-moon-stars-fill" @click="toggleDarkMode()"></i>
        <i class="bi bi-door-open-fill"></i>
    </nav>

</header>

<!-- Modo oscuro garcias a tailwind css -->
@vite(['resources/js/backMode.js'])