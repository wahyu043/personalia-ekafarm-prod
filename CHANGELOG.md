# 🧾 CHANGELOG — Personalia Ekafarm PROD

## [v0.5.5] - 14 Februari 2026

### Ditambahkan
- Perhitungan cuti realistis menggunakan field `jumlah_hari`.
- Otomatis menghitung jumlah hari cuti berdasarkan rentang tanggal (`tanggal_mulai` → `tanggal_selesai`).
- Konfirmasi alur approval berlapis berjalan normal:
  - staff → menunggu_atasan
  - atasan → menunggu_hr
  - hr → disetujui / ditolak
- Statistik dashboard kini menghitung total hari cuti yang disetujui menggunakan `SUM(jumlah_hari)`.

### Diubah
- Logika pengurangan cuti dari sebelumnya menggunakan `count()` menjadi `sum('jumlah_hari')`.
- Method `User::cutiTerpakai()` diperbarui agar menghitung total hari cuti yang benar-benar disetujui.
- `CutiController@store` kini menyimpan nilai `jumlah_hari` hasil perhitungan.
- Menambahkan `jumlah_hari` ke `$fillable` pada model `Cuti` untuk mengatasi masalah mass assignment.

### Diperbaiki
- Bug pengurangan cuti yang sebelumnya hanya mengurangi 1 hari per pengajuan.
- Sinkronisasi statistik dashboard dengan alur approval.

### Telah Diuji
- Staff mengajukan cuti → Atasan approve → HR approve.
- Sisa cuti berkurang sesuai jumlah hari.
- Pengajuan ditolak tidak mengurangi sisa cuti.

---

## [v0.5.4] — 2 Januari 2026

### 🧩 Implementasi Workflow Cuti Berlapis & Dashboard Role-Based

#### ✨ Perubahan Utama

- Implementasi **alur persetujuan cuti berlapis**:
    - Staff → SPV (Atasan Divisi) → HR (Final Approval).
- Status cuti kini merepresentasikan tahapan approval secara nyata:
    - `menunggu_atasan`
    - `menunggu_hr`
    - `disetujui`
    - `ditolak`
- Sisa cuti karyawan **baru berkurang setelah disetujui HR**.

#### 🧭 Role & Hak Akses

- Penambahan role baru:
    - `atasan` → Supervisor / SPV berbasis divisi.
- Akun atasan menggunakan **akun jabatan (job-based account)**, bukan personal.
- Login tetap berbasis **NIP (lowercase)** untuk konsistensi & keamanan.
- Atasan wajib memiliki representasi data di tabel `karyawan` untuk kebutuhan divisi & approval.

#### 📊 Dashboard & UI

- Dashboard **SPV/Atasan**:
    - Menampilkan jumlah pengajuan cuti yang menunggu persetujuan berdasarkan divisi.
    - Akses khusus ke daftar pengajuan cuti divisi masing-masing.
- Dashboard **HR**:
    - Ringkasan status pengajuan (Menunggu HR, Disetujui, Ditolak).
    - Tampilan approval difokuskan pada aksi cepat (Setujui / Tolak).
    - Pengajuan otomatis hilang dari daftar “Menunggu HR” setelah diproses (UX sesuai workflow nyata).

#### 🔐 Keamanan & Isolasi Data

- Validasi ketat berbasis divisi untuk mencegah kebocoran data antar divisi.
- SPV hanya dapat melihat dan memproses cuti dari divisi yang sama.
- HR memiliki visibilitas penuh lintas divisi.

#### 🧠 Catatan Teknis

- Relasi `User → Karyawan` berbasis **NIP** digunakan sebagai fondasi seluruh logic approval.
- Penanganan error null-safe ditambahkan untuk akun non-karyawan (HR).
- Penyempurnaan query Eloquent untuk approval berbasis role & divisi.
- Sistem dinyatakan **stabil** untuk kebutuhan operasional internal sebelum fitur PDF.

