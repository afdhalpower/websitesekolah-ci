-- db/seed_data.sql
-- Seed data: kelas, tahun ajaran, siswa dummy, biaya pendidikan
-- Run: mysql -u sekolah -psekolah123 javawebmedia_sekolah < db/seed_data.sql

-- 1. Tahun Ajaran 2026/2027
INSERT INTO tahun (id_user, nama_tahun, tahun_mulai, tahun_selesai, keterangan) VALUES
(1, 'Tahun Ajaran 2026/2027', 2026, 2027, 'Tahun Ajaran 2026/2027');

SET @id_tahun = LAST_INSERT_ID();

-- 2. Kelas untuk PAUD, TK A, TK B
INSERT INTO kelas (id_user, id_jenjang, nama_kelas, status_kelas, keterangan, urutan) VALUES
(1, 1, 'PAUD A', 'Aktif', 'PAUD Kelas A', 1),
(1, 1, 'PAUD B', 'Aktif', 'PAUD Kelas B', 2),
(1, 2, 'TK A-1', 'Aktif', 'TK A Kelas 1', 3),
(1, 2, 'TK A-2', 'Aktif', 'TK A Kelas 2', 4),
(1, 3, 'TK B-1', 'Aktif', 'TK B Kelas 1', 5),
(1, 3, 'TK B-2', 'Aktif', 'TK B Kelas 2', 6);

-- 3. Biaya pendidikan per jenjang
INSERT INTO biaya (id_jenjang, nama_biaya, nominal, periode, tahun_mulai, status) VALUES
(1, 'SPP Bulanan PAUD', 300000, 'Bulanan', 2026, 'Aktif'),
(2, 'SPP Bulanan TK A', 400000, 'Bulanan', 2026, 'Aktif'),
(3, 'SPP Bulanan TK B', 450000, 'Bulanan', 2026, 'Aktif'),
(1, 'Uang Tahunan PAUD', 1500000, 'Tahunan', 2026, 'Aktif'),
(2, 'Uang Tahunan TK A', 2000000, 'Tahunan', 2026, 'Aktif'),
(3, 'Uang Tahunan TK B', 2200000, 'Tahunan', 2026, 'Aktif');

-- 4. Siswa dummy aktif (15 siswa)
-- PAUD A (id_kelas=3, jenjang=1)
INSERT INTO siswa (id_gelombang, id_hubungan, id_akun, id_jenjang_pendidikan, id_tahun, id_kelas, id_jenjang, nama_siswa, nis, slug_siswa, kode_siswa, jenis_kelamin, tanggal_lahir, alamat, status_siswa, status_pendaftaran, identitas_wali, tanggal_masuk, jenis_siswa, tanggal_post) VALUES
(1, 1, 0, 1, @id_tahun, 3, 1, 'AISYAH PUTRI RAMADHANI', 'PA001', 'aisyah-putri-ramadhani', 'PA001', 'P', '2021-03-15', 'Jl. Merdeka No. 10', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 1, @id_tahun, 3, 1, 'MUHAMMAD RIZKI PRATAMA', 'PA002', 'muhammad-rizki-pratama', 'PA002', 'L', '2021-01-20', 'Jl. Pahlawan No. 25', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 1, @id_tahun, 3, 1, 'FATIMAH AZ-ZAHRA', 'PA003', 'fatimah-az-zahra', 'PA003', 'P', '2020-11-05', 'Jl. Sudirman No. 8', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW());

-- PAUD B (id_kelas=4, jenjang=1)
INSERT INTO siswa (id_gelombang, id_hubungan, id_akun, id_jenjang_pendidikan, id_tahun, id_kelas, id_jenjang, nama_siswa, nis, slug_siswa, kode_siswa, jenis_kelamin, tanggal_lahir, alamat, status_siswa, status_pendaftaran, identitas_wali, tanggal_masuk, jenis_siswa, tanggal_post) VALUES
(1, 1, 0, 1, @id_tahun, 4, 1, 'HAFIZH ABDURRAHMAN', 'PA004', 'hafizh-abdurrahman', 'PA004', 'L', '2021-06-12', 'Jl. Ahmad Yani No. 3', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 1, @id_tahun, 4, 1, 'KHADIJAH NURHALIZA', 'PA005', 'khadijah-nurhaliza', 'PA005', 'P', '2020-09-28', 'Jl. Thamrin No. 17', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW());

