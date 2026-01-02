<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard HR</h1>
                    <p class="text-sm text-gray-500">Kelola pengajuan cuti yang sudah disetujui atasan dan menunggu final approval HR.</p>
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                    <p class="text-sm text-yellow-800">Menunggu HR</p>
                    <p class="text-3xl font-bold text-yellow-900 mt-2">{{ $countMenunggu ?? 0 }}</p>
                </div>

                <div class="rounded-lg border border-green-200 bg-green-50 p-4">
                    <p class="text-sm text-green-800">Disetujui</p>
                    <p class="text-3xl font-bold text-green-900 mt-2">{{ $countDisetujui ?? 0 }}</p>
                </div>

                <div class="rounded-lg border border-red-200 bg-red-50 p-4">
                    <p class="text-sm text-red-800">Ditolak</p>
                    <p class="text-3xl font-bold text-red-900 mt-2">{{ $countDitolak ?? 0 }}</p>
                </div>
            </div>

            {{-- Tabel --}}
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Pengajuan Menunggu Final Approval</h2>

            @if($cuti->isEmpty())
            <div class="rounded-lg border border-dashed border-gray-300 p-6 text-center text-gray-500">
                Tidak ada pengajuan cuti yang menunggu persetujuan HR.
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">NIP</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Divisi</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Periode</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Alasan</th>
                            <th class="p-3 text-center text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="p-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cuti as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-800">
                                {{ $item->user->karyawan->nama_lengkap ?? $item->user->name }}
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                {{ $item->user->nip ?? '-' }}
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                {{ $item->user->karyawan->divisi ?? '-' }}
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }}
                                -
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                {{ \Illuminate\Support\Str::limit($item->alasan, 40) }}
                            </td>
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-md bg-yellow-100 text-yellow-800 border border-yellow-300/60">
                                    Menunggu HR
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <form method="POST" action="{{ route('hr.cuti.approve', $item->id) }}">
                                        @csrf
                                        <button class="px-3 py-1.5 text-sm rounded-md bg-green-600 text-white hover:bg-green-700">
                                            Setujui
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('hr.cuti.reject', $item->id) }}">
                                        @csrf
                                        <button class="px-3 py-1.5 text-sm rounded-md bg-red-600 text-white hover:bg-red-700">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>