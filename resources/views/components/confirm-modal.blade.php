<div x-data="{ open: false }" class="inline">
    <!-- Tombol Trigger -->
    <button type="button"
        @click="open = true"
        class="px-3 py-1 text-xs font-semibold rounded-md bg-[#6da54e] hover:bg-[#9dcd5a] text-white transition-colors">
        {{ $trigger ?? 'Simpan' }}
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/40 z-50">
        <div class="bg-white dark:bg-[#4c6647] rounded-lg p-6 w-80 shadow-lg text-center">
            <h2 class="text-gray-800 dark:text-gray-100 text-sm mb-3 font-semibold">
                {{ $title ?? 'Konfirmasi Aksi' }}
            </h2>
            <p class="text-xs text-gray-600 dark:text-gray-300 mb-4">
                {{ $message ?? 'Apakah Anda yakin ingin melanjutkan aksi ini?' }}
            </p>
            <div class="flex justify-center gap-3">
                <button type="button"
                    @click="open = false"
                    class="px-3 py-1 text-xs rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800">
                    {{ $cancel ?? 'Batal' }}
                </button>
                <button type="submit"
                    @click="open = false"
                    class="px-3 py-1 text-xs rounded-md bg-[#6da54e] hover:bg-[#9dcd5a] text-white">
                    {{ $confirm ?? 'Ya, Simpan' }}
                </button>
            </div>
        </div>
    </div>
</div>