-- TK A-1 (id_kelas=5, jenjang=2)
INSERT INTO siswa (id_gelombang, id_hubungan, id_akun, id_jenjang_pendidikan, id_tahun, id_kelas, id_jenjang, nama_siswa, nis, slug_siswa, kode_siswa, jenis_kelamin, tanggal_lahir, alamat, status_siswa, status_pendaftaran, identitas_wali, tanggal_masuk, jenis_siswa, tanggal_post) VALUES
(1, 1, 0, 2, @id_tahun, 5, 2, 'IBRAHIM MALIK HASAN', 'TK001', 'ibrahim-malik-hasan', 'TK001', 'L', '2020-04-10', 'Jl. Diponegoro No. 22', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 2, @id_tahun, 5, 2, 'MARYAM SALSABILA', 'TK002', 'maryam-salsabila', 'TK002', 'P', '2020-02-14', 'Jl. Imam Bonjol No. 5', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 2, @id_tahun, 5, 2, 'YUSUF ALFARIZI', 'TK003', 'yusuf-alfarizi', 'TK003', 'L', '2019-12-01', 'Jl. Gatot Subroto No. 9', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW());

-- TK A-2 (id_kelas=6, jenjang=2)
INSERT INTO siswa (id_gelombang, id_hubungan, id_akun, id_jenjang_pendidikan, id_tahun, id_kelas, id_jenjang, nama_siswa, nis, slug_siswa, kode_siswa, jenis_kelamin, tanggal_lahir, alamat, status_siswa, status_pendaftaran, identitas_wali, tanggal_masuk, jenis_siswa, tanggal_post) VALUES
(1, 1, 0, 2, @id_tahun, 6, 2, 'NURUL IZZAH PUTRI', 'TK004', 'nurul-izzah-putri', 'TK004', 'P', '2020-07-22', 'Jl. Hayam Wuruk No. 14', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 2, @id_tahun, 6, 2, 'AHMAD FAHRI MUBARAK', 'TK005', 'ahmad-fahri-mubarak', 'TK005', 'L', '2020-05-30', 'Jl. Veteran No. 31', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW());

-- TK B-1 (id_kelas=7, jenjang=3)
INSERT INTO siswa (id_gelombang, id_hubungan, id_akun, id_jenjang_pendidikan, id_tahun, id_kelas, id_jenjang, nama_siswa, nis, slug_siswa, kode_siswa, jenis_kelamin, tanggal_lahir, alamat, status_siswa, status_pendaftaran, identitas_wali, tanggal_masuk, jenis_siswa, tanggal_post) VALUES
(1, 1, 0, 3, @id_tahun, 7, 3, 'ZAHRA AMANDA SARI', 'TK006', 'zahra-amanda-sari', 'TK006', 'P', '2019-08-18', 'Jl. Sultan Agung No. 7', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 3, @id_tahun, 7, 3, 'IBNU SINA AKBAR', 'TK007', 'ibnu-sina-akbar', 'TK007', 'L', '2019-03-25', 'Jl. Pemuda No. 19', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 3, @id_tahun, 7, 3, 'AISHA RAHMA DEWI', 'TK008', 'aisha-rahma-dewi', 'TK008', 'P', '2019-10-09', 'Jl. Kartini No. 4', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW());

-- TK B-2 (id_kelas=8, jenjang=3)
INSERT INTO siswa (id_gelombang, id_hubungan, id_akun, id_jenjang_pendidikan, id_tahun, id_kelas, id_jenjang, nama_siswa, nis, slug_siswa, kode_siswa, jenis_kelamin, tanggal_lahir, alamat, status_siswa, status_pendaftaran, identitas_wali, tanggal_masuk, jenis_siswa, tanggal_post) VALUES
(1, 1, 0, 3, @id_tahun, 8, 3, 'UMAR FARUK HAKIM', 'TK009', 'umar-faruk-hakim', 'TK009', 'L', '2019-06-15', 'Jl. Gajah Mada No. 12', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW()),
(1, 1, 0, 3, @id_tahun, 8, 3, 'SITI NURJANNAH', 'TK010', 'siti-nurjannah', 'TK010', 'P', '2019-01-27', 'Jl. Cut Nyak Dhien No. 6', 'Aktif', 'Diterima', '-', '2026-07-01', 'Langsung', NOW());
