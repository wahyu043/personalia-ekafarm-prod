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
                    <input type="text" name="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}"
                        class="w-full rounded-md border border-gray-300 bg-white text-gray-800 px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Divisi</label>
                    <input type="text" name="divisi" value="{{ old('divisi', $karyawan->divisi) }}"
                        class="w-full rounded-md border border-gray-300 bg-white text-gray-800 px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk?->format('Y-m-d')) }}"
                        class="w-full rounded-md border border-gray-300 bg-white text-gray-800 px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition" required>
                </div>

                @if ($user)
                <hr class="border-gray-300">
                <p class="text-xs text-gray-400 italic">Data akun login</p>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-md border border-gray-300 bg-white text-gray-800 px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition" required>
                </div>
                @endif

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('hr.karyawan.index') }}"
                        class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-[#6da54e] text-white hover:bg-[#4c6647] transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
</x-app-layout>