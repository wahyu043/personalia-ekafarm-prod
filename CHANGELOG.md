# 🧾 CHANGELOG — Personalia Ekafarm PROD

## [v0.4.7] — 10 November 2025
### 👥 Manajemen Data Karyawan (CRUD + Super Reset)

#### ✨ Penambahan
- **Halaman Daftar Karyawan (Index):**
  - Tabel interaktif dengan tampilan seragam seperti modul Cuti (warna, border, dark mode).
  - Kolom: No, Nama, NIP, Email, Role, dan Aksi.
- **Fitur Tambah & Edit Data:**
  - Form input lengkap (nama, NIP, email, role, password).
  - Validasi input wajib (`required`) pada semua field penting.
  - Tampilan konsisten dengan palet hijau Ekafarm.
- **Modal Konfirmasi Penghapusan:**
  - Komponen reusable `<x-confirm-delete>` dengan efek transisi halus dan tema hijau tua.
  - Tombol aksi "Batal" dan "Ya, Hapus" responsif terhadap dark mode.
- **Super Reset Password (HR Only):**
  - Tombol **Reset** di dashboard HR untuk mengatur ulang password karyawan ke default (`password123`).
  - Modal `<x-confirm-reset>` dengan warna kuning keemasan (warning tone) dan animasi fade + scale.
  - Rute dan controller baru untuk aksi reset, lengkap dengan notifikasi keberhasilan.

#### 🧱 Refactor
- **Konsistensi Desain:** seluruh tombol aksi (Edit, Reset, Hapus) kini menggunakan gaya *badge-border* seragam seperti status cuti.
- **Dark Mode:** setiap elemen tabel telah menyesuaikan warna teks dan latar belakang agar kontras seimbang di mode gelap.
- **Componentization:** tombol konfirmasi dipecah menjadi komponen Blade untuk kemudahan reuse di modul lain.

#### ✅ Hasil Akhir
Sistem CRUD Data Karyawan oleh HR telah lengkap, fungsional, dan tampil konsisten dengan modul Cuti.  
Fitur tambahan *Super Reset Password* menambah fleksibilitas tanpa mengorbankan keamanan.


## [v0.4.6] — 10 November 2025
### 🌗 Global Table Style & Sidebar Modularization

#### 🎨 UI/UX Enhancement
- **Dark Mode Fix:** warna teks dan latar tabel kini otomatis menyesuaikan, memastikan kontras tinggi di mode gelap.
- **Global Table Style:** semua halaman (Cuti, Karyawan, HR Dashboard) kini memakai satu standar `global.css`.
  - Teks adaptif `dark:text-gray-200`.
  - Hover lembut hijau natural di light mode dan hijau tua transparan di dark mode.
  - Empty state rapi (`italic`, `gray tone`).
- **Utility Class Baru:**
  - `.btn-primary` → tombol hijau utama Ekafarm.
  - `.btn-secondary` → tombol netral abu adaptif.
  - `.badge-*` → status Menunggu / Disetujui / Ditolak.
- **Komponen Sidebar Reusable:**
  - Dibuat `resources/views/components/sidebar.blade.php`.
  - Navigasi otomatis berdasarkan role (Karyawan / HR).
  - Route aktif mendapat highlight hijau lembut (`bg-[#9dcd5a]/30`).

#### 🧱 Refactor
- View `hr/karyawan/index.blade.php` direstrukturisasi agar sepenuhnya memanfaatkan class global (`.table-wrapper`, `.btn-primary`).
- Penghapusan style inline yang tumpang tindih di mode gelap.
- Layout `app.blade.php` kini memanggil `<x-sidebar />` untuk sidebar dinamis.

#### ✅ Hasil Akhir
>_Semua tampilan kini responsif, bersih, dan memiliki keseragaman gaya di mode terang maupun gelap._
>_CRUD Karyawan dan dashboard HR tampil konsisten tanpa konflik warna atau duplikasi style._

---

## [v0.4.5] — 9–10 November 2025
### 🧑‍💼 CRUD Data Karyawan (HR Module)

#### 🚀 Fitur Baru
- **CRUD Data Karyawan penuh**:
  - Tambah, Edit, Hapus data user dari tabel `users`.
  - Validasi kolom `name`, `nip`, `email`, `role`, dan `password`.
  - Password otomatis di-hash menggunakan `Hash::make`.
- **Kolom NIP aktif**:
  - Field input & tampilan pada tabel `index`.
  - Validasi `unique:users,nip` untuk mencegah duplikasi.