#### ✅ Dampak

- Alur pengajuan cuti kini menyerupai proses HR nyata di internal kantor.
- Beban kerja HR & atasan lebih terstruktur dan mudah dipantau.
- Fondasi siap untuk pengembangan lanjutan:
    - Audit trail approval
    - Export PDF surat cuti
    - Penambahan layer approval (Manager)

## [v0.5.3] — 30 Desember 2025

### 🔐 Refactor Autentikasi & Sinkronisasi Data Karyawan

#### ✨ Perubahan Utama

- Sistem login **resmi beralih dari email ke NIP** sebagai kredensial utama.
- Seluruh akun user kini **dibangkitkan dari master data karyawan**, bukan data dummy.
- Default password internal diubah dan terenkripsi bcrypt.

#### 🧱 Refactor Struktural

- Standarisasi role sistem:
    - `staff` → seluruh karyawan
    - `hr` → Human Resource
- Penyesuaian middleware `role` dan routing agar konsisten dengan role baru (`staff` menggantikan `karyawan`).
- Perbaikan logic redirect dashboard pasca-login agar selaras dengan role aktual di database.
- Penghapusan ketergantungan pada akun dummy / legacy user.

#### 🔄 Sinkronisasi Data

- Seeder internal dijalankan untuk:
    - Mengisi tabel `users` dari tabel `karyawan`.
    - Menyatukan autentikasi dan data HR melalui relasi berbasis **NIP**.
- Seluruh user kini dapat login menggunakan **NIP + password default**.

#### 🧠 Catatan Teknis

- Update password massal dilakukan melalui Laravel Tinker (`Hash::make`) untuk menjaga keamanan.
- Issue **403 Forbidden** pada dashboard staff berhasil diselesaikan (root cause: role mismatch).
- Autentikasi dan role system dinyatakan **stabil & terkunci** sebagai fondasi fitur HR lanjutan.

#### ✅ Dampak

- Login internal kini lebih realistis untuk kebutuhan kantor (tanpa email personal).
- Data karyawan menjadi **single source of truth** untuk autentikasi & hak akses.
- Sistem siap masuk ke tahap **validasi cuti berbasis masa kerja**.

## [v0.5.2] — 17 Desember 2025

### 🛠 Stabilitas Modal & Alpine.js (FOUC Fix)

#### 🔧 Perbaikan

- Perbaikan **modal konfirmasi (hapus & reset password)** yang sempat:
    - muncul sesaat saat halaman dimuat (_FOUC / flash of modal_),
    - atau terlihat seperti render ganda.
- Akar masalah ditemukan pada **inisialisasi Alpine.js yang berjalan sebelum DOM siap**.

#### 🔄 Perubahan Teknis

- Inisialisasi Alpine.js dipindahkan ke dalam event `DOMContentLoaded`:

    ```js
    document.addEventListener("DOMContentLoaded", () => {
        Alpine.start();
    });
    ```

- Penempatan ulang atribut x-cloak pada root komponen modal agar bekerja optimal.
- Rebuild asset front-end untuk memastikan sinkronisasi CSS dan JavaScript.

#### 🎨 Dampak UI/UX

- Modal tidak lagi muncul saat page load.
- Overlay tidak pernah tampil tanpa interaksi user.
- Navigasi halaman HR (Data Karyawan & Semua Pengajuan) menjadi lebih stabil dan bersih secara visual.

#### 🧠 Catatan

- Isu ini dikategorikan sebagai FOUC (Flash of Uninitialized Content).
- Solusi bersifat production-safe dan direkomendasikan untuk seluruh komponen berbasis Alpine.js.

---

## [v0.5.1] — 11 November 2025

### 🧭 Stabilitas Dashboard & Role System

#### ✨ Penambahan

