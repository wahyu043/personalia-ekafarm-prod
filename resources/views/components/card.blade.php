@props(['title', 'value'])

<div class="p-4 bg-white dark:bg-[#4c6647]/70 border border-gray-200 dark:border-[#9dcd5a]/40 rounded-xl shadow-sm">
    <h3 class="text-sm font-semibold text-[#4c6647] dark:text-[#9dcd5a]/90">
        {{ $title }}
    </h3>
    <p class="text-2xl font-bold text-[#4c6647] dark:text-white mt-1">
        {{ $value }}
    </p>
</div>