- **Flash Message modular (`<x-alert />`)**:
  - Pesan sukses dan error muncul otomatis di semua halaman CRUD.
- **Navigasi HR Sidebar:**
  - Menu baru “👥 Data Karyawan” di sidebar HR, route aktif ter-highlight.
- **Layout update:**
  - File `app.blade.php` diperbarui untuk mendukung peran HR & Karyawan dengan navigasi adaptif.

#### 💅 UI/UX Enhancement
- Warna hijau Ekafarm dominan (`#4c6647`, `#6da54e`, `#9dcd5a`).
- Tampilan tabel bersih, dengan hover lembut dan kontras status.
- Flash message tunggal (duplikat di layout dihapus).

#### 🧱 Struktur Baru
```text
app/Http/Controllers/HR/KaryawanController.php
resources/views/hr/karyawan/
 ├── index.blade.php
 ├── create.blade.php
 └── edit.blade.php
```

### ✅ Hasil Akhir

> _HR kini bisa mengelola seluruh data karyawan dari dashboard tanpa akses database manual._
> _CRUD berjalan penuh, dengan validasi, flash message, dan tampilan seragam di seluruh sistem._
---

## [v0.4.5] — 2–3 November 2025
### 🧑‍💼 HR Dashboard & Global Table Style

#### 🚀 Fitur Baru
- **Dashboard HR aktif** di `/hr/dashboard`
  - Menampilkan *ringkasan global*: total karyawan, total cuti, menunggu, disetujui, ditolak.
  - Data dinamis ditarik dari model `User` dan `Cuti`.
  - Menampilkan tabel *“Pengajuan Cuti Terbaru”* (limit 5 data terakhir dari semua karyawan).
- **Komponen baru:** `resources/views/components/card.blade.php`  
  digunakan untuk menampilkan statistik singkat di dashboard HR.

---

#### 🎨 UI/UX Enhancement
- **Greeting personal**:
  > “Selamat datang, [nama HR] 👋 – Semoga harimu produktif!”
- Konsistensi warna:
  - Mode terang → `bg-white` + teks hijau tua `#4c6647`
  - Mode gelap → `bg-[#4c6647]/60` + teks putih penuh
- **Warna status adaptif:**
  - 🟡 `Menunggu` → kuning lembut  
  - 🟢 `Disetujui` → hijau muda  
  - 🔴 `Ditolak` → merah muda
- **Hover lembut:**  
  - Light → `hover:bg-[#9dcd5a]/10`  
  - Dark → `dark:hover:bg-[#4c6647]/40`
- Tabel pada dashboard kini seragam dengan tampilan `hr/cuti/index.blade.php` (gaya, border, dan tone warna identik).

---

#### 💅 Global Table Style Enhancement
- Penambahan file `resources/css/global.css` untuk standarisasi tabel di seluruh aplikasi:
  - `border-collapse: collapse` agar sel tabel rapat & rapi.
  - Border luar **hilang otomatis** di mode gelap (`dark:border-transparent`).
  - Pembatas kolom tetap aktif di mode terang (`border-gray-300`).
  - Sudut luar tabel membulat lembut (`rounded-lg`).
  - Hover baris hijau muda lembut di kedua mode tampilan.
- Semua halaman kini otomatis mengikuti gaya tabel global tanpa styling manual.

---

#### ⚙️ Perubahan Struktural
- Pembuatan controller baru: `HR/DashboardController.php`
- Update `routes/web.php`:
  ```php
  Route::middleware(['auth', 'role:hr'])->group(function () {
      Route::get('/hr/dashboard', [DashboardController::class, 'index'])->name('hr.dashboard');
  });

---

### Refactor layout global x-app-layout:
- Slot header dihapus (karena layout modern sudah pakai grid global).
- Penyesuaian gaya warna agar seragam dengan brand Ekafarm.

| Fitur                |        Status        |
| -------------------- | :------------------: |
| Dashboard HR         |           ✅          |
| Global Table Styling |           ✅          |
| CRUD Data Karyawan   | ⏳ (tahap berikutnya) |
| Cetak PDF Surat Cuti |      ⏳ (v0.5.0)      |

> _Milestone: Seluruh layout & tabel kini seragam, modern, dan siap ekspansi ke manajemen data karyawan._ 🚀

## [v0.4.4] — 2 November 2025
### 🎨 Konsistensi & Styling Global
- Penyatuan tone warna antar halaman (Dashboard Karyawan & Daftar Cuti).
- Mode terang:
  - Sidebar hijau daun `#6da54e` dengan teks putih.
  - Panel putih lembut dengan border abu.
