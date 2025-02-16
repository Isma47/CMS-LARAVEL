<header class="py-2 fixed top-0 w-full" x-data="darkModeToggle">

    <nav class="flex justify-end gap-8 py-4 px-4 dark:text-white text-lg">
        <i class="bi bi-moon-stars-fill" @click="toggleDarkMode()"></i>
        <i class="bi bi-door-open-fill"></i>
    </nav>

</header>


@vite(['resources/js/backMode.js'])