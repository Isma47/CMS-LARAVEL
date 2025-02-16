<div class="flex items-center lg:flex-col justify-center h-screen">
    <form action="{{ route('login.attempt') }}" method="POST" class="py-8 bg-white mx-2 lg:mr-[2rem] w-full  pr-4 pl-[2rem] dark:rounded dark:bg-slate-700">

        @csrf

        <h1 class="font-sora text-center text-4xl font-bold mb-4 dark:text-white">INICIAR SESIÓN</h1>

        <x-input label="Correo electrónico: " name="email" type="email" placeholder="Ingresa tu correo" />
        <x-input label="Contraseña: " name="password" type="password" placeholder="Ingresa tu contraseña" />

        <x-captcha />

        <div class="flex justify-center">
            <input type="submit" value="Login"
                class="px-10 py-2 bg-blue-600 text-white rounded font-bold cursor-pointer">
        </div>

    </form>
</div>