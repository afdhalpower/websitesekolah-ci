-- db/migration_spp.sql
-- Biaya Pendidikan (SPP) Management Migration
-- Run: mysql -u sekolah -psekolah123 javawebmedia_sekolah < db/migration_spp.sql

-- 1. Tabel biaya (master tarif)
CREATE TABLE IF NOT EXISTS biaya (
    id_biaya INT AUTO_INCREMENT PRIMARY KEY,
    id_jenjang INT NOT NULL,
    nama_biaya VARCHAR(200) NOT NULL,
    nominal DECIMAL(12,0) NOT NULL,
    periode ENUM('Bulanan','Tahunan') NOT NULL DEFAULT 'Bulanan',
    tahun_mulai YEAR NOT NULL,
    tahun_selesai YEAR DEFAULT NULL,
    status ENUM('Aktif','Non Aktif') NOT NULL DEFAULT 'Aktif',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_jenjang) REFERENCES jenjang(id_jenjang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel tagihan (generated per siswa per bulan)
CREATE TABLE IF NOT EXISTS tagihan (
    id_tagihan INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT NOT NULL,
    id_biaya INT NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel log_pembayaran (audit trail)
CREATE TABLE IF NOT EXISTS log_pembayaran (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_tagihan INT NOT NULL,
    aksi ENUM('Bayar','Verifikasi','Batal') NOT NULL,
    keterangan TEXT,
    admin VARCHAR(50) NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tagihan) REFERENCES tagihan(id_tagihan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Alter siswa — tambah last_tagihan_gen
ALTER TABLE siswa ADD COLUMN last_tagihan_gen DATE DEFAULT NULL;
