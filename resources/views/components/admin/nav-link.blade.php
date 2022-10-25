@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
            : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'
@endphp

@if($active ?? false)
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endif

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="w-5 h-5 {{ $attributes->has('icone') ? $attributes->get('icone') : 'fa-solid fa-house'}}"></i>
    <span class="ml-4">{{ $slot }}</span>
</a>
