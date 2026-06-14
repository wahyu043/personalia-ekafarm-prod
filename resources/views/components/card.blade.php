@props(['title', 'value'])

<div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
    <h3 class="text-sm font-semibold text-[#4c6647]">
        {{ $title }}
    </h3>
    <p class="text-2xl font-bold text-[#4c6647] mt-1">
        {{ $value }}
    </p>
</div>