- Penyesuaian desain layout halaman **login Breeze** agar selaras dengan tone warna **Ekafarm**:
    - Hijau daun `#6da54e` dan hijau tua `#4c6647` sebagai warna utama.
    - Tata letak dua kolom responsif (form & visual).
- Penambahan tampilan tanggal otomatis di header dashboard karyawan (`{{ now()->format('l, d M Y') }}`).
- Penyesuaian layout header profil (`justify-between`) agar avatar, nama, dan tanggal sejajar rapi di mode terang maupun gelap.

#### 🔧 Perbaikan

- **Dashboard Karyawan:** kini sepenuhnya **menampilkan data dinamis dari database**, meliputi:
    - Statistik pengajuan cuti (Menunggu, Disetujui, Ditolak, Sisa Cuti).
    - Riwayat pengajuan terakhir (5 data terbaru) berdasarkan `Auth::id()`.
- **Router System:** perbaikan struktur dan pembagian route menjadi dua role utama:
    - `HR` → akses penuh manajemen cuti & karyawan.
    - `Karyawan` → akses pengajuan dan riwayat pribadi.
- **Middleware Role:** revisi konfigurasi `bootstrap/app.php` agar alias `role` terdaftar dan berjalan stabil.

#### 🎨 UI/UX Enhancement

- Penataan ulang komponen header profil dengan `flex justify-between` agar elemen sejajar.
- Penambahan badge tanggal dinamis di pojok kanan header (dengan warna adaptif `dark:bg-[#9dcd5a]/30`).
- Penyesuaian warna tombol dan teks di seluruh halaman login dan dashboard agar konsisten dengan identitas visual Ekafarm.

#### ✅ Hasil Akhir

> _Sistem Personalia Ekafarm kini memiliki login yang selaras dengan brand identity, dashboard karyawan dinamis penuh, dan pembagian akses dua role (HR & Karyawan) yang stabil._  
> _Milestone ini menandai berakhirnya fase pengembangan inti dan siap menuju versi 0.6.0 dengan fitur reset password dan pengembangan lanjut._

---

## [v0.5.0] — 10 November 2025

### 🧾 Final Layout Surat Cuti (PDF Formal + UI/UX Fix HR Table)

#### ✨ Peningkatan Fitur

- **Surat Cuti (PDF):**

    - Penambahan **kotak “Karyawan Pengganti”** di bawah status pengajuan, lengkap dengan area tanda tangan manual.
    - Penambahan **kotak “Catatan Manajer / SPV”** selebar margin halaman untuk penulisan manual di surat fisik.
    - Perbaikan layout tanda tangan menjadi **1 baris sejajar** (Pemohon | HR | Manajer/SPV) menggunakan tabel HTML agar stabil di DomPDF.
    - Margin, padding, dan font sudah diatur agar proporsional saat dicetak kertas A4.

- **Tampilan HR Dashboard – Daftar Pengajuan Cuti:**
    - Tombol **“Cetak PDF”** kini **sejajar horizontal** dengan dropdown status dan tombol Simpan.
    - Layout kolom aksi diperbaiki dengan sistem **flexbox** (`flex items-center gap-2`).
    - Tombol tampil dinamis hanya pada status _Disetujui_ untuk menjaga alur workflow HR.

#### 🎨 UI/UX Enhancement

- Jarak antar tombol dan dropdown kini proporsional, tidak saling tumpang tindih.
- Tampilan dark mode tetap konsisten di seluruh kolom aksi.
- Desain surat PDF kini menyerupai format dokumen HR resmi — formal, ringkas, dan mudah dibaca.

#### ✅ Hasil Akhir

> _Surat cuti kini memiliki tampilan final profesional dengan area tanda tangan dan catatan manual._  
> _Tampilan HR dashboard juga lebih rapi dan responsif dengan tombol aksi sejajar._

---

### 🧩 Struktur yang Terpengaruh

```text
resources/views/hr/cuti/index.blade.php
resources/views/pdf/cuti.blade.php
```