- Mode gelap:
  - Sidebar mengikuti Breeze (gelap abu, teks putih).
  - Panel dan tabel menggunakan hijau tua transparan `#4c6647/60–80` dengan border hijau muda `#9dcd5a/40`.
- Penyesuaian tombol:
  - Light mode: hijau daun `#6da54e` → hover hijau tua `#4c6647`.
  - Dark mode: hijau muda `#9dcd5a` → hover hijau daun `#6da54e`.
- Optimalisasi `global.css`:
  - Penghapusan blok fine-tune lama.
  - Penambahan aturan sidebar adaptif & harmonisasi tone panel.
- Penyesuaian hierarki teks:
  - Greeting hijau tua `#4c6647`.
  - Nilai statistik putih agar selaras dengan tone panel.
- Semua komponen kini responsif dan selaras di kedua mode tampilan.

> _Milestone: UI/UX global stabil dan siap menuju tahap HR Dashboard (v0.4.5)._ 🚀

## [v0.4.3] — 1–2 November 2025
### 🎨 UI/UX Consolidation
- Refactor layout global (`x-app-layout`) agar seragam di HR & Karyawan.
- Implementasi palet warna brand Ekafarm:
  - Hijau tua `#4c6647`, hijau daun `#6da54e`, hijau cerah `#9dcd5a`, kuning `#e1d454`.
- Perapian dark mode otomatis, penghapusan tombol manual *dark toggle*.
- Border tabel adaptif (`border-black/70 dark:border-white/80`).
- Hover tabel lembut `hover:bg-[#9dcd5a]/10`.

### 🧩 Komponen Baru
- `components/confirm-modal.blade.php` → modal konfirmasi dengan animasi `x-transition`.
- `components/alert.blade.php` → flash global layout.
- `partials/dashboard-summary.blade.php` → ringkasan statistik cuti.
- Tombol `Simpan/Batal` diseragamkan gaya warnanya (hijau daun Ekafarm).

### 📊 Dashboard HR & Karyawan
- Penyatuan gaya tabel dan badge status (`Menunggu`, `Disetujui`, `Ditolak`).
- Warna status adaptif mode gelap (dark:bg-*/20 + border lembut).
- Penambahan `transition` di seluruh elemen interaktif (hover, modal).

### ⚙️ Struktural
- Penataan ulang `resources/views/components/` dan layout global.
- Flash message hanya dirender sekali dari layout utama.
- Persiapan menuju tahap **v0.4.4 — Konsistensi & Styling Global.**

> _Milestone: UI/UX internal konsisten dan siap tahap polish global styling._ 🚀

## [v0.4.2] — 26 Oktober 2025
### ✨ Fitur Baru
- HR dapat melihat daftar seluruh pengajuan cuti dari semua karyawan.
- HR dapat mengubah status pengajuan menjadi **Menunggu**, **Disetujui**, atau **Ditolak**.
- Karyawan dapat melihat daftar pengajuan cuti miliknya di halaman **Daftar Cuti**.
- Sistem role-based route sudah berjalan untuk `karyawan` dan `hr`.

### 🎨 UI & UX
- Penambahan dropdown status yang rapi dengan jarak aman antara teks dan ikon panah.
- Penataan ulang tabel daftar cuti agar responsif dan mudah dibaca.
- Penambahan notifikasi flash message di dashboard karyawan setelah pengajuan berhasil dikirim.

### 🧱 Struktur Baru
```text
resources/views/
├── hr/
│   └── cuti/
│       └── index.blade.php
└── karyawan/
    └── cuti/
        ├── create.blade.php
        └── index.blade.php
```

### 📈 Status Proyek
| Fitur | Status |
|-------|:------:|
| Pengajuan Cuti | ✅ |
| Daftar Cuti (Karyawan) | ✅ |
| Approval HR | ✅ |
| Cetak PDF | ⏳ (Next milestone) |

> _Milestone: Sistem cuti internal (input → review → approval) resmi stabil dan siap menuju tahap ekspor PDF._ 🚀


---

## [v0.4.1] — 26 Oktober 2025
### ✨ Fitur Baru
- Penambahan halaman **Daftar Pengajuan Cuti Saya** untuk karyawan.
- Data pengajuan otomatis ditarik dari tabel `cuti` berdasarkan `user_id`.
- Menampilkan status pengajuan (Menunggu / Disetujui / Ditolak) dengan warna berbeda.

