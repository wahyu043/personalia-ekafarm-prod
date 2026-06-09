# 🧭 Personalia Ekafarm PROD

**Personalia Ekafarm PROD** adalah sistem internal berbasis web untuk mengelola data cuti karyawan di lingkungan **CV. Agro Sukses Abadi (Ekafarm)**.  
Aplikasi ini dibangun dari nol menggunakan **Laravel 12** dan **Tailwind CSS v4**, ditujukan untuk digitalisasi manajemen SDM serta menjadi _legacy project_ pribadi pengembang.

---

## 🚀 Fitur Utama (Versi v0.5.2)

| Status | Fitur                                            | Keterangan                                                         |
| :----: | :----------------------------------------------- | :----------------------------------------------------------------- |
|   ✅   | Setup Laravel 12 + Tailwind v4                   | Struktur proyek dasar & integrasi Vite berjalan stabil             |
|   ✅   | Autentikasi multi-role (HR & Karyawan)           | Login, register, dan middleware `role` berjalan sempurna           |
|   ✅   | Dashboard Karyawan Dinamis                       | Statistik & riwayat pengajuan cuti ditarik langsung dari database  |
|   ✅   | Dashboard HR                                     | Menampilkan rekap global pengajuan, status, dan tombol cetak PDF   |
|   ✅   | Sistem Cetak PDF Surat Cuti                      | Format surat resmi A4 dengan area tanda tangan dan catatan manajer |
|   ✅   | CRUD Data Karyawan (HR)                          | HR dapat menambah, edit, hapus, dan reset password karyawan        |
|   ✅   | Desain Login Bernuansa Ekafarm                   | Login Breeze diubah total menyesuaikan palet warna brand           |
|   ⏳   | Reset Password Mandiri (Karyawan)                | Akan diaktifkan di v0.6.0 melalui Mailtrap (email testing)         |
|   ⏳   | Jenis Form Lain (Izin, Lembur, Pinjam Fasilitas) | Direncanakan untuk fitur selanjutnya                               |

---

## 🌿 Highlight v0.5.1

- **Dashboard karyawan** kini sepenuhnya dinamis:
    - Statistik pengajuan berdasarkan status (_menunggu_, _disetujui_, _ditolak_).
    - Riwayat pengajuan terakhir (limit 5 data).
- **Middleware `role` tunggal** menggantikan alias terpisah `hr` dan `karyawan`.
- **Layout profil header baru:** avatar, nama, divisi, dan tanggal di pojok kanan atas.
- **Tone warna hijau Ekafarm konsisten** di seluruh halaman (login, dashboard, tabel, dark mode).
- **Route** sudah terbagi rapi:
    - `/karyawan/dashboard` untuk karyawan.
    - `/hr/dashboard` untuk HR.
    - `/cuti/{id}` sementara diarahkan ke halaman daftar cuti.

---

## ⚙️ Instalasi & Setup Lokal

### 1️⃣ Clone repositori

```bash
git clone https://github.com/wahyu043/personalia-ekafarm-prod.git
cd personalia-ekafarm-prod
```

### 2️⃣ Install dependency backend & frontend

```bash
composer install
npm install
```

### 3️⃣ Salin & konfigurasi environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit bagian database sesuai konfigurasi lokal kamu:

```env
DB_DATABASE=db_name
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Migrasi database

```bash
php artisan migrate
```

### 5️⃣ Jalankan aplikasi

```bash
npm run dev
php artisan serve
```

Akses di browser → [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧱 Struktur Proyek

```
personalia-ekafarm-prod/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HR/
│   │   │   └── Karyawan/
│   │   └── Middleware/
│   ├── Models/
│   └── Providers/
├── resources/
│   ├── views/
│   │   ├── hr/
│   │   ├── karyawan/
│   │   └── components/
│   ├── css/app.css
│   └── js/app.js
├── routes/web.php
├── database/migrations/
├── public/
└── package.json
```

---

## 💡 Teknologi

| Komponen            | Versi   | Deskripsi                       |
| ------------------- | ------- | ------------------------------- |
| **Laravel**         | 12.x    | Framework backend utama         |
| **PHP**             | 8.2.24  | Sesuai requirement Laravel 12   |
| **Node.js**         | 20.19.1 | Build tools (Vite + Tailwind)   |
| **Tailwind CSS**    | 4.x     | Styling modern berbasis utility |
| **MySQL / MariaDB** | 5.7+    | Basis data utama                |
| **Laravel Breeze**  | v2      | Sistem autentikasi dan UI dasar |
| **DOMPDF**          | v2.x    | Export PDF surat cuti           |
| **Vite**            | v5      | Compiler CSS & JS modern        |

---

## 🪶 Workflow Pengembangan

|   Versi    | Fase                                | Fokus                               |
| :--------: | :---------------------------------- | :---------------------------------- |
|   v0.4.3   | UI/UX Consolidation                 | Dashboard seragam HR & Karyawan     |
|   v0.4.4   | Global Styling                      | Palet & dark mode stabil            |
|   v0.4.5   | CRUD Karyawan                       | HR bisa kelola data user            |
|   v0.5.0   | Export PDF                          | Surat cuti resmi A4 final           |
| **v0.5.1** | Finalisasi Role & Dashboard Dinamis | Data real-time, login selaras brand |
| ⏳ v0.6.0  | Reset Password Mandiri              | Aktivasi Mailtrap & audit log       |

---

## 👨‍💻 Pengembang

**Wahyu Mahmudiyanto**  
SEO Specialist & Web Developer at [Ekafarm](https://ekafarm.com)  
📍 Yogyakarta, Indonesia  
🌐 [wahyumahmudi.com](https://wahyumahmudi.com)

---

## 🧾 Lisensi

Proyek ini bersifat **private** dan digunakan secara internal di lingkungan **CV. Agro Sukses Abadi (Ekafarm)**.  
Seluruh dokumentasi teknis dapat digunakan sebagai bahan referensi pembelajaran Laravel modern.

---

> _“Alhamdulillah, v0.5.2 rampung lebih cepat dari target.”_  
> — Wahyu Mahmudiyanto, 11 November 2025
