@props(['active'])

@php
$classes = ($active ?? false)
? 'block px-3 py-2 rounded-md text-sm font-medium text-white bg-[#4c6647]'
: 'block px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#4c6647]/80 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>