<x-app-layout>
    <x-slot:title>Data Karyawan</x-slot>
        <div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
            <h1 class="text-2xl font-bold mb-6 text-center text-[#4c6647]">
                Daftar Karyawan
            </h1>

            <div class="flex justify-end mb-4">
                <a href="{{ route('hr.karyawan.create') }}"
                    class="px-4 py-2 bg-[#6da54e] text-white rounded-md hover:bg-[#4c6647] transition">
                    + Tambah Karyawan
                </a>
            </div>

            @if ($karyawan->isEmpty())
            <p class="text-gray-500 text-center">Belum ada data karyawan.</p>
            @else
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 tracking-wide uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-black/70">No</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-black/70">NIP</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-black/70">Nama Lengkap</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-black/70">Jabatan</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-black/70">Divisi</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 bg-[#f8f8ee] border border-black/70">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $item)
                    <tr class="hover:bg-[#9dcd5a]/10 transition-colors">
                        <td class="border border-black/70 p-2 text-sm text-center text-gray-700 bg-white">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-black/70 p-2 text-sm text-gray-700 bg-white">
                            {{ $item->nip }}
                        </td>
                        <td class="border border-black/70 p-2 text-sm text-gray-700 bg-white">
                            {{ $item->nama_lengkap }}
                        </td>
                        <td class="border border-black/70 p-2 text-sm text-gray-700 bg-white">
                            {{ $item->jabatan }}
                        </td>
                        <td class="border border-black/70 p-2 text-sm text-center text-gray-700 bg-white">
                            {{ $item->divisi ?? '-' }}
                        </td>
                        <td class="border border-black/70 p-2 text-sm text-center text-gray-700 bg-white">
                            <!-- Edit -->
                            <a href="{{ route('hr.karyawan.edit', $item->id) }}"
                                class="inline-block px-3 py-1 text-sm font-semibold rounded-md border border-blue-400 text-blue-600 bg-blue-100/40 hover:bg-blue-500 hover:text-white transition">Edit</a>

                            <!-- Reset Password -->
                            <form id="resetForm-{{ $item->id }}"
                                action="{{ route('hr.karyawan.resetPassword', $item->id) }}"
                                method="POST" class="inline-block ml-2">
                                @csrf