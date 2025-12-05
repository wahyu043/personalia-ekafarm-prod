{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Personalia Ekafarm') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-[Nunito] bg-[#f8f8ee] text-[#4c6647] dark:bg-[#1a1a1a] dark:text-gray-200 transition-colors duration-300 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-[#4c6647] dark:bg-[#0f172a] text-white shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            {{-- Left: Logo --}}
            <div class="flex items-center gap-2">
                <button id="mobile-toggle" class="md:hidden text-white focus:outline-none">
                    <!-- Icon hamburger -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <img src="{{ asset('images/ekafarm-logo-clr-bg.png') }}" alt="Logo Ekafarm" class="h-8 w-auto">
                <h1 class="text-lg text-white font-semibold">Personalia Ekafarm</h1>
            </div>

            {{-- Right: User & Darkmode --}}
            <nav class="flex items-center gap-4 text-sm">
                <span>{{ Auth::user()->name ?? 'Guest' }}</span>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-[#6da54e] hover:bg-[#4c6647] text-white font-semibold px-3 py-1 rounded-md">
                        Keluar
                    </button>
                </form>
            </nav>
        </div>
    </header>

    {{-- WRAPPER --}}
    <div class="flex flex-1 relative">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:ml-0">
            {{-- Page Content --}}
            <div class="bg-white shadow-sm rounded-xl p-6 transition-colors duration-200
              dark-panel">
                {{ $slot }}
            </div>
        </main>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-[#4c6647] dark:bg-gray-900 text-white text-center text-sm py-2 mt-auto">
        <p>© {{ date('Y') }} CV. Agro Sukses Abadi. Semua Hak Dilindungi.</p>
    </footer>

    {{-- SCRIPT --}}
    <script>
        // Dark Mode Toggle
        const html = document.documentElement;
        const darkToggle = document.getElementById('dark-toggle');
        const iconMoon = document.getElementById('icon-moon');
        const iconSun = document.getElementById('icon-sun');
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.getElementById('mobile-toggle');

        darkToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const darkModeActive = html.classList.contains('dark');
            iconMoon.classList.toggle('hidden', darkModeActive);
            iconSun.classList.toggle('hidden', !darkModeActive);
            localStorage.setItem('theme', darkModeActive ? 'dark' : 'light');
        });

        // Persist dark mode
        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark');
            iconMoon.classList.add('hidden');
        } else {
            iconSun.classList.add('hidden');
        }

        // Sidebar toggle (mobile)
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>