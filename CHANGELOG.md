# 🧾 CHANGELOG — Personalia Ekafarm PROD

## [v0.2.0] — 25 Oktober 2025
### ✨ Fitur Baru
- Integrasi **Laravel Breeze** sebagai sistem autentikasi utama.
- Penambahan **RoleMiddleware** (`role:karyawan` & `role:hr`) untuk pembeda akses dashboard.
- Penambahan **auto redirect** setelah login sesuai role pengguna.
- Pembuatan dua dashboard dasar:
  - `/karyawan/dashboard` → tampilan awal karyawan
  - `/hr/dashboard` → tampilan awal HR

---

### 🧱 Perubahan Struktural
- Mengaktifkan sistem middleware melalui `bootstrap/app.php` (tanpa `Http/Kernel.php`).
- Menambahkan alias middleware `role` di konfigurasi `withMiddleware()`.
- Menyesuaikan layout `app.blade.php` & `components/app-layout.blade.php` agar kompatibel dengan sistem slot Breeze.
- Menambahkan route `dashboard` sebagai redirect universal ke dashboard berdasarkan role.
- Menonaktifkan sementara link **Profile** di navigation untuk mencegah error `Route [profile.edit] not defined`.

---

### 🧩 Fixes
- ✅ Mengatasi error `Route [profile.edit] not defined`.
- ✅ Mengatasi error `Route [dashboard] not defined`.
- ✅ Memulihkan tampilan teks “Selamat Datang” pada dashboard setelah penyesuaian layout slot.
- ✅ Merapikan tampilan landing page (`welcome.blade.php`) ke gaya minimalis berbasis Tailwind.

---

### 📁 Struktur Baru
```text
resources/views/
├── hr/
│   └── dashboard.blade.php
├── karyawan/
│   └── dashboard.blade.php
├── components/
│   └── app-layout.blade.php
└── layouts/
    ├── app.blade.php
    └── navigation.blade.php

---

`Status`: Stable milestone setelah debugging Breeze & layout conflict
`Next Target`: Form Pengajuan Cuti (MVP) 🚀

---

## [0.1.0] 2025-10-25
### 🚀 Initial Commit
- Inisiasi proyek baru dengan nama **personalia-ekafarm-prod**
- Instalasi Laravel 12
- Instalasi Tailwind CSS v4 (tanpa konfigurasi manual)
- Setup environment lokal & Vite build
- Commit & push awal ke GitHub
