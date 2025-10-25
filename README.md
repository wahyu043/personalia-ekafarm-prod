# 🧭 Personalia Ekafarm PROD

**Personalia Ekafarm PROD** adalah sistem internal berbasis web untuk mengelola data cuti karyawan di lingkungan **CV. Agro Sukses Abadi (Ekafarm)**.  
Proyek ini dibangun dari awal menggunakan **Laravel 12** dan **Tailwind CSS v4**, ditujukan untuk digitalisasi manajemen SDM dan sebagai portofolio pengembang.

---

## ⚙️ Setup Awal

### 1️⃣ Instalasi Laravel

```bash
composer create-project laravel/laravel personalia-ekafarm-prod
cd personalia-ekafarm-prod
```

### 2️⃣ Instalasi Dependency Frontend

```bash
npm install
```

### 3️⃣ Instalasi Tailwind CSS v4

```bash
npm install tailwindcss
```

Edit `resources/css/app.css`:
```css
@import "tailwindcss";
```

> ⚠️ Tidak perlu `tailwind.config.js` karena Tailwind v4 sudah auto-config.

### 4️⃣ Jalankan Server

```bash
npm run dev
php artisan serve
```
Akses di browser → [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧱 Struktur Awal Proyek

```
personalia-ekafarm-prod/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Providers/
├── resources/
│   ├── views/
│   ├── css/app.css
│   └── js/app.js
├── routes/web.php
└── package.json
```

---

## 💡 Uji Integrasi Tailwind

Edit `resources/views/welcome.blade.php`:
```html
<h1 class="text-3xl font-bold text-green-600 text-center mt-10">
  Laravel + Tailwind CSS v4 Aktif 🎉
</h1>
```

Jika teks hijau besar muncul, Tailwind berhasil terpasang.

---

## 🌿 Versi & Teknologi

| Komponen | Versi | Keterangan |
|-----------|--------|------------|
| Laravel | 12.x | Framework utama backend |
| PHP | 8.2.24 | Sesuai requirement Laravel 12 |
| Node.js | 20.19.1 | Build tools (Vite + Tailwind) |
| Tailwind CSS | 4.x | Styling modern berbasis utility |
| Database | MySQL / MariaDB | Disesuaikan dengan server Hestia Ekafarm |

---

## Lisensi

Proyek ini dirancang untuk kebutuhan internal CV. Agro Sukses Abadi dan portofolio pribadi.  
Lisensi bersifat **private**, namun dokumentasi dapat digunakan sebagai referensi pembelajaran Laravel.

---

> _“Bismillah, semoga lebih rapi dari yang sebelumnya.”_  
> — Wahyu Mahmudiyanto, 2025-10-25
