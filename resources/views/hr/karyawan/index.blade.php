<x-app-layout>
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

        @if ($users->isEmpty())
        <p class="text-gray-500 text-center">Belum ada data karyawan.</p>
        @else
        <table class="min-w-full border border-gray-300 dark:border-slate-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 dark:bg-slate-900 tracking-wide uppercase">
                <tr>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
                        text-gray-800 dark:text-gray-100 
                        bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                        border border-black/70 dark:border-white/80 
                        rounded-md transition-colors">No</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
                        text-gray-800 dark:text-gray-100 
                        bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                        border border-black/70 dark:border-white/80 
                        rounded-md transition-colors">Nama</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
                        text-gray-800 dark:text-gray-100 
                        bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                        border border-black/70 dark:border-white/80 
                        rounded-md transition-colors">NIP</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
                        text-gray-800 dark:text-gray-100 
                        bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                        border border-black/70 dark:border-white/80 
                        rounded-md transition-colors">Email</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
                        text-gray-800 dark:text-gray-100 
                        bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                        border border-black/70 dark:border-white/80 
                        rounded-md transition-colors">Role</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold 
                        text-gray-800 dark:text-gray-100 
                        bg-[#f8f8ee] dark:bg-[#4c6647]/80 
                        border border-black/70 dark:border-white/80 
                        rounded-md transition-colors">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-[#9dcd5a]/10 transition-colors">
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 transition-colors text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 transition-colors">
                        {{ $user->name }}
                    </td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 transition-colors">
                        {{ $user->nip ?? '-' }}
                    </td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 transition-colors">
                        {{ $user->email }}
                    </td>
                    <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 transition-colors capitalize text-center">
                        {{ $user->role }}
                    </td>
                    <td
                        class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-center
         text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 transition-colors">

                        <!-- Tombol Edit -->
                        <a href="{{ route('hr.karyawan.edit', $user->id) }}"
                            class="inline-block px-3 py-1 text-sm font-semibold rounded-md
          border border-blue-400 text-blue-600
          bg-blue-100/40 hover:bg-blue-500 hover:text-white
          dark:bg-[#4c6647]/40 dark:text-blue-300 dark:border-blue-300
          transition">Edit</a>

                        <!-- Tombol Reset Password -->
                        <form id="resetForm-{{ $user->id }}"
                            action="{{ route('hr.karyawan.resetPassword', $user->id) }}"
                            method="POST"
                            class="inline-block ml-2">
                            @csrf
                            <x-confirm-reset
                                title="Konfirmasi Reset Password"
                                :message="'Yakin ingin mereset password akun milik ' . $user->name . '?'"
                                confirm="Ya, Reset"
                                cancel="Batal"
                                :formId="'resetForm-' . $user->id" />
                        </form>

                        <!-- Form hapus + modal -->
                        <form id="deleteForm-{{ $user->id }}"
                            action="{{ route('hr.karyawan.destroy', $user->id) }}"
                            method="POST"
                            class="inline-block ml-2">
                            @csrf
                            @method('DELETE')

                            <x-confirm-delete
                                title="Konfirmasi Penghapusan"
                                :message="'Yakin ingin menghapus karyawan ' . $user->name . '?'"
                                confirm="Ya, Hapus"
                                cancel="Batal"
                                :formId="'deleteForm-' . $user->id" />
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>