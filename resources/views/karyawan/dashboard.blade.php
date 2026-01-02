<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8 space-y-6">

        {{-- Header Profil --}}
        <div
            class="flex justify-between items-center bg-white dark:bg-[#4c6647]/70 border border-gray-200 dark:border-[#9dcd5a]/40 rounded-xl p-4 transition-colors duration-300">

            {{-- Kiri: Avatar + Nama --}}
            <div class="flex items-center gap-4">
                <x-avatar :name="auth()->user()->name" size="lg" />
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        {{ auth()->user()->name }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ ucfirst(auth()->user()->role) }}
                    </p>
                </div>
            </div>

            {{-- Kanan: Tanggal --}}
            <div class="text-right">
                <span
                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                   bg-[#9dcd5a]/20 text-[#4c6647] dark:bg-[#9dcd5a]/30 dark:text-white">
                    {{ now()->format('l, d M Y') }}
                </span>
            </div>
        </div>

        {{-- Greeting --}}
        <p class="text-[#4c6647] dark:text-gray-200 font-medium">
            Selamat Datang, <span class="font-semibold">{{ strtok(auth()->user()->name, ' ') }}</span> 👋
        </p>

        @if (! $isEligibleCuti)
        <div class="border border-yellow-300 bg-yellow-50 text-yellow-800 rounded-xl p-4">
            <div class="font-semibold mb-1">
                ⏳ Hak Cuti Belum Aktif
            </div>
            <p class="text-sm">
                Anda belum mendapatkan hak cuti karena masa kerja belum mencapai
                <strong>12 bulan</strong>.
                Hak cuti akan aktif otomatis setelah memenuhi masa kerja tersebut.
            </p>
        </div>
        @endif

        {{-- Statistik Cuti --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach ([
            ['label' => 'Sisa Cuti', 'value' => $sisaCuti],
            ['label' => 'Pengajuan Aktif', 'value' => $totalMenunggu],
            ['label' => 'Disetujui', 'value' => $totalDisetujui],
            ['label' => 'Ditolak', 'value' => $totalDitolak],
            ] as $item)
            <div
                class="text-center p-4 rounded-xl border border-gray-200 dark:border-[#9dcd5a]/40 bg-white dark:bg-[#4c6647]/60 shadow-sm transition-colors">
                <p class="text-2xl font-bold text-[#4c6647] dark:text-white">{{ $item['value'] }}</p>
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
                        <!-- <th class="px-4 py-2">Jenis</th> -->
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                @php
                $riwayatCuti = $riwayatCuti ?? collect();
                @endphp
                <tbody>
                    @forelse ($riwayatCuti as $cuti)
                    <tr class="border-t border-gray-200 dark:border-[#9dcd5a]/30 hover:bg-[#9dcd5a]/10 transition">
                        <td class="px-4 py-2 text-gray-600 dark:text-gray-100">
                            {{ optional($cuti->tanggal_pengajuan)->format('d M Y') ?? $cuti->created_at->format('d M Y') }}
                        </td>
                        <!-- <td class="px-4 py-2 text-gray-600 dark:text-gray-100">{{ $cuti->jenis }}</td> -->
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-md text-xs font-semibold {{ $cuti->statusColor() }}">
                                {{ $cuti->statusLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-gray-600 dark:text-gray-100">
                            <a href="{{ route('karyawan.cuti.index') }}"
                                class="text-[#6da54e] hover:text-[#3eb20e] font-semibold">
                                Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="border-t border-gray-200 dark:border-[#9dcd5a]/30">
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-200">
                            Belum ada pengajuan cuti.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>