<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-xl shadow">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">
            Pengajuan Cuti Divisi Anda
        </h1>

        @if ($cuti->isEmpty())
        <p class="text-gray-500">
            Tidak ada pengajuan cuti yang menunggu persetujuan.
        </p>
        @else
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Periode</th>
                    <th class="p-2 border">Alasan</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuti as $item)
                <tr>
                    <td class="p-2 border">
                        {{ $item->user->karyawan->nama_lengkap ?? '-' }}
                    </td>
                    <td class="p-2 border">
                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }}
                        -
                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                    </td>
                    <td class="p-2 border">
                        {{ $item->alasan }}
                    </td>
                    <td class="p-2 border text-center">
                        <form method="POST"
                            action="{{ route('atasan.cuti.approve', $item->id) }}">
                            @csrf
                            <button
                                class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                Approve
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>