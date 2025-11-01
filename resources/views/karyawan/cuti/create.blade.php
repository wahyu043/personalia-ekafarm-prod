<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-700 text-center">Form Pengajuan Cuti</h1>

        @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('cuti.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('tanggal_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Alasan</label>
                <textarea name="alasan" rows="3" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('alasan') }}</textarea>
                @error('alasan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Upload Bukti (opsional)</label>
                <input type="file" name="bukti" class="mt-1 block w-full">
                @error('bukti') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Karyawan Pengganti</label>
                <textarea name="pengganti" rows="2" class="mt-1 block w-full rounded-md border-gray-300">{{ old('pengganti') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>