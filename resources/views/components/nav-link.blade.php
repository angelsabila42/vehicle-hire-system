@props(['active'])

@php
// We define base styles. 
// We removed the PHP-side padding logic to avoid the 'Undefined variable' error.
$classes = ($active ?? false)
            ? 'flex items-center rounded-xl transition duration-150 ease-in-out w-full py-3 bg-slate-900 text-white'
            : 'flex items-center rounded-xl transition duration-150 ease-in-out w-full py-3 text-gray-400 hover:bg-gray-100 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} 
   :class="sidebarOpen ? 'px-4' : 'justify-center px-0'">
    {{ $slot }}
</a>