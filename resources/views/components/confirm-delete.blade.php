@props([
'title' => 'Konfirmasi Penghapusan',
'message' => 'Yakin ingin menghapus data ini?',
'confirm' => 'Ya, Hapus',
'cancel' => 'Batal',
'formId'
])

<div x-data="{ open: false }" class="inline-block">
    <!-- Trigger -->
    <button type="button"
        @click="open = true"
        class="text-red-600 hover:text-red-700 font-semibold transition">
        Hapus
    </button>

    <!-- Overlay -->
    <div x-show="open"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">

        <!-- Modal Box -->
        <div @click.away="open = false"
            x-transition.scale
            class="bg-[#4c6647] text-white rounded-xl p-6 w-full max-w-sm shadow-xl">

            <h2 class="text-lg font-bold mb-3 text-center text-white">
                {{ $title }}
            </h2>

            <p class="text-sm text-center text-gray-100 mb-6">
                {{ $message }}
            </p>

            <div class="flex justify-center gap-3">
                <button type="button"
                    @click="open = false"
                    class="px-4 py-2 rounded-md bg-gray-200 text-gray-800
                           hover:bg-gray-300 dark:bg-gray-600/30 dark:text-gray-100
                           dark:hover:bg-gray-500/50 transition">
                    {{ $cancel }}
                </button>

                <button type="button"
                    @click="document.getElementById('{{ $formId }}').submit(); open = false;"
                    class="px-4 py-2 rounded-md bg-[#6da54e] text-white font-semibold
                           hover:bg-[#9dcd5a] transition">
                    {{ $confirm }}
                </button>
            </div>
        </div>
    </div>
</div>