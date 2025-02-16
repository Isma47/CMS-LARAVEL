@php
$colors = [
'success' => 'bg-green-100 text-green-700 border border-green-400',
'error' => 'bg-red-100 text-red-700 border border-red-400',
'warning' => 'bg-yellow-100 text-yellow-700 border border-yellow-400',
'info' => 'bg-blue-100 text-blue-700 border border-blue-400',
];
@endphp


<div class="{{ $colors[$type] }} p-3 rounded mb-4 fixed  left-1/2 transform -translate-x-1/2 top-[2rem]" x-transition>
    <p>{{ $message }}</p>
</div>
