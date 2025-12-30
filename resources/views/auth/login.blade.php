<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Personalia Ekafarm</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-[Nunito] text-[#4c6647] bg-[#f8f8ee] min-h-screen flex items-center justify-center"
    style="background-image: url('{{ asset('images/main-home-login-bg.png') }}'); 
           background-repeat: no-repeat; 
           background-position: center center; 
           background-size: cover;">

    {{-- WRAPPER CARD --}}
    <div class="flex flex-col md:flex-row bg-white/85 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden
              w-11/12 sm:w-10/12 md:w-3/4 lg:w-2/3 xl:w-1/2 max-w-5xl">

        {{-- LEFT COLUMN --}}
        <div class="w-full md:w-1/2 bg-[#f8f8ee]/80 dark:bg-[#1a1a1a]/90 flex flex-col justify-center items-center 
                text-center px-8 py-12">
            <img src="{{ asset('images/ekafarm-logo-clr-bg.png') }}" alt="Logo Ekafarm" class="h-20 md:h-24 mb-6 drop-shadow-sm">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang di Sistem Personalia</h2>
            <p class="text-gray-600 dark:text-gray-300 text-sm mb-1">Digitalisasi Manajemen SDM</p>
            <p class="text-[#4c6647] font-semibold">CV. Agro Sukses Abadi</p>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="w-full md:w-1/2 bg-white dark:bg-[#0f172a] flex flex-col justify-center p-8 md:p-10">
            <h3 class="text-xl font-semibold text-center mb-6">Login ke Akun Anda</h3>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Nomor Induk Pegawai</label>
                    <input id="nip" name="nip" type="text" required autofocus placeholder="NIP"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#6da54e] focus:border-[#6da54e] 
                           dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100">
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required placeholder="Password"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#6da54e] focus:border-[#6da54e]
                           dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100">
                </div>

                {{-- Remember Me + Forgot Password --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded text-[#6da54e] focus:ring-[#6da54e]">
                        <span class="ml-2 text-sm">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-[#6da54e] hover:underline">
                        Lupa kata sandi?
                    </a>
                    @endif
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="w-full bg-[#6da54e] hover:bg-[#4c6647] text-white font-semibold py-2 rounded-md transition">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>