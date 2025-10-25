# 🧭 Personalia Ekafarm PROD

**Personalia Ekafarm PROD** adalah sistem internal berbasis web untuk mengelola data cuti karyawan di lingkungan **CV. Agro Sukses Abadi (Ekafarm)**.  
Proyek ini dibangun dari awal menggunakan **Laravel 12** dan **Tailwind CSS v4**, ditujukan untuk digitalisasi manajemen SDM dan sebagai portofolio pengembang.

---

## 🚀 Fitur Utama (Roadmap MVP)

| Status | Fitur | Keterangan |
|:--:|:--|:--|
| ✅ | Setup Laravel 12 + Tailwind CSS v4 | Inisialisasi proyek dasar, Vite aktif, environment stabil |
| ✅ | Auth 2 role (HR & Karyawan) | Registrasi, login, dan middleware pembeda dashboard |
| 🔄 | Dashboard HR & Karyawan | Tampilan utama berbeda sesuai role pengguna |
| ⏳ | Pengajuan cuti (aktif) | Form pengajuan dengan tanggal, alasan (teks), dan bukti opsional upload |
| ⏳ | Jenis form lain (izin, lembur, pinjam fasilitas) | Ditampilkan tapi belum aktif — diberi label “Segera Hadir” |
| ⏳ | Karyawan pengganti | Kolom teks area manual untuk nama karyawan pengganti |
| ⏳ | Approval HR & Manajer Divisi | HR dan Manajer menandatangani form cuti (kolom tanda tangan basah di PDF) |
| ⏳ | Cetak PDF surat cuti | Export surat cuti resmi dengan tanda tangan dan status |
| ⏳ | Dashboard statistik HR | HR dapat melihat rekap cuti, jumlah pengajuan, dan status persetujuan |

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
| Database | MySQL / MariaDB | Disesuaikan dengan server Ekafarm |

---

## 🧾 CHANGELOG

Lihat file [`CHANGELOG.md`](./CHANGELOG.md) untuk daftar lengkap perubahan versi.

---

## 👨‍💻 Pengembang

**Wahyu Mahmudiyanto**  
SEO Specialist & Web Developer at [Ekafarm](https://ekafarm.com)  
📍 Yogyakarta, Indonesia  
🌐 [wahyumahmudi.com](https://wahyumahmudi.com)

---

## Lisensi

Proyek ini dirancang untuk kebutuhan internal CV. Agro Sukses Abadi dan portofolio pribadi.  
Lisensi bersifat **private**, namun dokumentasi dapat digunakan sebagai referensi pembelajaran Laravel.

---

> _“Bismillah, semoga lebih rapi dari yang sebelumnya.”_  
> — Wahyu Mahmudiyanto, 2025-10-25
