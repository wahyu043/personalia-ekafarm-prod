<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-[#4c6647]/60 rounded-xl shadow mt-10 transition-colors">
        <h2 class="text-2xl font-bold mb-6 text-center text-[#4c6647] dark:text-[#9dcd5a]">
            Tambah Karyawan Baru
        </h2>

        <x-alert />

        <form action="{{ route('hr.karyawan.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-100">Nama Lengkap</label>
                <input type="text" name="name"
                    class="w-full rounded-md border border-gray-300 dark:border-[#9dcd5a]/40 
                    bg-white dark:bg-[#4c6647]/40 text-gray-800 dark:text-gray-100 
                    px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition"
                    required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-100">NIP</label>
                <input type="text" name="nip"
                    class="w-full rounded-md border border-gray-300 dark:border-[#9dcd5a]/40 
                    bg-white dark:bg-[#4c6647]/40 text-gray-800 dark:text-gray-100 
                    px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition"
                    required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-100">Email</label>
                <input type="email" name="email"
                    class="w-full rounded-md border border-gray-300 dark:border-[#9dcd5a]/40 
                    bg-white dark:bg-[#4c6647]/40 text-gray-800 dark:text-gray-100 
                    px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition"
                    required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-100">Role</label>
                <select name="role"
                    class="w-full rounded-md border border-gray-300 dark:border-[#9dcd5a]/40 
                    bg-white dark:bg-[#4c6647]/40 text-gray-800 dark:text-gray-100 
                    px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition">
                    <option value="karyawan">Karyawan</option>
                    <option value="hr">HR</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-100">Password</label>
                <input type="password" name="password"
                    class="w-full rounded-md border border-gray-300 dark:border-[#9dcd5a]/40 
                    bg-white dark:bg-[#4c6647]/40 text-gray-800 dark:text-gray-100 
                    px-4 py-2 focus:ring-2 focus:ring-[#9dcd5a]/40 focus:outline-none transition"
                    required>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('hr.karyawan.index') }}"
                    class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 
                    hover:bg-gray-400 dark:bg-gray-600/40 dark:text-gray-100 
                    dark:hover:bg-gray-500/60 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-[#6da54e] text-white 
                    hover:bg-[#4c6647] transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
