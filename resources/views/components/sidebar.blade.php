<aside id="sidebar"
    class="sidebar fixed md:static z-30 inset-y-0 left-0 w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-200
           bg-[#6da54e] dark:bg-[#0f172a] text-white min-h-screen py-6 px-4">

    <ul class="space-y-2 text-sm">
        {{-- Menu Umum --}}
        <li>
            <a href="{{ route('dashboard') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a] dark:hover:bg-slate-800
               {{ request()->routeIs('dashboard') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                🏠 Dashboard
            </a>
        </li>

        {{-- Menu Karyawan --}}
        @if(Auth::user()->role === 'karyawan')
        <li>
            <a href="{{ route('karyawan.cuti.index') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a] dark:hover:bg-gray-700
                   {{ request()->routeIs('karyawan.cuti.index') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                📝 Daftar Cuti
            </a>
        </li>
        <li>
            <a href="{{ route('karyawan.cuti.create') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a] dark:hover:bg-gray-700
                   {{ request()->routeIs('karyawan.cuti.create') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                ➕ Ajukan Cuti
            </a>
        </li>

        {{-- Menu HR --}}
        @elseif(Auth::user()->role === 'hr')

        <li>
            <a href="{{ route('hr.karyawan.index') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a] dark:hover:bg-gray-700
                   {{ request()->routeIs('hr.karyawan.*') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                👥 Data Karyawan
            </a>
        </li>
        <li>
            <a href="{{ route('hr.cuti.index') }}"
                class="block py-2 px-3 rounded hover:bg-[#9dcd5a] dark:hover:bg-gray-700
                   {{ request()->routeIs('hr.cuti.*') ? 'bg-[#9dcd5a]/30 font-semibold' : '' }}">
                📋 Semua Pengajuan
            </a>
        </li>
        
        @endif
    </ul>
</aside>