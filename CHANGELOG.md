# 🧾 CHANGELOG — Personalia Ekafarm PROD

## [v0.6.2] - 6 Agustus 2026

### Ditambahkan
- Histori & ringkasan approval cuti untuk atasan.

### Diperbaiki
- Toast error saat sisa cuti tidak mencukupi.

---

## [v0.6.1] - 13–15 Juni 2026

### Diubah
- Sederhanakan eksposur role di manajemen karyawan (HR).
- Hapus dark mode dari seluruh file blade aktif.

### Diperbaiki
- Rapikan tampilan tombol Hapus.

### Ditambahkan
- Dukungan role baru: SPV-GUD.

---

## [v0.6.0] - 9 Juni 2026

### Ditambahkan
- Tabel `holidays` + seeder hari libur nasional 2025-2026.
- Perhitungan hari kerja otomatis (exclude weekend & hari libur nasional).
- Jatah cuti dinamis 12/14 hari berdasarkan masa kerja karyawan.
- Tombol cetak PDF surat cuti.
- Section cuti disetujui di halaman manajemen cuti HR.
- Kop surat, alamat, nomor telepon, dan nomor surat otomatis di template PDF cuti.

---

## [v0.5.4] - 6 Juni 2026

### Diubah
- Refactor data karyawan.

### Diperbaiki
- Bug CRUD data karyawan.

---

## [v0.5.3] - 14 Februari 2026

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

## [v0.5.2] - 28 Januari 2026

### Diubah
- Stabilisasi sistem autentikasi, dashboard berbasis role, dan navigasi sidebar.

> _Catatan: entri ini ditulis apa adanya dari commit message (`c6fd0bc`), tanpa detail teknis tambahan._

---

## [v0.5.1] - 2 Januari 2026

### 🧩 Implementasi Workflow Cuti Berlapis & Dashboard Role-Based

#### ✨ Perubahan Utama
- Implementasi **alur persetujuan cuti berlapis**: Staff → SPV (Atasan Divisi) → HR (Final Approval).
- Status cuti kini merepresentasikan tahapan approval secara nyata:
  - `menunggu_atasan`
  - `menunggu_hr`
  - `disetujui`
  - `ditolak`
- Sisa cuti karyawan **baru berkurang setelah disetujui HR**.

#### 🧭 Role & Hak Akses
- Penambahan role baru: `atasan` → Supervisor / SPV berbasis divisi.
- Akun atasan menggunakan **akun jabatan (job-based account)**, bukan personal.
- Login tetap berbasis **NIP (lowercase)** untuk konsistensi & keamanan.
- Atasan wajib memiliki representasi data di tabel `karyawan` untuk kebutuhan divisi & approval.

#### 📊 Dashboard & UI
- Dashboard **SPV/Atasan**: menampilkan jumlah pengajuan cuti menunggu persetujuan berdasarkan divisi, akses khusus daftar pengajuan divisi masing-masing.
- Dashboard **HR**: ringkasan status pengajuan (Menunggu HR, Disetujui, Ditolak), tampilan approval fokus aksi cepat (Setujui/Tolak), pengajuan otomatis hilang dari "Menunggu HR" setelah diproses.

#### 🔐 Keamanan & Isolasi Data
- Validasi ketat berbasis divisi untuk mencegah kebocoran data antar divisi.
- SPV hanya dapat melihat dan memproses cuti dari divisi yang sama.
- HR memiliki visibilitas penuh lintas divisi.

#### 🧠 Catatan Teknis
- Relasi `User → Karyawan` berbasis **NIP** digunakan sebagai fondasi seluruh logic approval.
- Penanganan error null-safe ditambahkan untuk akun non-karyawan (HR).
- Sistem dinyatakan **stabil** untuk kebutuhan operasional internal sebelum fitur PDF.

---

## [v0.5.0] - 30 Desember 2025

### 🔐 Refactor Autentikasi & Sinkronisasi Data Karyawan

#### ✨ Perubahan Utama
- Sistem login **resmi beralih dari email ke NIP** sebagai kredensial utama.
- Seluruh akun user kini **dibangkitkan dari master data karyawan**, bukan data dummy.
- Default password internal diubah dan terenkripsi bcrypt.

#### 🧱 Refactor Struktural
- Standarisasi role sistem: `staff` (seluruh karyawan), `hr` (Human Resource).
- Penyesuaian middleware `role` dan routing agar konsisten dengan role baru (`staff` menggantikan `karyawan`).
- Perbaikan logic redirect dashboard pasca-login agar selaras dengan role aktual di database.
- Penghapusan ketergantungan pada akun dummy / legacy user.

#### 🔄 Sinkronisasi Data
- Seeder internal dijalankan untuk mengisi tabel `users` dari tabel `karyawan`, menyatukan autentikasi dan data HR melalui relasi berbasis **NIP**.
- Seluruh user kini dapat login menggunakan **NIP + password default**.

#### 🧠 Catatan Teknis
- Update password massal dilakukan melalui Laravel Tinker (`Hash::make`).
- Issue **403 Forbidden** pada dashboard staff berhasil diselesaikan (root cause: role mismatch).

---

### 🧪 Eksperimen (dihentikan) — 5 Desember 2025

- Percobaan deploy ke **Render** (Dockerfile + Render blueprint).
- Tujuan awal: hosting gratis sementara sebelum deploy ke hosting kantor.
- Dihentikan setelah ditemukan proyek belum benar-benar *production ready* saat itu — lanjut deploy ke hosting kantor sesuai rencana semula.

