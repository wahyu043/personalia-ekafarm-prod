<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Personalia Ekafarm') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-[Nunito] bg-[#f8f8ee] text-[#4c6647] dark:bg-[#1a1a1a] dark:text-gray-200 transition-colors duration-300 flex flex-col min-h-screen">

    {{-- HEADER --}}
    <header class="bg-[#4c6647] dark:bg-[#0f172a] text-white shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            {{-- Left --}}
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/ekafarm-logo-clr-bg.png') }}" alt="Logo Ekafarm" class="h-8 w-auto">
                <h1 class="text-lg font-semibold">Personalia Ekafarm</h1>
            </div>

            {{-- Right --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="bg-[#6da54e] hover:bg-[#4c6647] text-white font-semibold px-4 py-2 rounded-md transition">
                    Login
                </a>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="flex-1">
        {{-- Hero --}}
        <section class="text-center py-12 px-6 bg-white/80 dark:bg-[#0f172a] shadow-sm max-w-3xl mx-auto mt-8 rounded-xl">
            <h2 class="text-2xl font-bold mb-3">Selamat Datang di Sistem Personalia</h2>
            <p class="text-gray-600 dark:text-gray-300">
                Digitalisasi Manajemen SDM CV. Agro Sukses Abadi
            </p>
        </section>

        {{-- Visi Misi --}}
        <section class="max-w-4xl mx-auto text-left py-12 px-6 leading-relaxed">
            <h3 class="text-2xl font-bold mb-4 text-center">VISI & MISI EKA FARM</h3>

            <h4 class="text-xl font-semibold mb-2">VISI</h4>
            <p class="mb-6">
                Perusahaan penyedia makanan dan minuman kesehatan untuk Masyarakat Indonesia.
            </p>

            <h4 class="text-xl font-semibold mb-2">MISI</h4>
            <ul class="list-disc list-inside mb-6 space-y-1">
                <li>Menyediakan produk yang bermutu dan berkualitas yang mudah dijangkau oleh Masyarakat.</li>
                <li>Menjadi partner bagi konsumen untuk menjaga pola hidup sehat.</li>
                <li>Meningkatkan pertumbuhan perusahaan, kompetensi karyawan, dan seluruh Mitra.</li>
            </ul>

            <h4 class="text-xl font-semibold mb-2">Core Value Eka Farm</h4>
            <p class="font-semibold">BAIK</p>
            <ul class="list-none mt-2 space-y-1">
                <li><span class="font-bold">B</span> = Berani ambil tanggung jawab</li>
                <li><span class="font-bold">A</span> = Adaptif</li>
                <li><span class="font-bold">I</span> = Iman</li>
                <li><span class="font-bold">K</span> = Kompeten</li>
            </ul>
        </section>

        {{-- Cuti Hari Ini --}}
        <section class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm mb-16">
            <h3 class="text-xl font-semibold mb-4 text-[#4c6647] dark:text-[#9dcd5a]">
                Karyawan yang Sedang Cuti Hari Ini
            </h3>
            @if($cutiHariIni->isEmpty())
            <p class="text-gray-500">Tidak ada karyawan yang cuti hari ini.</p>
            @else
            <ul class="space-y-2">
                @foreach($cutiHariIni as $c)
                <li class="flex items-center gap-2">
                    <span class="text-[#6da54e]">•</span>
                    <span>{{ $c->nama_karyawan }} — {{ $c->divisi }}</span>
                </li>
                @endforeach
            </ul>
            @endif
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-[#4c6647] dark:bg-gray-900 text-white text-center py-4 mt-auto shadow-inner">
        <p class="text-sm">© {{ date('Y') }} CV. Agro Sukses Abadi. Semua Hak Dilindungi.</p>
    </footer>

</body>

</html>