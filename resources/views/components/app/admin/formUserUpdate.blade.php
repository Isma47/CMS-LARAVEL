<div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 shadow-lg rounded-lg p-6">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 text-center uppercase">{{ $tittleForm }}</h2>

    <form action="{{ $route }}" method="POST" class="space-y-4">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <!-- Campo oculto para el ID del usuario (solo en edición) -->

        <input type="hidden" name="id" value="{{ $user->id }}">


        <!-- Nombre -->
        <x-input label="Nombre del usuario:" name="name" type="text" placeholder="Ingresa el nombre del usuario"
            value="{{ old('name', $user->name ?? '') }}" />

        <!-- Correo -->
        <x-input label="Correo del usuario" name="email" type="email" placeholder="Ingresa el correo del usuario"
            value="{{ old('email', $user->email ?? '') }}" />


        <x-input label="Contraseña" name="password" type="password" placeholder="Ingresa la contraseña del usuario" />


        <!-- Selección de Rol -->
        <div>
            <label for="role" class="block text-gray-700 dark:text-gray-300 font-semibold">Rol del usuario:</label>
            <select name="role" id="role" required
                class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-700 dark:text-white">
                <option value="" disabled {{ old('role', $user->role ?? '') == '' ? 'selected' : '' }}>Selecciona
                    un rol</option>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón de Envío -->
        <div class="flex justify-center">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                {{ $tittleForm }}
            </button>
        </div>
    </form>
</div>
