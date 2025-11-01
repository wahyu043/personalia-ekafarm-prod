<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-700 text-center">Daftar Pengajuan Cuti Saya</h1>

        @if ($cuti->isEmpty())
        <p class="text-gray-500 text-center">Belum ada pengajuan cuti.</p>
        @else
        <table class="min-w-full border border-gray-300 dark:border-slate-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 dark:bg-slate-900 dark:dark-divider tracking-wide uppercase">
                <tr>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
           text-gray-800 dark:text-gray-100 
           bg-[#f8f8ee] dark:bg-[#4c6647]/80 
           border border-black/70 dark:border-white/80 
           rounded-md transition-colors duration-200">Tanggal Pengajuan</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
           text-gray-800 dark:text-gray-100 
           bg-[#f8f8ee] dark:bg-[#4c6647]/80 
           border border-black/70 dark:border-white/80 
           rounded-md transition-colors duration-200">Periode</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
           text-gray-800 dark:text-gray-100 
           bg-[#f8f8ee] dark:bg-[#4c6647]/80 
           border border-black/70 dark:border-white/80 
           rounded-md transition-colors duration-200">Alasan</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
           text-gray-800 dark:text-gray-100 
           bg-[#f8f8ee] dark:bg-[#4c6647]/80 
           border border-black/70 dark:border-white/80 
           rounded-md transition-colors duration-200">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuti as $item)
                <tr class="hover:bg-[#9dcd5a]/10 transition-colors">
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">
                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }} -
                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                    </td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">{{ $item->alasan }}</td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">
                        @if ($item->status == 'menunggu')
                        <span class="px-2 py-1 text-xs font-semibold rounded-md 
                 bg-yellow-100 text-yellow-800 
                 dark:bg-yellow-500/20 dark:text-yellow-300 
                 border border-yellow-400/50 dark:border-yellow-300/30">Menunggu</span>
                        @elseif ($item->status == 'disetujui')
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
                @endforeach
            </tbody>
        </table>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('karyawan.cuti.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                + Ajukan Cuti Baru
            </a>
        </div>
    </div>
</x-app-layout>