<aside id="sidebar"
    class="sidebar fixed md:static z-30 inset-y-0 left-0 w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-200
           bg-[#6da54e] dark:bg-[#0f172a] text-white min-h-screen py-6 px-4">

    <ul class="space-y-2 text-sm">
        <li>
            <a href="{{ route('dashboard') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a] dark:hover:bg-slate-800
               {{ request()->routeIs('dashboard') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                🏠 Dashboard
            </a>
        </li>
        {{-- Menu Role --}}
        @if(Auth::user()->role === 'staff')

        {{-- Menu Staff --}}
        <li>
            <a href="{{ route('karyawan.cuti.index') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a]
           {{ request()->routeIs('karyawan.cuti.index') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                📝 Daftar Cuti
            </a>
        </li>

        @if($isEligibleCuti)
        <li>
            <a href="{{ route('karyawan.cuti.create') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a]
               {{ request()->routeIs('karyawan.cuti.create') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                ➕ Ajukan Cuti
            </a>
        </li>
        @else
        <li>
            <span class="block py-2 px-3 rounded text-gray-200 opacity-70 cursor-not-allowed">
                ⏳ Ajukan Cuti (Belum Aktif)
            </span>
        </li>
        @endif

        @elseif(Auth::user()->role === 'hr')

        {{-- Menu HR --}}
        <li>
            <a href="{{ route('hr.karyawan.index') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a]
           {{ request()->routeIs('hr.karyawan.*') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                👥 Data Karyawan
            </a>
        </li>

        <li>
            <a href="{{ route('hr.cuti.index') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a]
           {{ request()->routeIs('hr.cuti.*') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                📋 Semua Pengajuan
            </a>
        </li>

        @endif

    </ul>
</aside>