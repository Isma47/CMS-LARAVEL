<div
    class="fixed left-0 top-0 py-6 pl-6 pr-4 z-50 bg-white dark:bg-slate-800 w-[100vw] lg:w-[30vw] h-[100vh] shadow-2xl border-r border-gray-300 dark:border-gray-700 overflow-y-auto"
    x-show="statePanel" x-transition>

    <!-- Ícono para cerrar -->
    <div class="sticky top-0 z-50 flex justify-end">
        <i class="bi bi-x text-2xl cursor-pointer text-gray-700 dark:text-white hover:text-red-500 transition"
            id="closeSidebar" @click="closeFilters"></i>
    </div>

    <nav>
        <form action="{{ route('publications.categories') }}" method="GET" class="flex flex-col">
            <h2 class="uppercase text-xl font-bold dark:text-white mb-7">Categorías disponibles</h2>
        
            <div class="flex justify-between items-center mb-[1rem]">
                <!-- Botón de eliminar -->
                <input type="submit" name="action" value="Eliminar categorias"
                    class="text-sm self-end bg-red-500 hover:bg-red-700 text-white px-4 rounded cursor-pointer font-semibold">
        
                <!-- Botón para obtener publicaciones -->
                <input type="submit" name="action" value="Obtener resultados"
                    class="text-sm self-end bg-slate-800 hover:bg-slate-600 text-white dark:text-black dark:bg-white dark:hover:bg-slate-300 px-4 rounded cursor-pointer font-semibold">
            </div>
        
            <div class="space-y-3">
                @forelse ($categories as $categorie)
                    <label for="categoria{{ $categorie->id }}" class="flex items-center space-x-3 dark:text-white">
                        <input type="checkbox" name="categories[]" id="categoria{{ $categorie->id }}"
                            class="accent-blue-500" value="{{ $categorie->id }}"
                            {{ in_array($categorie->id, request()->input('categories', [])) ? 'checked' : '' }}>
                        <span>{{ $categorie->nameCategorie }}</span>
                    </label>
                @empty
                    <p>No hay categorías registradas</p>
                @endforelse
            </div>
        </form>
        
    </nav>

</div>



@vite(['resources/js/app/filterCategetory.js'])