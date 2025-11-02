<x-app-layout>
    <div class="px-6 py-4">
        {{-- Greeting --}}
        <div class="bg-white dark:bg-[#4c6647]/60 border border-black/70 dark:border-[#9dcd5a]/40 
                    rounded-xl p-4 flex items-center justify-between shadow-sm transition-colors">
            <div>
                <h1 class="text-2xl font-semibold text-[#4c6647] dark:text-white">
                    Selamat datang, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-sm text-[#4c6647]/80 dark:text-gray-200">
                    Semoga harimu produktif! Berikut ringkasan aktivitas cuti karyawan hari ini.
                </p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                             bg-[#9dcd5a]/20 text-[#4c6647] dark:bg-[#9dcd5a]/30 dark:text-white">
                    {{ now()->format('l, d M Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="py-6 px-6 space-y-6">
        {{-- Ringkasan Statistik --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <x-card title="Total Karyawan" :value="$summary['total_karyawan']" />
            <x-card title="Total Cuti" :value="$summary['total_cuti']" />
            <x-card title="Menunggu" :value="$summary['menunggu']" />
            <x-card title="Disetujui" :value="$summary['disetujui']" />
            <x-card title="Ditolak" :value="$summary['ditolak']" />
        </div>

        {{-- Daftar Pengajuan Terbaru --}}
        <div class="bg-white dark:bg-[#4c6647]/60 rounded-xl shadow-sm border border-black/70 dark:border-[#9dcd5a]/40 p-4 transition-colors">
            <h3 class="text-lg font-semibold text-[#4c6647] dark:text-white mb-3">
                Pengajuan Cuti Terbaru
            </h3>

            <table class="min-w-full border border-gray-300 dark:border-transparent rounded-lg overflow-hidden">
                <thead class="bg-gray-100 dark:bg-slate-900 tracking-wide uppercase border-b border-gray-300 dark:border-transparent">
                    <tr>
                        <th class="px-4 py-3 text-center text-sm font-semibold 
                   text-gray-800 dark:text-gray-100 
                   bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                   border border-gray-300 dark:border-[#9dcd5a]/40
                   first:rounded-tl-lg last:rounded-tr-lg last:border-r-0">
                            Nama
                        </th>
                        <th class="px-4 py-3 text-center text-sm font-semibold 
                   text-gray-800 dark:text-gray-100 
                   bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                   border border-gray-300 dark:border-[#9dcd5a]/40
                   last:border-r-0">
                            Tanggal
                        </th>
                        <th class="px-4 py-3 text-center text-sm font-semibold 
                   text-gray-800 dark:text-gray-100 
                   bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                   border border-gray-300 dark:border-[#9dcd5a]/40
                   last:border-r-0">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recent as $cuti)
                    <tr class="hover:bg-[#9dcd5a]/10 dark:hover:bg-[#4c6647]/40 transition">
                        <td class="border border-gray-300 dark:border-[#9dcd5a]/40 p-2 
                       text-sm text-gray-700 dark:text-gray-200 
                       bg-white dark:bg-[#4c6647]/60 transition-colors text-center last:border-r-0">
                            {{ $cuti->user->name ?? '-' }}
                        </td>
                        <td class="border border-gray-300 dark:border-[#9dcd5a]/40 p-2 
                       text-sm text-gray-700 dark:text-gray-200 
                       bg-white dark:bg-[#4c6647]/60 transition-colors text-center last:border-r-0">
                            {{ $cuti->created_at->format('d M Y') }}
                        </td>
                        <td class="border border-gray-300 dark:border-[#9dcd5a]/40 p-2 
                       text-sm text-gray-700 dark:text-gray-200 
                       bg-white dark:bg-[#4c6647]/60 transition-colors text-center last:border-r-0">
                            @if ($cuti->status == 'menunggu')
                            <span class="px-2 py-1 text-xs font-semibold rounded-md 
                                 bg-yellow-100 text-yellow-800 
                                 dark:bg-yellow-500/20 dark:text-yellow-300 
                                 border border-yellow-400/50 dark:border-yellow-300/30">Menunggu</span>
                            @elseif ($cuti->status == 'disetujui')
                            <span class="px-2 py-1 text-xs font-semibold rounded-md 
                                 bg-green-100 text-green-800 
                                 dark:bg-green-500/20 dark:text-green-300 
                                 border border-green-400/50 dark:border-green-300/30">Disetujui</span>
                            @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-md 
                                 bg-red-100 text-red-700 
                                 dark:bg-red-500/20 dark:text-red-300 
                                 border border-red-400/50 dark:border-red-300/30">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 
                    text-gray-500 dark:text-gray-300 
                    bg-white dark:bg-[#4c6647]/60 border border-gray-300 dark:border-[#9dcd5a]/40">
                            Belum ada pengajuan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>