---

## [v0.4.7] - 17 Desember 2025

### 🛠 Stabilitas Modal & Alpine.js (FOUC Fix)

#### 🔧 Perbaikan
- Perbaikan **modal konfirmasi (hapus & reset password)** yang sempat muncul sesaat saat halaman dimuat (_FOUC_) atau terlihat seperti render ganda.
- Akar masalah: inisialisasi Alpine.js berjalan sebelum DOM siap.

#### 🔄 Perubahan Teknis
- Inisialisasi Alpine.js dipindahkan ke dalam event `DOMContentLoaded`.
- Penempatan ulang atribut `x-cloak` pada root komponen modal.

---

## [v0.4.6] - 11 November 2025

### 🧭 Stabilitas Dashboard & Role System

#### ✨ Penambahan
- Penyesuaian desain layout halaman **login Breeze** agar selaras dengan tone warna **Ekafarm** (`#6da54e`, `#4c6647`).
- Penambahan tampilan tanggal otomatis di header dashboard karyawan.

#### 🔧 Perbaikan
- **Dashboard Karyawan** kini sepenuhnya menampilkan data dinamis dari database (statistik cuti + riwayat 5 pengajuan terakhir).
- **Router System**: perbaikan struktur route HR vs Karyawan.
- **Middleware Role**: revisi konfigurasi `bootstrap/app.php` agar alias `role` stabil.

---

## [v0.4.5] - 11 November 2025

### Ditambahkan
- Finalisasi Login Portal Ekafarm.

---

## [v0.4.4] - 10 November 2025

### 🧾 Final Layout Surat Cuti (PDF Formal + UI/UX Fix HR Table)

#### ✨ Peningkatan Fitur
- **Surat Cuti (PDF)**: kotak "Karyawan Pengganti" + area tanda tangan manual, kotak "Catatan Manajer/SPV", layout tanda tangan 1 baris sejajar (Pemohon | HR | Manajer/SPV).
- **HR Dashboard**: tombol "Cetak PDF" sejajar horizontal dengan dropdown status, tombol tampil dinamis hanya pada status *Disetujui*.

---

## [v0.4.3] - 10 November 2025

### 👥 Manajemen Data Karyawan (CRUD + Super Reset)

#### ✨ Penambahan
- Halaman Daftar Karyawan dengan tabel interaktif (No, Nama, NIP, Email, Role, Aksi).
- Fitur Tambah & Edit Data dengan validasi input.
- Modal Konfirmasi Penghapusan reusable `<x-confirm-delete>`.
- **Super Reset Password (HR Only)**: reset password karyawan ke default (`password123`) via modal `<x-confirm-reset>`.

---

## [v0.4.2] - 2 November 2025

### 🧑‍💼 HR Dashboard & Global Table Style

#### 🚀 Fitur Baru
- **Dashboard HR aktif** di `/hr/dashboard`: ringkasan global (total karyawan, total cuti, menunggu, disetujui, ditolak), tabel "Pengajuan Cuti Terbaru" (5 data terakhir).
- Komponen baru `components/card.blade.php` untuk statistik dashboard.

#### 💅 Global Table Style
- File `resources/css/global.css` untuk standarisasi tabel di seluruh aplikasi.

---

## [v0.4.1] - 2 November 2025

### 🎨 Konsistensi & Styling Global
- Penyatuan tone warna antar halaman (Dashboard Karyawan & Daftar Cuti).
- Sidebar hijau daun `#6da54e`, panel hijau tua transparan `#4c6647` di dark mode.
- Optimalisasi `global.css`.

---

## [v0.4.0] - 1 November 2025

### 🎨 UI/UX Consolidation
- Refactor layout global (`x-app-layout`) agar seragam di HR & Karyawan.
- Implementasi palet warna brand Ekafarm (`#4c6647`, `#6da54e`, `#9dcd5a`, `#e1d454`).
- Komponen baru: `confirm-modal.blade.php`, `alert.blade.php`, `dashboard-summary.blade.php`.

---

## [v0.3.0] - 26 Oktober 2025

### 🚀 Fitur Baru
- Penyelesaian penuh sistem **Autentikasi & Role**: login/register Breeze stabil, `RoleMiddleware` aktif (`hr` vs `karyawan`), auto-redirect dashboard sesuai role.
- Penambahan layout dashboard terpisah HR vs Karyawan.

> _Catatan: commit terpisah untuk MVP Pengajuan Cuti (sebelumnya tercatat sebagai v0.4.0–v0.4.2 di changelog lama, tanggal 26 Okt) tidak ditemukan di git history — kemungkinan ter-squash atau tidak sempat di-commit terpisah saat itu. Kerja tersebut kemungkinan sudah tercakup dalam pekerjaan v0.3.0/v0.4.0 ini._

---

## [v0.2.0] - 25 Oktober 2025

### ✨ Fitur Baru
- Integrasi **Laravel Breeze** sebagai sistem autentikasi utama.
- Penambahan **RoleMiddleware** (`role:karyawan` & `role:hr`).
- Dua dashboard dasar: `/karyawan/dashboard`, `/hr/dashboard`.

---

## [v0.1.0] - 25 Oktober 2025

### 🚀 Initial Commit
- Inisiasi proyek `personalia-ekafarm-prod`.
- Instalasi Laravel 12 + Tailwind CSS v4.
- Setup environment lokal & Vite build.
- Commit & push awal ke GitHub.