### 🎨 UI & UX
- Penambahan tabel dinamis dengan Tailwind.
- Tombol **+ Ajukan Cuti Baru** di bagian bawah daftar.

---

## [v0.4.0] — 26 Oktober 2025
### 🚀 Fitur Baru
- Fitur **Pengajuan Cuti (MVP)** aktif:
  - Form input tanggal mulai, tanggal selesai, alasan, bukti (opsional), dan karyawan pengganti.
  - Data tersimpan di tabel `cuti` dengan status default **menunggu**.
  - Validasi form berjalan penuh.
  - Upload file bukti otomatis tersimpan di folder `storage/app/public/bukti_cuti/`.

### 🧱 Perubahan Struktural
- Pembuatan tabel baru `cuti` (relasi ke `users`).
- Penambahan model `Cuti` dan controller `CutiController`.
- Pembuatan view `resources/views/karyawan/cuti/create.blade.php`.

### ✅ Flow Lengkap
| Langkah | Hasil |
|----------|--------|
| Karyawan isi form cuti | Data tersimpan ke DB |
| Redirect ke dashboard | Flash message muncul |
| HR login | (Tahap berikutnya) |

> _Milestone besar: sistem pengajuan cuti pertama versi Laravel 12 + Tailwind v4 berhasil berjalan penuh._

---

## [v0.3.0] — 26 Oktober 2025
### 🚀 Fitur Baru
- Penyelesaian penuh sistem **Autentikasi & Role**:
  - Login & register berbasis **Laravel Breeze** berjalan stabil.
  - **RoleMiddleware** aktif untuk membedakan akses `hr` dan `karyawan`.
  - Otomatis redirect ke dashboard sesuai role:
    - HR → `/hr/dashboard`
    - Karyawan → `/karyawan/dashboard`
  - **Default role** otomatis diatur menjadi `karyawan` saat registrasi.
- Penambahan **layout dashboard terpisah** antara HR dan Karyawan.
- Perbaikan **layout Breeze** agar slot konten muncul normal (hilangnya teks “Selamat Datang” terselesaikan).
- Penonaktifan sementara link **Profile** di navbar untuk menghindari error `Route [profile.edit] not defined`.

---

### 🧱 Perubahan Struktural
- Penyempurnaan konfigurasi middleware di `bootstrap/app.php`:

  ```php
  $middleware->alias([
      'role' => \App\Http\Middleware\RoleMiddleware::class,
  ]);
  ```

- Penambahan `role` pada `$fillable` model `User` agar mass assignment berfungsi.
- Update file `app/Http/Controllers/Auth/RegisteredUserController.php`:

  ```php
  $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => 'karyawan', // default role untuk user baru
  ]);
  ```

- Pembaruan rute universal `/dashboard` untuk redirect dinamis sesuai role.
- Pembaruan struktur folder view:

  ```text
  resources/views/
  ├── hr/dashboard.blade.php
  ├── karyawan/dashboard.blade.php
  ├── components/app-layout.blade.php
  └── layouts/app.blade.php
  ```

---

### 🧩 Fixes
- ✅ Mengatasi error `Route [profile.edit] not defined`.
- ✅ Mengatasi error `Route [dashboard] not defined`.
- ✅ Menormalkan layout slot yang sempat menyebabkan konten tidak tampil.
- ✅ Menyelaraskan navigasi Breeze dengan sistem role baru.

---

### 📈 Progress Proyek
| Tahap | Status |
|--------|:--:|
| Setup Laravel 12 + Tailwind v4 | ✅ |
| Auth 2 Role (HR & Karyawan) | ✅ |
| Pengajuan Cuti | ⏳ |
| Approval HR | ⏳ |
| Cetak PDF Surat Cuti | ⏳ |
| Dashboard Statistik | ⏳ |

> _Milestone besar: Sistem autentikasi dan pemisahan dashboard berdasarkan role kini sepenuhnya stabil._  
> _Next target: Form Pengajuan Cuti (MVP)._ 🏗️

---

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
```
---

**Status**: Stable milestone setelah debugging Breeze & layout conflict
**Next Target**: Form Pengajuan Cuti (MVP) 🚀

---

## [0.1.0] 2025-10-25
### 🚀 Initial Commit
- Inisiasi proyek baru dengan nama **personalia-ekafarm-prod**
- Instalasi Laravel 12
- Instalasi Tailwind CSS v4 (tanpa konfigurasi manual)
- Setup environment lokal & Vite build
- Commit & push awal ke GitHub
