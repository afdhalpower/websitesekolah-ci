# Biaya Pendidikan (SPP) Management — Design Spec

**Date:** 2026-09-05  
**Status:** Approved  
**Project:** websitesekolah-ci (CodeIgniter 4)

---

## Overview

Sistem manajemen biaya pendidikan (SPP) untuk sekolah HAQI Learning Centre. Admin dapat mengelola tarif per jenjang, generate tagihan bulanan/tahunan per siswa, catat pembayaran manual (cash/transfer), dan melihat rekap per siswa.

## Requirements

| Aspek | Pilihan |
|-------|---------|
| Struktur biaya | Flat rate per jenjang |
| Periode | Hybrid (admin pilih bulanan/tahunan per biaya) |
| Pembayaran | Cash/transfer manual, admin input bukti |
| Laporan | Rekap per siswa (sudah/belum bayar) |
| Reminder | Tidak perlu (admin cek manual) |

## Database Schema

### Tabel `biaya`

```sql
CREATE TABLE biaya (
    id_biaya INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_jenjang INT UNSIGNED NOT NULL,
    nama_biaya VARCHAR(200) NOT NULL,
    nominal DECIMAL(12,0) NOT NULL,
    periode ENUM('Bulanan','Tahunan') NOT NULL DEFAULT 'Bulanan',
    tahun_mulai YEAR NOT NULL,
    tahun_selesai YEAR DEFAULT NULL,
    status ENUM('Aktif','Non Aktif') NOT NULL DEFAULT 'Aktif',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_jenjang) REFERENCES jenjang(id_jenjang)
);
```

### Tabel `tagihan`

```sql
CREATE TABLE tagihan (
    id_tagihan INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT UNSIGNED NOT NULL,
    id_biaya INT UNSIGNED NOT NULL,
    bulan INT NOT NULL,
    tahun YEAR NOT NULL,
    nominal_tagihan DECIMAL(12,0) NOT NULL,
    status ENUM('Belum','Lunas','Dibatalkan') NOT NULL DEFAULT 'Belum',
    tanggal_bayar DATETIME DEFAULT NULL,
    bukti_bayar VARCHAR(200) DEFAULT NULL,
    metode_bayar VARCHAR(50) DEFAULT NULL,
    keterangan TEXT,
    admin_verifikasi VARCHAR(50) DEFAULT NULL,
    tanggal_post TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
    FOREIGN KEY (id_biaya) REFERENCES biaya(id_biaya),
    UNIQUE KEY unique_tagihan (id_siswa, bulan, tahun)
);
```

### Tabel `log_pembayaran`

```sql
CREATE TABLE log_pembayaran (
    id_log INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_tagihan INT UNSIGNED NOT NULL,
    aksi ENUM('Bayar','Verifikasi','Batal') NOT NULL,
    keterangan TEXT,
    admin VARCHAR(50) NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tagihan) REFERENCES tagihan(id_tagihan)
);
```

### Alter `siswa` table

```sql
ALTER TABLE siswa ADD COLUMN last_tagihan_gen DATE DEFAULT NULL;
```

## Admin Flow

### Master Biaya

```
/admin/biaya           → List semua biaya (filter by jenjang)
/admin/biaya/tambah    → Tambah biaya (jenjang, nama, nominal, periode, tahun)
/admin/biaya/edit/{id} → Edit biaya
```

### Generate Tagihan (Bulk)

```
POST /admin/tagihan/generate
Body: { bulan, tahun, id_tahun }
```

Algorithm:
1. Query all active siswa WHERE id_tahun = tahun_ajaran
2. For each siswa:
   a. Find biaya WHERE id_jenjang = siswa.id_jenjang AND status = 'Aktif'
   b. Check duplicate: existing tagihan WHERE id_siswa + bulan + tahun?
   c. If no duplicate → INSERT tagihan
3. UPDATE siswa.last_tagihan_gen

### Input Pembayaran

```
/admin/tagihan                 → List tagihan (filter: status, kelas, bulan, tahun)
/admin/tagihan/bayar/{id}      → Form bayar:
    - Upload bukti_bayar
    - Pilih metode_bayar (Cash / Transfer)
    - Keterangan
    - Status → Lunas
    - admin_verifikasi = session username
```

### Rekap Per Siswa

```
/admin/tagihan/rekap?id_siswa={id}
```

Response:
- Tabel: Bulan | Nominal | Status | Tanggal Bayar | Bukti | Verifikasi
- Ringkasan: Total tagihan | Total dibayar | Sisa

## File Structure

```
app/Models/
├── Biaya_model.php
├── Tagihan_model.php
└── Log_pembayaran_model.php

app/Controllers/Admin/
├── Biaya.php
└── Tagihan.php

app/Views/admin/
├── biaya/
│   ├── index.php
│   ├── tambah.php
│   └── edit.php
└── tagihan/
    ├── index.php
    ├── bayar.php
    └── rekap.php

db/
└── biaya_pendidikan.sql          (migration SQL)
```

## Patterns

- All controllers extend `Admin\BaseController` (RBAC + session check already enforced)
- All views use `esc()` for output escaping
- All forms include `csrf_field()` (CSRF filter active)
- All file uploads validate extension via `isAllowedType()`
- Model pattern follows existing: `protected $table`, `protected $primaryKey`, `protected $allowedFields`
- AdminLTE 3 template wrapper for all views
- SweetAlert2 for success/error notifications
- DataTables for sortable/filterable lists

## Dependencies

- Existing: `siswa`, `kelas`, `jenjang`, `rombel`, `tahun`, `periode` tables
- Existing: `Admin\BaseController` with `checklogin()` RBAC
- No external packages needed — pure CI4 + existing template