---

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

- **Konsistensi Desain:** seluruh tombol aksi (Edit, Reset, Hapus) kini menggunakan gaya _badge-border_ seragam seperti status cuti.
- **Dark Mode:** setiap elemen tabel telah menyesuaikan warna teks dan latar belakang agar kontras seimbang di mode gelap.
- **Componentization:** tombol konfirmasi dipecah menjadi komponen Blade untuk kemudahan reuse di modul lain.

#### ✅ Hasil Akhir

Sistem CRUD Data Karyawan oleh HR telah lengkap, fungsional, dan tampil konsisten dengan modul Cuti.  
Fitur tambahan _Super Reset Password_ menambah fleksibilitas tanpa mengorbankan keamanan.

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

> _Semua tampilan kini responsif, bersih, dan memiliki keseragaman gaya di mode terang maupun gelap._ >_CRUD Karyawan dan dashboard HR tampil konsisten tanpa konflik warna atau duplikasi style._

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

> _HR kini bisa mengelola seluruh data karyawan dari dashboard tanpa akses database manual._ > _CRUD berjalan penuh, dengan validasi, flash message, dan tampilan seragam di seluruh sistem._

---

## [v0.4.5] — 2–3 November 2025

### 🧑‍💼 HR Dashboard & Global Table Style

#### 🚀 Fitur Baru

- **Dashboard HR aktif** di `/hr/dashboard`
    - Menampilkan _ringkasan global_: total karyawan, total cuti, menunggu, disetujui, ditolak.
    - Data dinamis ditarik dari model `User` dan `Cuti`.
    - Menampilkan tabel _“Pengajuan Cuti Terbaru”_ (limit 5 data terakhir dari semua karyawan).
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
    ```

---

### Refactor layout global x-app-layout:

- Slot header dihapus (karena layout modern sudah pakai grid global).
- Penyesuaian gaya warna agar seragam dengan brand Ekafarm.

| Fitur                |        Status         |
| -------------------- | :-------------------: |
| Dashboard HR         |          ✅           |
| Global Table Styling |          ✅           |
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
- Perapian dark mode otomatis, penghapusan tombol manual _dark toggle_.
- Border tabel adaptif (`border-black/70 dark:border-white/80`).
- Hover tabel lembut `hover:bg-[#9dcd5a]/10`.

### 🧩 Komponen Baru

- `components/confirm-modal.blade.php` → modal konfirmasi dengan animasi `x-transition`.
- `components/alert.blade.php` → flash global layout.
- `partials/dashboard-summary.blade.php` → ringkasan statistik cuti.
- Tombol `Simpan/Batal` diseragamkan gaya warnanya (hijau daun Ekafarm).

### 📊 Dashboard HR & Karyawan

- Penyatuan gaya tabel dan badge status (`Menunggu`, `Disetujui`, `Ditolak`).
- Warna status adaptif mode gelap (dark:bg-\*/20 + border lembut).
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

| Fitur                  |       Status        |
| ---------------------- | :-----------------: |
| Pengajuan Cuti         |         ✅          |
| Daftar Cuti (Karyawan) |         ✅          |
| Approval HR            |         ✅          |
| Cetak PDF              | ⏳ (Next milestone) |

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

| Langkah                | Hasil                |
| ---------------------- | -------------------- |
| Karyawan isi form cuti | Data tersimpan ke DB |
| Redirect ke dashboard  | Flash message muncul |
| HR login               | (Tahap berikutnya)   |

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

| Tahap                          | Status |
| ------------------------------ | :----: |
| Setup Laravel 12 + Tailwind v4 |   ✅   |
| Auth 2 Role (HR & Karyawan)    |   ✅   |
| Pengajuan Cuti                 |   ⏳   |
| Approval HR                    |   ⏳   |
| Cetak PDF Surat Cuti           |   ⏳   |
| Dashboard Statistik            |   ⏳   |

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
