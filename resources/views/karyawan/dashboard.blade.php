<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8 space-y-6">

        {{-- Header Profil --}}
        <div
            class="flex items-center gap-4 bg-white dark:bg-[#4c6647]/70 border border-gray-200 dark:border-[#9dcd5a]/40 rounded-xl p-4 transition-colors duration-300">
            <x-avatar :name="auth()->user()->name" size="lg" />
            <div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                    {{ auth()->user()->name }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Staff – Divisi Produksi
                </p>
            </div>
        </div>

        {{-- Greeting --}}
        <p class="text-[#4c6647] dark:text-gray-200 font-medium">
            Selamat Siang, <span class="font-semibold">{{ strtok(auth()->user()->name, ' ') }}</span> 👋
        </p>

        {{-- Statistik Cuti --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach ([
            ['label' => 'Sisa Cuti', 'value' => 7],
            ['label' => 'Pengajuan Aktif', 'value' => 1],
            ['label' => 'Disetujui', 'value' => 5],
            ['label' => 'Ditolak', 'value' => 0],
            ] as $item)
            <div
                class="text-center p-4 rounded-xl border border-gray-200 dark:border-[#9dcd5a]/40 bg-white dark:bg-[#4c6647]/60 shadow-sm transition-colors">
                <p class="text-2xl font-bold text-white dark:text-white">{{ $item['value'] }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-200">{{ $item['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Riwayat Pengajuan --}}
        <div
            class="rounded-xl overflow-hidden border border-gray-200 dark:border-[#9dcd5a]/40 bg-white dark:bg-[#4c6647]/60 transition-colors duration-300">
            <div
                class="px-4 py-2 font-semibold bg-gray-50 dark:bg-[#4c6647]/80 border-b border-gray-200 dark:border-[#9dcd5a]/40 text-gray-800 dark:text-gray-100">
                Riwayat Pengajuan Terakhir
            </div>
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-100 dark:bg-[#4c6647]/80">
                    <tr>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Jenis</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="border-t border-gray-200 dark:border-[#9dcd5a]/30 hover:bg-[#9dcd5a]/10 dark:hover:bg-[#9dcd5a]/10 transition">
                        <td class="px-4 py-2 text-gray-500 dark:text-gray-200">–</td>
                        <td class="px-4 py-2 text-gray-500 dark:text-gray-200">–</td>
                        <td class="px-4 py-2 text-gray-500 dark:text-gray-200">–</td>
                        <td class="px-4 py-2 text-gray-500 dark:text-gray-200">–</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Tombol Aksi --}}
        <div class="text-center">
            <a href="{{ route('karyawan.cuti.create') }}"
                class="inline-block px-6 py-3 rounded-xl bg-[#6da54e] hover:bg-[#4c6647] text-white font-semibold transition dark:bg-[#9dcd5a] dark:hover:bg-[#6da54e] dark:text-gray-900">
                Ajukan Cuti Baru
            </a>
        </div>

    </div>
</x-app-layout>