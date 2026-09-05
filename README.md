# 🏫 Websitesekolah — Website Profil & Manajemen Sekolah

Sistem informasi profil dan manajemen sekolah berbasis web, dibangun dengan CodeIgniter 4 Framework. Dikembangkan oleh [Java Web Media](https://javawebmedia.com/) sebagai template website sekolah yang dapat dikustomisasi.

> **Demo:** https://haqi.sch.id/

---

## 📋 Spesifikasi

| Komponen | Versi |
|----------|-------|
| CodeIgniter | 4.6.0 |
| PHP | ≥ 8.2 (tested on 8.3.6) |
| MySQL | 8.x |
| Template Admin | AdminLTE 3.2.0 |
| Template Frontend | Sandbox Bootstrap 5 Template 3.4.0 |
| Database | 51 tabel |

### PHP Extensions yang Diperlukan

- `intl`, `mbstring`, `mysqli`, `pdo_mysql`
- `gd` (untuk thumbnail otomatis)
- `json` (default aktif)

---

## ✨ Fitur

### Frontend (Publik)

| # | Fitur |
|---|-------|
| 1 | Halaman Beranda / Homepage |
| 2 | Banner & Slider |
| 3 | Berita (Pengumuman, Updates, Indeks) |
| 4 | Profil Sekolah (Staff, Sejarah, Layanan) |
| 5 | Karya & Portfolio |
| 6 | Galeri Gambar & Video |
| 7 | Download File |
| 8 | Tautan / Link Terkait |
| 9 | Halaman Kontak |
| 10 | Floating WhatsApp Button |
| 11 | Login & Pendaftaran Siswa/Calon Siswa |

### Backend (Admin Panel)

| # | Fitur |
|---|-------|
| 1 | Dashboard & Statistik |
| 2 | Kelola Profil & Ganti Password |
| 3 | Kelola Berita & Kategori |
| 4 | Kelola Galeri, Banner & Kategori |
| 5 | Kelola Staff & Team |
| 6 | Kelola Prestasi & Penghargaan |
| 7 | Kelola Event & Agenda |
| 8 | Kelola Upload/Download File |
| 9 | Kelola Video YouTube |
| 10 | Kelola Karya & Portfolio |
| 11 | Kelola Fasilitas & Ekstrakurikuler |
| 12 | Manajemen Siswa (Rombel, Tahun Ajaran, Kelas) |
| 13 | Kelola Mitra / Client |
| 14 | Master Data (Jenjang, Agama, Pekerjaan, dll) |
| 15 | Kelola Menu Navigasi |
| 16 | Kelola Pengguna Sistem |
| 17 | Konfigurasi Website (Logo, Email, SEO, Sekolah) |
| 18 | Pendaftaran Siswa Baru (PSB) |

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/afdhalpower/websitesekolah-ci.git
cd websitesekolah-ci
```

### 2. Import Database

```bash
mysql -u root -p -e "CREATE DATABASE javawebmedia_sekolah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p javawebmedia_sekolah < db/javawebmedia_sekolah.sql
```

### 3. Konfigurasi `.env`

```env
CI_ENVIRONMENT = production
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = javawebmedia_sekolah
database.default.username = root
database.default.password = yourpassword
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 4. Jalankan Server

```bash
# Menggunakan PHP built-in server + router untuk local dev
php -S 0.0.0.0:8080 dev-router.php
```

> **Catatan:** Router `dev-router.php` diperlukan karena struktur proyek ini menempatkan folder `assets/` (upload files) di level project root, bukan di dalam `public/`. Router ini melayani file statis dari root sekaligus routing ke CI4 front controller.

### 5. Akses Website

| URL | Keterangan |
|-----|-----------|
| `http://localhost:8080/` | Halaman depan |
| `http://localhost:8080/login` | Login Admin |
| `http://localhost:8080/signin` | Login Siswa/Pendaftar |

---

## 🔐 Kredensial Default

> ⚠️ **Ganti segera** sebelum deploy ke produksi!

### Admin

| Username | Password | Level |
|----------|----------|-------|
| `andoyo` | `andoyo` | Admin |
| `auliana` | `auliana` | Admin |

### Guru

| Username | Password | Level |
|----------|----------|-------|
| `eflita` | `eflita` | Guru |
| `siti` | `siti` | Guru |
| `fitriaryati` | `fitriaryati` | Guru |
| `okky` | `okky` | Guru |

### Lainnya

| Username | Password | Level |
|----------|----------|-------|
| `rima` | `rima` | User |

> **Catatan:** Password default = username. Semua password lama di-hash dengan SHA1; login pertama kali akan otomatis di-upgrade ke bcrypt.

---

## 🛡️ Keamanan

Proyek ini telah mengalami hardening keamanan menyeluruh (branch `fix/security-hardening`). Berikut ringkasan penguatan yang diterapkan:

| Temuan | Severity | Status |
|--------|----------|--------|
| Unrestricted file upload → RCE | 🔴 Critical | ✅ Fixed |
| Stored XSS via unescaped output | 🔴 Critical | ✅ Fixed |
| CSRF protection dimatikan | 🟠 High | ✅ Fixed |
| Tidak ada Role-Based Access Control | 🟠 High | ✅ Fixed |
| Reflected XSS di search admin | 🟠 High | ✅ Fixed |
| Tidak ada brute force protection | 🟡 Medium | ✅ Fixed |
| Password hash SHA1 tanpa salt | 🟡 Medium | ✅ Fixed |
| Security headers tidak ada | 🟡 Medium | ✅ Fixed |
| Password validation bug (&&→‖) | 🔵 Low | ✅ Fixed |
| Debug mode aktif | 🔵 Low | ✅ Fixed |
| Open redirect via $_GET | 🔵 Low | ✅ Fixed |

**Detail penemuan dan exploit PoC:** lihat [`PENTEST-REPORT.md`](PENTEST-REPORT.md)

### Yang Telah Diperkuat

- **Upload Validation** — Semua 72 upload handler memvalidasi ekstensi file (whitelist gambar/dokumen) + ukuran maksimal 5MB
- **CSRF Protection** — Filter CSRF dan Honeypot aktif di semua route
- **RBAC** — Hanya user level `Admin` yang bisa mengakses panel admin
- **Brute Force Protection** — Maksimal 5 percobaan login per 5 menit per username
- **Password Hashing** — bcrypt dengan auto-upgrade dari SHA1 legacy
- **Output Escaping** — 157+ view files menggunakan `esc()` untuk mencegah XSS
- **Security Headers** — `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `X-XSS-Protection`

---

## 📁 Struktur Projek

```
websitesekolah-ci/
├── app/
│   ├── Config/          # Konfigurasi (Database, Routes, Filters, Session)
│   ├── Controllers/     # Controller aplikasi
│   │   ├── Admin/       # Panel administrator
│   │   ├── Siswa/       # Panel siswa
│   │   └── Client/      # Panel client
│   ├── Libraries/       # Custom libraries (Simple_login, Website)
│   ├── Models/          # Model database
│   ├── Views/           # Template view
│   │   ├── admin/       # Views admin panel
│   │   ├── home/        # Views halaman depan
│   │   ├── layout/      # Layout template
│   │   └── siswa/       # Views panel siswa
│   └── Helpers/         # Custom helpers
├── assets/              # Aset statis + upload files
│   ├── admin/           # Plugin admin (FontAwesome, DataTables, SweetAlert)
│   ├── template/        # Template frontend (CSS, JS, fonts)
│   ├── upload/          # File upload (gambar, dokumen, pendaftaran, staff)
│   ├── css/             # Custom CSS
│   └── jquery-ui/       # jQuery UI
├── db/
│   └── javawebmedia_sekolah.sql  # Database dump
├── public/              # Public directory (CI4 front controller)
├── system/              # CodeIgniter 4 framework
├── vendor/              # Composer dependencies
├── writable/            # Cache, logs, session, uploads
├── dev-router.php       # Local dev router (serves assets from root)
├── PENTEST-REPORT.md    # Security assessment report
├── .env                 # Environment configuration
└── spark                # CI4 CLI tool
```

---

## 🛠️ Development

### Server Requirements

- PHP ≥ 8.2 dengan ekstensi: intl, mbstring, mysqli, pdo_mysql, gd
- MySQL ≥ 5.7 atau MariaDB ≥ 10.4
- Composer

### Local Development

```bash
# Install dependencies
composer install

# Setup database
mysql -u root -p -e "CREATE DATABASE javawebmedia_sekolah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p javawebmedia_sekolah < db/javawebmedia_sekolah.sql

# Copy dan edit .env
cp env .env
# Edit .env sesuai konfigurasi database Anda

# Jalankan server
php -S 0.0.0.0:8080 dev-router.php
```

### Struktur Authentication

| Endpoint | Akses | Keterangan |
|----------|-------|-----------|
| `/login` | Admin | Panel administrator |
| `/signin` | Siswa | Login siswa & calon siswa |
| `/admin/*` | Admin | Hanya level Admin (RBAC) |
| `/siswa/*` | Siswa | Panel siswa |
| `/client/*` | Client | Panel client |

---

## ⚠️ Catatan Penting

1. **Login Admin** menggunakan `/login` (bukan `/signin` — itu untuk siswa)
2. **File upload** berada di `assets/upload/` (level project root, bukan `public/`)
3. **Router** `dev-router.php` hanya untuk development. Di produksi, gunakan Apache/Nginx dengan document root yang benar
4. **Password admin** harus diganti setelah instalasi
5. **CI_ENVIRONMENT** harus `production` di server production

---

## 📄 License

Lihat [LICENSE](LICENSE) untuk informasi lisensi.

---

## 🙏 Credits

- [Java Web Media](https://javawebmedia.com/) — Developer asli
- [CodeIgniter 4](https://codeigniter.com) — Framework
- [AdminLTE 3](https://adminlte.io/) — Admin template
- [Sandbox Template](https://sandbox.elemisthemes.com/) — Frontend template
