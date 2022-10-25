@props(['disabled' => false, 'for' => ''])
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-l-md sm:block sm:text-sm border-gray-300',
]) !!}>
