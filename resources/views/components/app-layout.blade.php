{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'Personalia ASA') : config('app.name', 'Personalia Agro Sukses Abadi') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-cv-asa-square.png') }}">
</head>

<body class="font-[Nunito] bg-[#f8f8ee] text-[#4c6647] transition-colors duration-300 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-[#4c6647] text-white shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            {{-- Left: Logo --}}
            <div class="flex items-center gap-2">
                <button id="mobile-toggle" class="md:hidden text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <img src="{{ asset('images/logo-cv-ASA-white.png') }}" alt="Logo Agro Sukses Abadi" class="h-8 w-auto">
                <h1 class="text-lg text-white font-semibold">Personalia Agro Sukses Abadi</h1>
            </div>

            {{-- Right: User --}}
            <nav class="flex items-center gap-4 text-sm">
                <span>{{ Auth::user()->name ?? 'Guest' }}</span>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded-md">
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
            <div class="bg-white shadow-sm rounded-xl p-6 transition-colors duration-200">
                {{ $slot }}
            </div>
        </main>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-[#4c6647] text-white text-center text-sm py-2 mt-auto">
        <p>© {{ date('Y') }} CV. Agro Sukses Abadi. Semua Hak Dilindungi.</p>
    </footer>

    {{-- FLASH MESSAGE TOAST --}}
    @if (session('success') || session('error'))
    <div id="toast"
        class="fixed bottom-6 right-6 z-50 flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg text-sm font-medium transition-all duration-500
        {{ session('success') ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
        <span>{{ session('success') ? '✅' : '❌' }}</span>
        <span>{{ session('success') ?? session('error') }}</span>
        <button onclick="document.getElementById('toast').remove()" class="ml-2 text-lg leading-none opacity-50 hover:opacity-100">&times;</button>
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>
    @endif

    {{-- SCRIPT --}}
    <script>
        // Sidebar toggle (mobile)
        const mobileToggle = document.getElementById('mobile-toggle');
        const sidebar = document.getElementById('sidebar');

        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

</body>

</html>