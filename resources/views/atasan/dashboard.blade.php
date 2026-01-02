<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">
            Dashboard Atasan
        </h1>

        <p class="text-sm text-gray-500 mb-6">
            Divisi: <strong>{{ $divisi }}</strong>
        </p>

        <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 mb-6">
            <p class="text-yellow-800 text-sm">
                Pengajuan cuti menunggu persetujuan Anda
            </p>
            <p class="text-3xl font-bold text-yellow-900 mt-2">
                {{ $jumlahMenunggu }}
            </p>
        </div>

        <a href="{{ route('atasan.cuti.index') }}"
            class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Lihat Pengajuan Cuti
        </a>
    </div>
</x-app-layout>