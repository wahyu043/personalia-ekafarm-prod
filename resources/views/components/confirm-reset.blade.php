@props([
'title' => 'Konfirmasi Reset Password',
'message' => 'Yakin ingin mereset password karyawan ini?',
'confirm' => 'Ya, Reset',
'cancel' => 'Batal',
'formId'
])

<div x-data="{ open: false }" class="inline-block">
    <!-- Trigger -->
    <button type="button"
        @click="open = true"
        class="inline-block px-3 py-1 text-sm font-semibold rounded-md
               border border-yellow-400 text-yellow-600
               bg-yellow-100/40 hover:bg-yellow-500 hover:text-white
               dark:bg-[#4c6647]/40 dark:text-yellow-300 dark:border-yellow-300
               transition">
        Reset
    </button>

    <!-- Overlay -->
    <div x-show="open" x-cloak x-transition.opacity
        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">

        <!-- Modal Box -->
        <div @click.away="open = false" x-transition.scale
            class="bg-[#4c6647] text-white rounded-xl p-6 w-full max-w-sm shadow-xl">

            <h2 class="text-lg font-bold mb-3 text-center text-white">
                {{ $title }}
            </h2>

            <p class="text-sm text-center text-gray-100 mb-6">
                {{ $message }}
            </p>

            <div class="flex justify-center gap-3">
                <button type="button" @click="open = false"
                    class="px-4 py-2 rounded-md bg-gray-200 text-gray-800
                           hover:bg-gray-300 dark:bg-gray-600/30 dark:text-gray-100
                           dark:hover:bg-gray-500/50 transition">
                    {{ $cancel }}
                </button>

                <button type="button"
                    @click="document.getElementById('{{ $formId }}').submit(); open = false;"
                    class="px-4 py-2 rounded-md bg-yellow-500 text-white font-semibold
                           hover:bg-yellow-400 transition">
                    {{ $confirm }}
                </button>
            </div>
        </div>
    </div>
</div>