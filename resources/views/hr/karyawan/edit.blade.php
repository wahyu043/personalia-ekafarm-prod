<x-app-layout>
    <x-slot:title>Edit Karyawan</x-slot>
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow mt-10 transition-colors">
            <h2 class="text-2xl font-bold mb-6 text-center text-[#4c6647]">
                Edit Data Karyawan
            </h2>

            <x-alert />

            <form action="{{ route('hr.karyawan.update', $karyawan->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}"
                        class="w-full rounded-md border border-gray-300 bg-white text-gray-800 px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip', $karyawan->nip) }}"
                        class="w-full rounded-md border border-gray-300 bg-white text-gray-800 px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Jabatan</label>
                    <input type="text"