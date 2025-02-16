@props([
'label' => null,
'name' => null,
'type' => 'text',
'placeholder' => null,
'value' => null,
])


<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block font-extrabold text-lg text-gray-700 mb-1 dark:text-white">
        {{ $label }}
    </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ $type != 'password' ? old($name, $value) : '' }}" {{ $attributes->merge(['class' => '
    border border-gray-300 rounded-lg px-3 py-2 w-full
    focus:ring-2 focus:ring-blue-500 focus:border-blue-500
    transition duration-300 ease-in-out
    hover:border-blue-400 hover:shadow-md
    focus:outline-none']) }} required
    />


    @error($name)
    <p class="text-red-600 font-bold">{{ $message }}</p>
    @enderror

</div>