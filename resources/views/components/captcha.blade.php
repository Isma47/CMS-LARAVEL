@props([
    'label' => 'Ingresa el captcha: ',
    'name' => 'captcha',
    'placeholder' => 'Ingresa el texto de la imagen',
    'value' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-gray-700 mb-1 dark:text-white font-extrabold text-lg">
            {{ $label }}
        </label>
    @endif

    {{-- Imagen del captcha --}}
    <img src="{{ captcha_src() }}" alt="captcha" class="mb-2 w-[10rem] mx-auto" />

    {{-- Campo de texto para el captcha --}}
    <input
        type="text"
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => '
            border border-gray-300 rounded-lg px-3 py-2 w-full
            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
            transition duration-300 ease-in-out
            hover:border-blue-400 hover:shadow-md
            focus:outline-none
        ']) }} required
    />

    @error($name)
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
