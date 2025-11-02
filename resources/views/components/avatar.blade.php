@props(['name' => 'User', 'size' => 'md'])

@php
$sizes = [
'sm' => 'w-10 h-10 text-sm',
'md' => 'w-14 h-14 text-base',
'lg' => 'w-20 h-20 text-lg',
];

$initial = strtoupper(substr($name, 0, 1));
@endphp

<div class="flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold {{ $sizes[$size] ?? $sizes['md'] }}">
    {{ $initial }}
</div>