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
            <table class="min-w-full border border-gray-300 dark:border-slate-700 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 dark:bg-slate-900 tracking-wide uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">No</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">NIP</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">Nama Lengkap</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">Jabatan</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">Divisi</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">Role</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-100 bg-[#f8f8ee] dark:bg-[#4c6647]/80 border border-black/70 dark:border-white/80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $item)
                    <tr class="hover:bg-[#9dcd5a]/10 transition-colors">
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-center text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60">
                            {{ $item->nip }}
                        </td>
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60">
                            {{ $item->nama_lengkap }}
                        </td>
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60">
                            {{ $item->jabatan }}
                        </td>
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-center text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60">
                            {{ $item->divisi ?? '-' }}
                        </td>
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-center text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60 capitalize">
                            {{ $item->user->role ?? '-' }}
                        </td>
                        <td class="border border-black/70 dark:border-[#9dcd5a]/40 p-2 text-sm text-center text-gray-700 dark:text-gray-200 bg-white dark:bg-[#4c6647]/60">
                            <!-- Edit -->
                            <a href="{{ route('hr.karyawan.edit', $item->id) }}"
                                class="inline-block px-3 py-1 text-sm font-semibold rounded-md border border-blue-400 text-blue-600 bg-blue-100/40 hover:bg-blue-500 hover:text-white dark:text-blue-300 dark:border-blue-300 transition">Edit</a>

                            <!-- Reset Password -->
                            <form id="resetForm-{{ $item->id }}"
                                action="{{ route('hr.karyawan.resetPassword', $item->id) }}"
                                method="POST" class="inline-block ml-2">
                                @csrf
                                <x-confirm-reset
                                    title="Konfirmasi Reset Password"
                                    :message="'Yakin ingin mereset password akun milik ' . $item->nama_lengkap . '?'"
                                    confirm="Ya, Reset"
                                    cancel="Batal"
                                    :formId="'resetForm-' . $item->id" />
                            </form>

                            <!-- Hapus -->
                            <form id="deleteForm-{{ $item->id }}"
                                action="{{ route('hr.karyawan.destroy', $item->id) }}"
                                method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <x-confirm-delete
                                    title="Konfirmasi Penghapusan"
                                    :message="'Yakin ingin menghapus karyawan ' . $item->nama_lengkap . '?'"
                                    confirm="Ya, Hapus"
                                    cancel="Batal"
                                    :formId="'deleteForm-' . $item->id" />
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <div class="mt-4">
                {{ $karyawan->links() }}
            </div>
        </div>
</x-app-layout>