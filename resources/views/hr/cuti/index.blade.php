<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-700 text-center">Daftar Pengajuan Cuti Karyawan</h1>

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
           rounded-md transition-colors duration-200">Nama</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
           text-gray-800 dark:text-gray-100 
           bg-[#f8f8ee] dark:bg-[#4c6647]/80 
           border border-black/70 dark:border-white/80 
           rounded-md transition-colors duration-200">NIP</th>
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
                    <th class="px-4 py-3 text-center text-sm font-semibold 
           text-gray-800 dark:text-gray-100 
           bg-[#f8f8ee] dark:bg-[#4c6647]/80 
           border border-black/70 dark:border-white/80 
           rounded-md transition-colors duration-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuti as $item)
                <tr class="hover:bg-[#9dcd5a]/10 transition-colors">
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">{{ $item->user->name }}</td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">{{ $item->user->nip }}</td>
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
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 
           text-sm text-gray-700 dark:text-gray-200 
           bg-white dark:bg-[#4c6647]/60 transition-colors">
                        <div class="flex items-center gap-2">
                            <form action="{{ route('hr.cuti.updateStatus', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <select name="status"
                                    class="rounded-md border border-gray-300 dark:border-[#9dcd5a]/40 
                       bg-white dark:bg-[#4c6647]/40 text-gray-700 dark:text-gray-100 
                       text-sm px-3 py-1 pr-6 appearance-none
                       bg-[url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'%23a1a1aa\' stroke-width=\'1.5\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M8.25 9.75L12 13.5l3.75-3.75\'/></svg>')]
                       bg-no-repeat bg-right-2 bg-[length:1em_1em]
                       focus:ring-0 focus:outline-none transition-colors">
                                    <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="disetujui" {{ $item->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>

                                <x-confirm-modal
                                    trigger="Simpan"
                                    title="Konfirmasi Perubahan Status"
                                    :message="'Yakin ubah status cuti ini menjadi ' . ucfirst($item->status) . '?'"
                                    confirm="Ya, Ubah"
                                    cancel="Batal" />
                            </form>

                            {{-- Tombol Cetak sejajar --}}
                            @if ($item->status === 'disetujui')
                            <a href="{{ route('hr.cuti.pdf', $item->id) }}"
                                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-md 
                      bg-emerald-600 text-white hover:bg-emerald-700 transition">
                                Cetak PDF
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>