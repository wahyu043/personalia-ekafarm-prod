<x-app-layout>
    <x-slot:title>Dashboard</x-slot>
        <div class="px-6 py-4">
            {{-- Greeting --}}
            <div class="bg-white border border-black/70 rounded-xl p-4 flex items-center justify-between shadow-sm transition-colors">
                <div>
                    <h1 class="text-2xl font-semibold text-[#4c6647]">
                        Selamat datang, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-sm text-[#4c6647]/80">
                        Semoga harimu produktif! Berikut ringkasan aktivitas cuti karyawan hari ini.
                    </p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-[#9dcd5a]/20 text-[#4c6647]">
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
            <div class="bg-white rounded-xl shadow-sm border border-black/70 p-4 transition-colors">
                <h3 class="text-lg font-semibold text-[#4c6647] mb-3">
                    Pengajuan Cuti Terbaru
                </h3>

                <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 tracking-wide uppercase border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-gray-300 first:rounded-tl-lg last:rounded-tr-lg last:border-r-0">
                                Nama
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-gray-300 last:border-r-0">
                                Tanggal
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-gray-300 last:border-r-0">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recent as $cuti)
                        <tr class="hover:bg-[#9dcd5a]/10 transition">
                            <td class="border border-gray-300 p-2 text-sm text-gray-700 bg-white text-center last:border-r-0">
                                {{ $cuti->user->name ?? '-' }}
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-gray-700 bg-white text-center last:border-r-0">
                                {{ $cuti->created_at->format('d M Y') }}
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-gray-700 bg-white text-center last:border-r-0">
                                @if (in_array($cuti->status, ['menunggu_atasan', 'menunggu_hr']))
                                <span class="px-2 py-1 text-xs font-semibold rounded-md bg-yellow-100 text-yellow-800 border border-yellow-400/50">Menunggu</span>
                                @elseif ($cuti->status == 'disetujui')
                                <span class="px-2 py-1 text-xs font-semibold rounded-md bg-green-100 text-green-800 border border-green-400/50">Disetujui</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-md bg-red-100 text-red-700 border border-red-400/50">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500 bg-white border border-gray-300">
                                Belum ada pengajuan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>