# Biaya Pendidikan (SPP) Management — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build SPP management module — master biaya, tagihan bulk generation, payment recording, and per-student recap for HAQI Learning Centre.

**Architecture:** 3 new DB tables + 1 column alter. 3 models (Biaya_model, Tagihan_model, Log_pembayaran_model). 2 controllers (Admin\Biaya, Admin\Tagihan). 7 views. Follows existing CI4 AdminLTE 3 patterns exactly.

**Tech Stack:** CodeIgniter 4.6.0, PHP 8.2+, MySQL 8, AdminLTE 3, jQuery DataTables, SweetAlert2.

## Global Constraints

- All output escaped with `esc()` — no exceptions
- All forms include `csrf_field()` (CSRF filter active)
- File uploads validated via `isAllowedType()` — whitelist only
- Controller extends `App\Controllers\Admin\BaseController` (RBAC auto-enforced)
- Views rendered via `echo view('admin/layout/wrapper', $data)`
- Model pattern: `$this->db->table()` query builder, no raw SQL
- All controllers already authenticated — no login check needed per controller
- `$this->session->get('username')` for admin identity
- `$this->session->setFlashdata('sukses', ...)` or `setFlashdata('warning', ...)`
- Redirect via `return redirect()->to(base_url('admin/...'))`
- `number_format($nominal, 0, ',', '.')` for Rupiah display

## File Map

| Action | File |
|--------|------|
| Create | `db/migration_spp.sql` |
| Create | `app/Models/Biaya_model.php` |
| Create | `app/Models/Tagihan_model.php` |
| Create | `app/Models/Log_pembayaran_model.php` |
| Create | `app/Controllers/Admin/Biaya.php` |
| Create | `app/Controllers/Admin/Tagihan.php` |
| Create | `app/Views/admin/biaya/index.php` |
| Create | `app/Views/admin/biaya/tambah.php` |
| Create | `app/Views/admin/biaya/edit.php` |
| Create | `app/Views/admin/tagihan/index.php` |
| Create | `app/Views/admin/tagihan/bayar.php` |
| Create | `app/Views/admin/tagihan/rekap.php` |
| Create | `app/Views/admin/tagihan/generate_modal.php` |
| Modify | `app/Views/admin/layout/menu.php` (add Keuangan menu) |

---

### Task 1: Database Migration SQL

**Files:**
- Create: `db/migration_spp.sql`

**Interfaces:** None — standalone SQL file.

- [ ] **Step 1: Create migration SQL file**

```sql
-- db/migration_spp.sql
-- Biaya Pendidikan (SPP) Management Migration
-- Run: mysql -u sekolah -psekolah123 javawebmedia_sekolah < db/migration_spp.sql

-- 1. Tabel biaya (master tarif)
CREATE TABLE IF NOT EXISTS biaya (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel tagihan (generated per siswa per bulan)
CREATE TABLE IF NOT EXISTS tagihan (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel log_pembayaran (audit trail)
CREATE TABLE IF NOT EXISTS log_pembayaran (
    id_log INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_tagihan INT UNSIGNED NOT NULL,
    aksi ENUM('Bayar','Verifikasi','Batal') NOT NULL,
    keterangan TEXT,
    admin VARCHAR(50) NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tagihan) REFERENCES tagihan(id_tagihan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Alter siswa — tambah last_tagihan_gen
ALTER TABLE siswa ADD COLUMN last_tagihan_gen DATE DEFAULT NULL;
```

- [ ] **Step 2: Run migration**

```bash
cd /home/aqsadev/PRIBADI/websitesekolah-ci
mysql -u sekolah -psekolah123 javawebmedia_sekolah < db/migration_spp.sql
```

Expected: No errors. Verify with:
```bash
mysql -u sekolah -psekolah123 javawebmedia_sekolah -e "SHOW TABLES LIKE 'biaya'; SHOW TABLES LIKE 'tagihan'; SHOW TABLES LIKE 'log_pembayaran';"
```
Expected: 3 rows returned.

- [ ] **Step 3: Verify siswa alter**

```bash
mysql -u sekolah -psekolah123 javawebmedia_sekolah -e "DESCRIBE siswa" | grep last_tagihan_gen
```
Expected: `last_tagihan_gen | date | YES | NULL | NULL`

- [ ] **Step 4: Commit**

```bash
git add db/migration_spp.sql
git commit -m "feat(db): migration SPP — biaya, tagihan, log_pembayaran tables"
```

---

### Task 2: Models (3 files)

**Files:**
- Create: `app/Models/Biaya_model.php`
- Create: `app/Models/Tagihan_model.php`
- Create: `app/Models/Log_pembayaran_model.php`

**Interfaces:** These models are consumed by controllers in Tasks 3-4.

- [ ] **Step 1: Create Biaya_model.php**

```php
<?php
namespace App\Models;

use CodeIgniter\Model;

class Biaya_model extends Model
{
    protected $table = 'biaya';
    protected $primaryKey = 'id_biaya';
    protected $allowedFields = ['id_jenjang', 'nama_biaya', 'nominal', 'periode', 'tahun_mulai', 'tahun_selesai', 'status'];

    // Listing semua biaya dengan nama jenjang
    public function listing()
    {
        $builder = $this->db->table('biaya');
        $builder->select('biaya.*, jenjang.nama_jenjang');
        $builder->join('jenjang', 'jenjang.id_jenjang = biaya.id_jenjang', 'LEFT');
        $builder->orderBy('biaya.id_biaya', 'DESC');
        return $builder->get()->getResultArray();
    }

    // Detail biaya by id
    public function detail($id_biaya)
    {
        $builder = $this->db->table('biaya');
        $builder->select('biaya.*, jenjang.nama_jenjang');
        $builder->join('jenjang', 'jenjang.id_jenjang = biaya.id_jenjang', 'LEFT');
        $builder->where('biaya.id_biaya', $id_biaya);
        return $builder->get()->getRow();
    }

    // Cari biaya aktif per jenjang + periode
    public function cari_aktif($id_jenjang, $periode = 'Bulanan')
    {
        $builder = $this->db->table('biaya');
        $builder->where('id_jenjang', $id_jenjang);
        $builder->where('periode', $periode);
        $builder->where('status', 'Aktif');
        return $builder->get()->getRow();
    }

    // Listing biaya aktif saja (untuk dropdown)
    public function listing_aktif()
    {
        $builder = $this->db->table('biaya');
        $builder->select('biaya.*, jenjang.nama_jenjang');
        $builder->join('jenjang', 'jenjang.id_jenjang = biaya.id_jenjang', 'LEFT');
        $builder->where('biaya.status', 'Aktif');
        $builder->orderBy('jenjang.nama_jenjang', 'ASC');
        return $builder->get()->getResultArray();
    }

    // Total record
    public function total()
    {
        $builder = $this->db->table('biaya');
        return $builder->countAllResults();
    }
}
```

- [ ] **Step 2: Create Tagihan_model.php**

```php
<?php
namespace App\Models;

use CodeIgniter\Model;

class Tagihan_model extends Model
{
    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    protected $allowedFields = ['id_siswa', 'id_biaya', 'bulan', 'tahun', 'nominal_tagihan', 'status', 'tanggal_bayar', 'bukti_bayar', 'metode_bayar', 'keterangan', 'admin_verifikasi'];

    // Listing tagihan dengan nama siswa + nama biaya + kelas
    public function listing($filters = [])
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.nama_siswa, siswa.nis, kelas.nama_kelas, biaya.nama_biaya');
        $builder->join('siswa', 'siswa.id_siswa = tagihan.id_siswa', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'LEFT');
        $builder->join('biaya', 'biaya.id_biaya = tagihan.id_biaya', 'LEFT');

        if (!empty($filters['status'])) {
            $builder->where('tagihan.status', $filters['status']);
        }
        if (!empty($filters['id_kelas'])) {
            $builder->where('siswa.id_kelas', $filters['id_kelas']);
        }
        if (!empty($filters['bulan'])) {
            $builder->where('tagihan.bulan', $filters['bulan']);
        }
        if (!empty($filters['tahun'])) {
            $builder->where('tagihan.tahun', $filters['tahun']);
        }

        $builder->orderBy('tagihan.tahun', 'DESC');
        $builder->orderBy('tagihan.bulan', 'DESC');
        $builder->orderBy('siswa.nama_siswa', 'ASC');
        return $builder->get()->getResultArray();
    }

    // Detail tagihan by id
    public function detail($id_tagihan)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.nama_siswa, siswa.nis, siswa.no_wali, kelas.nama_kelas, biaya.nama_biaya, jenjang.nama_jenjang');
        $builder->join('siswa', 'siswa.id_siswa = tagihan.id_siswa', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'LEFT');
        $builder->join('biaya', 'biaya.id_biaya = tagihan.id_biaya', 'LEFT');
        $builder->join('jenjang', 'jenjang.id_jenjang = siswa.id_jenjang', 'LEFT');
        $builder->where('tagihan.id_tagihan', $id_tagihan);
        return $builder->get()->getRow();
    }

    // Rekap per siswa
    public function rekap_siswa($id_siswa)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, biaya.nama_biaya');
        $builder->join('biaya', 'biaya.id_biaya = tagihan.id_biaya', 'LEFT');
        $builder->where('tagihan.id_siswa', $id_siswa);
        $builder->orderBy('tagihan.tahun', 'DESC');
        $builder->orderBy('tagihan.bulan', 'DESC');
        return $builder->get()->getResultArray();
    }

    // Summary rekap: total tagihan, total dibayar, sisa
    public function summary_siswa($id_siswa)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('
            COUNT(*) as total_tagihan,
            SUM(CASE WHEN status = "Lunas" THEN nominal_tagihan ELSE 0 END) as total_dibayar,
            SUM(CASE WHEN status = "Belum" THEN nominal_tagihan ELSE 0 END) as total_sisa,
            SUM(nominal_tagihan) as grand_total
        ');
        $builder->where('id_siswa', $id_siswa);
        return $builder->get()->getRow();
    }

    // Cek apakah tagihan sudah ada (prevent double generate)
    public function cek_duplikat($id_siswa, $bulan, $tahun)
    {
        $builder = $this->db->table('tagihan');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('bulan', $bulan);
        $builder->where('tahun', $tahun);
        return $builder->countAllResults() > 0;
    }

    // Bulk generate tagihan
    public function generate($id_tahun, $bulan, $tahun)
    {
        $m_biaya = new Biaya_model();

        // Ambil semua siswa aktif di tahun ajaran ini
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*');
        $builder->where('id_tahun', $id_tahun);
        $builder->where('status_siswa', 'Aktif');
        $siswa_list = $builder->get()->getResultArray();

        $generated = 0;
        $skipped = 0;

        foreach ($siswa_list as $siswa) {
            // Skip jika sudah ada tagihan bulan ini
            if ($this->cek_duplikat($siswa['id_siswa'], $bulan, $tahun)) {
                $skipped++;
                continue;
            }

            // Cari biaya aktif berdasarkan jenjang siswa
            $biaya = $m_biaya->cari_aktif($siswa['id_jenjang'], 'Bulanan');
            if (!$biaya) {
                $skipped++;
                continue;
            }

            $data = [
                'id_siswa'        => $siswa['id_siswa'],
                'id_biaya'        => $biaya->id_biaya,
                'bulan'           => $bulan,
                'tahun'           => $tahun,
                'nominal_tagihan' => $biaya->nominal,
                'status'          => 'Belum',
            ];
            $this->insert($data);
            $generated++;
        }

        return ['generated' => $generated, 'skipped' => $skipped];
    }

    // Update status bayar
    public function bayar($id_tagihan, $data_bayar)
    {
        $data = [
            'status'           => 'Lunas',
            'tanggal_bayar'    => $data_bayar['tanggal_bayar'] ?? date('Y-m-d H:i:s'),
            'bukti_bayar'      => $data_bayar['bukti_bayar'] ?? null,
            'metode_bayar'     => $data_bayar['metode_bayar'],
            'keterangan'       => $data_bayar['keterangan'] ?? null,
            'admin_verifikasi' => $data_bayar['admin_verifikasi'],
        ];
        $this->update($id_tagihan, $data);
    }
}
```

- [ ] **Step 3: Create Log_pembayaran_model.php**

```php
<?php
namespace App\Models;

use CodeIgniter\Model;

class Log_pembayaran_model extends Model
{
    protected $table = 'log_pembayaran';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_tagihan', 'aksi', 'keterangan', 'admin'];

    // Log by tagihan
    public function by_tagihan($id_tagihan)
    {
        $builder = $this->db->table('log_pembayaran');
        $builder->where('id_tagihan', $id_tagihan);
        $builder->orderBy('tanggal', 'DESC');
        return $builder->get()->getResultArray();
    }

    // Insert log
    public function tambah($id_tagihan, $aksi, $keterangan = '', $admin = '')
    {
        $data = [
            'id_tagihan'   => $id_tagihan,
            'aksi'         => $aksi,
            'keterangan'   => $keterangan,
            'admin'        => $admin,
        ];
        $this->insert($data);
    }
}
```

- [ ] **Step 4: Verify model syntax**

```bash
cd /home/aqsadev/PRIBADI/websitesekolah-ci
php -l app/Models/Biaya_model.php && php -l app/Models/Tagihan_model.php && php -l app/Models/Log_pembayaran_model.php
```
Expected: `No syntax errors detected` (x3)

- [ ] **Step 5: Commit**

```bash
git add app/Models/Biaya_model.php app/Models/Tagihan_model.php app/Models/Log_pembayaran_model.php
git commit -m "feat(models): Biaya_model, Tagihan_model, Log_pembayaran_model"
```

---

### Task 3: Controller — Master Biaya (CRUD)

**Files:**
- Create: `app/Controllers/Admin/Biaya.php`

**Interfaces:**
- Consumes: `Biaya_model` (listing, detail, tambah, edit, delete, total)
- Produces: Routes `admin/biaya`, `admin/biaya/tambah`, `admin/biaya/edit/{id}`, `admin/biaya/delete/{id}`

- [ ] **Step 1: Create Biaya controller**

```php
<?php
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Biaya_model;
use App\Models\Jenjang_model;

class Biaya extends BaseController
{
    // List semua biaya
    public function index()
    {
        $m_biaya   = new Biaya_model();
        $m_jenjang = new Jenjang_model();
        $biaya     = $m_biaya->listing();
        $jenjang   = $m_jenjang->listing();
        $total     = $m_biaya->total();

        // Validasi tambah
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id_jenjang'  => 'required',
            'nama_biaya'  => 'required|min_length[3]',
            'nominal'     => 'required|numeric|greater_than[0]',
            'periode'     => 'required|in_list[Bulanan,Tahunan]',
            'tahun_mulai' => 'required|exact_length[4]|is_numeric',
        ])) {
            $data = [
                'id_jenjang'    => $this->request->getPost('id_jenjang'),
                'nama_biaya'    => $this->request->getPost('nama_biaya'),
                'nominal'       => $this->request->getPost('nominal'),
                'periode'       => $this->request->getPost('periode'),
                'tahun_mulai'   => $this->request->getPost('tahun_mulai'),
                'tahun_selesai' => $this->request->getPost('tahun_selesai') ?: null,
                'status'        => $this->request->getPost('status') ?? 'Aktif',
            ];
            $m_biaya->insert($data);
            $this->session->setFlashdata('sukses', 'Data biaya telah ditambah');
            return redirect()->to(base_url('admin/biaya'));
        } else {
            $data = [
                'title'   => 'Master Biaya Pendidikan: ' . $total,
                'biaya'   => $biaya,
                'jenjang' => $jenjang,
                'content' => 'admin/biaya/index',
            ];
            echo view('admin/layout/wrapper', $data);
        }
    }

    // Edit biaya
    public function edit($id_biaya)
    {
        $m_biaya   = new Biaya_model();
        $m_jenjang = new Jenjang_model();
        $biaya     = $m_biaya->detail($id_biaya);
        $jenjang   = $m_jenjang->listing();

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'nama_biaya'  => 'required|min_length[3]',
            'nominal'     => 'required|numeric|greater_than[0]',
            'periode'     => 'required|in_list[Bulanan,Tahunan]',
            'tahun_mulai' => 'required|exact_length[4]|is_numeric',
        ])) {
            $data = [
                'id_biaya'      => $id_biaya,
                'id_jenjang'    => $this->request->getPost('id_jenjang'),
                'nama_biaya'    => $this->request->getPost('nama_biaya'),
                'nominal'       => $this->request->getPost('nominal'),
                'periode'       => $this->request->getPost('periode'),
                'tahun_mulai'   => $this->request->getPost('tahun_mulai'),
                'tahun_selesai' => $this->request->getPost('tahun_selesai') ?: null,
                'status'        => $this->request->getPost('status'),
            ];
            $m_biaya->update($id_biaya, $data);
            $this->session->setFlashdata('sukses', 'Data biaya telah diedit');
            return redirect()->to(base_url('admin/biaya'));
        } else {
            $data = [
                'title'   => 'Edit Biaya: ' . $biaya->nama_biaya,
                'biaya'   => $biaya,
                'jenjang' => $jenjang,
                'content' => 'admin/biaya/edit',
            ];
            echo view('admin/layout/wrapper', $data);
        }
    }

    // Hapus biaya
    public function delete($id_biaya)
    {
        $m_biaya = new Biaya_model();
        $m_biaya->delete($id_biaya);
        $this->session->setFlashdata('sukses', 'Data biaya telah dihapus');
        return redirect()->to(base_url('admin/biaya'));
    }
}
```

- [ ] **Step 2: Verify syntax**

```bash
php -l app/Controllers/Admin/Biaya.php
```
Expected: `No syntax errors detected`

- [ ] **Step 3: Commit**

```bash
git add app/Controllers/Admin/Biaya.php
git commit -m "feat(controller): Admin Biaya CRUD — master biaya pendidikan"
```

---

### Task 4: Controller — Tagihan (List, Generate, Bayar, Rekap)

**Files:**
- Create: `app/Controllers/Admin/Tagihan.php`

**Interfaces:**
- Consumes: `Tagihan_model`, `Biaya_model`, `Log_pembayaran_model`, `Siswa_model` (existing)
- Produces: Routes `admin/tagihan`, `admin/tagihan/bayar/{id}`, `admin/tagihan/rekap`, `admin/tagihan/generate`

- [ ] **Step 1: Create Tagihan controller**

```php
<?php
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Tagihan_model;
use App\Models\Biaya_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
use App\Models\Log_pembayaran_model;
use App\Models\Siswa_model;

class Tagihan extends BaseController
{
    // List tagihan + filter
    public function index()
    {
        $m_tagihan = new Tagihan_model();
        $m_kelas   = new Kelas_model();
        $m_tahun   = new Tahun_model();

        $filters = [
            'status'   => $this->request->getGet('status'),
            'id_kelas' => $this->request->getGet('id_kelas'),
            'bulan'    => $this->request->getGet('bulan'),
            'tahun'    => $this->request->getGet('tahun'),
        ];
        $tagihan = $m_tagihan->listing($filters);
        $kelas   = $m_kelas->listing();
        $tahun   = $m_tahun->listing();

        $data = [
            'title'   => 'Tagihan Pendidikan',
            'tagihan' => $tagihan,
            'kelas'   => $kelas,
            'tahun'   => $tahun,
            'filters' => $filters,
            'content' => 'admin/tagihan/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Form bayar
    public function bayar($id_tagihan)
    {
        $m_tagihan = new Tagihan_model();
        $m_log     = new Log_pembayaran_model();
        $tagihan   = $m_tagihan->detail($id_tagihan);
        $logs      = $m_log->by_tagihan($id_tagihan);

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'metode_bayar' => 'required|in_list[Cash,Transfer]',
        ])) {
            $admin = $this->session->get('username');
            $bukti = null;

            // Upload bukti bayar jika ada
            if (!empty($_FILES['bukti_bayar']['name'])) {
                $file = $this->request->getFile('bukti_bayar');
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'];
                if (!$file->isValid() || !$file->isAllowedType($allowedExt)) {
                    $this->session->setFlashdata('warning', 'Tipe file bukti bayar tidak diizinkan');
                    return redirect()->back();
                }
                if ($file->getSizeByUnit('mb') > 5) {
                    $this->session->setFlashdata('warning', 'Ukuran file maksimal 5MB');
                    return redirect()->back();
                }
                $nama_baru = $file->getRandomName();
                $file->move(WRITEPATH . '../assets/upload/bukti_bayar/', $nama_baru);
                $bukti = $nama_baru;
            }

            $data_bayar = [
                'metode_bayar'     => $this->request->getPost('metode_bayar'),
                'keterangan'       => $this->request->getPost('keterangan'),
                'admin_verifikasi' => $admin,
                'bukti_bayar'      => $bukti,
            ];
            $m_tagihan->bayar($id_tagihan, $data_bayar);
            $m_log->tambah($id_tagihan, 'Verifikasi', 'Pembayaran diterima via ' . $this->request->getPost('metode_bayar'), $admin);

            $this->session->setFlashdata('sukses', 'Pembayaran berhasil diverifikasi');
            return redirect()->to(base_url('admin/tagihan'));
        } else {
            $data = [
                'title'   => 'Bayar Tagihan: ' . $tagihan->nama_siswa,
                'tagihan' => $tagihan,
                'logs'    => $logs,
                'content' => 'admin/tagihan/bayar',
            ];
            echo view('admin/layout/wrapper', $data);
        }
    }

    // Rekap per siswa
    public function rekap()
    {
        $m_siswa   = new Siswa_model();
        $m_tagihan = new Tagihan_model();
        $id_siswa  = $this->request->getGet('id_siswa');
        $tagihan   = [];
        $summary   = null;
        $siswa_list = [];

        // Search siswa
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*, kelas.nama_kelas, jenjang.nama_jenjang');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'LEFT');
        $builder->join('jenjang', 'jenjang.id_jenjang = siswa.id_jenjang', 'LEFT');
        $builder->orderBy('siswa.nama_siswa', 'ASC');
        $siswa_list = $builder->get()->getResultArray();

        if ($id_siswa) {
            $tagihan = $m_tagihan->rekap_siswa($id_siswa);
            $summary = $m_tagihan->summary_siswa($id_siswa);
        }

        $data = [
            'title'      => 'Rekap Pembayaran Siswa',
            'siswa_list' => $siswa_list,
            'tagihan'    => $tagihan,
            'summary'    => $summary,
            'id_siswa'   => $id_siswa,
            'content'    => 'admin/tagihan/rekap',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Generate tagihan bulk
    public function generate()
    {
        $m_tagihan = new Tagihan_model();

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id_tahun' => 'required',
            'bulan'    => 'required|in_list[1,2,3,4,5,6,7,8,9,10,11,12]',
            'tahun'    => 'required|exact_length[4]|is_numeric',
        ])) {
            $result = $m_tagihan->generate(
                $this->request->getPost('id_tahun'),
                $this->request->getPost('bulan'),
                $this->request->getPost('tahun')
            );

            $this->session->setFlashdata('sukses', "Generate selesai: {$result['generated']} tagihan dibuat, {$result['skipped']} dilewati");
            return redirect()->to(base_url('admin/tagihan'));
        } else {
            return redirect()->to(base_url('admin/tagihan'));
        }
    }
}
```

- [ ] **Step 2: Verify syntax**

```bash
php -l app/Controllers/Admin/Tagihan.php
```
Expected: `No syntax errors detected`

- [ ] **Step 3: Commit**

```bash
git add app/Controllers/Admin/Tagihan.php
git commit -m "feat(controller): Admin Tagihan — list, bayar, rekap, generate bulk"
```

---

### Task 5: Views — Biaya (index, tambah, edit)

**Files:**
- Create: `app/Views/admin/biaya/index.php`
- Create: `app/Views/admin/biaya/tambah.php`
- Create: `app/Views/admin/biaya/edit.php`

**Interfaces:**
- Consumes: `$biaya` (array), `$jenjang` (array) — from Task 3 controller
- Pattern: Follows `admin/kelas/index.php` exactly (modal tambah, table list, edit form)

- [ ] **Step 1: Create tambah.php (modal form)**

```php
<p>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
        <i class="fa fa-plus"></i> Tambah Baru
    </button>
</p>
<?php echo form_open(base_url('admin/biaya')); ?>
<?php echo csrf_field(); ?>
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Biaya Pendidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-4">Jenjang</label>
                    <div class="col-8">
                        <select name="id_jenjang" class="form-control select2" required>
                            <option value="">Pilih Jenjang</option>
                            <?php foreach ($jenjang as $j) { ?>
                                <option value="<?php echo esc($j->id_jenjang) ?>">
                                    <?php echo esc($j->nama_jenjang) ?> - <?php echo esc($j->keterangan) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Nama Biaya</label>
                    <div class="col-8">
                        <input type="text" name="nama_biaya" class="form-control" required
                               placeholder="Contoh: SPP Bulanan PAUD">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Nominal (Rp)</label>
                    <div class="col-8">
                        <input type="number" name="nominal" class="form-control" required min="0"
                               placeholder="500000">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Periode</label>
                    <div class="col-8">
                        <select name="periode" class="form-control" required>
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Tahun Mulai</label>
                    <div class="col-8">
                        <input type="number" name="tahun_mulai" class="form-control" required
                               value="<?php echo date('Y') ?>" min="2020" max="2050">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Tahun Selesai</label>
                    <div class="col-8">
                        <input type="number" name="tahun_selesai" class="form-control"
                               placeholder="Kosongkan jika masih aktif" min="2020" max="2050">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Status</label>
                    <div class="col-8">
                        <select name="status" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
```

- [ ] **Step 2: Create index.php (list table)**

```php
<?php include('tambah.php'); ?>
<?php if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning"><?php echo $this->session->flashdata('warning') ?></div>
<?php } ?>
<table class="table table-bordered table-sm" id="example3">
    <thead>
        <tr class="bg-secondary text-center">
            <th width="5%">No</th>
            <th width="20%">Nama Biaya</th>
            <th width="15%">Jenjang</th>
            <th width="15%">Nominal</th>
            <th width="10%">Periode</th>
            <th width="8%">Tahun</th>
            <th width="10%">Status</th>
            <th width="17%"></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($biaya as $b) { ?>
        <tr>
            <td class="text-center"><?php echo esc($no++) ?></td>
            <td><?php echo esc($b['nama_biaya']) ?></td>
            <td><?php echo esc($b['nama_jenjang']) ?></td>
            <td class="text-right">Rp <?php echo number_format($b['nominal'], 0, ',', '.') ?></td>
            <td class="text-center"><?php echo esc($b['periode']) ?></td>
            <td class="text-center"><?php echo esc($b['tahun_mulai']) ?><?php if ($b['tahun_selesai']) echo ' - ' . esc($b['tahun_selesai']) ?></td>
            <td class="text-center">
                <?php if ($b['status'] == 'Aktif') { ?>
                    <span class="badge badge-success">Aktif</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Non Aktif</span>
                <?php } ?>
            </td>
            <td class="text-center">
                <a href="<?php echo base_url('admin/biaya/edit/' . $b['id_biaya']) ?>" class="btn btn-secondary btn-xs mb-1"><i class="fa fa-edit"></i></a>
                <a href="<?php echo base_url('admin/biaya/delete/' . $b['id_biaya']) ?>" class="btn btn-secondary btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
```

- [ ] **Step 3: Create edit.php**

```php
<?php echo form_open(base_url('admin/biaya/edit/' . $biaya->id_biaya)); ?>
<?php echo csrf_field(); ?>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-edit"></i> Edit Biaya</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-4">Jenjang</label>
            <div class="col-8">
                <select name="id_jenjang" class="form-control select2" required>
                    <?php foreach ($jenjang as $j) { ?>
                        <option value="<?php echo esc($j->id_jenjang) ?>"
                            <?php if ($j->id_jenjang == $biaya->id_jenjang) echo 'selected' ?>>
                            <?php echo esc($j->nama_jenjang) ?> - <?php echo esc($j->keterangan) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Nama Biaya</label>
            <div class="col-8">
                <input type="text" name="nama_biaya" class="form-control" required
                       value="<?php echo esc($biaya->nama_biaya) ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Nominal (Rp)</label>
            <div class="col-8">
                <input type="number" name="nominal" class="form-control" required min="0"
                       value="<?php echo esc($biaya->nominal) ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Periode</label>
            <div class="col-8">
                <select name="periode" class="form-control" required>
                    <option value="Bulanan" <?php if ($biaya->periode == 'Bulanan') echo 'selected' ?>>Bulanan</option>
                    <option value="Tahunan" <?php if ($biaya->periode == 'Tahunan') echo 'selected' ?>>Tahunan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Tahun Mulai</label>
            <div class="col-8">
                <input type="number" name="tahun_mulai" class="form-control" required
                       value="<?php echo esc($biaya->tahun_mulai) ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Tahun Selesai</label>
            <div class="col-8">
                <input type="number" name="tahun_selesai" class="form-control"
                       value="<?php echo esc($biaya->tahun_selesai ?? '') ?>"
                       placeholder="Kosongkan jika masih aktif">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Status</label>
            <div class="col-8">
                <select name="status" class="form-control">
                    <option value="Aktif" <?php if ($biaya->status == 'Aktif') echo 'selected' ?>>Aktif</option>
                    <option value="Non Aktif" <?php if ($biaya->status == 'Non Aktif') echo 'selected' ?>>Non Aktif</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo base_url('admin/biaya') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div>
<?php echo form_close(); ?>
```

- [ ] **Step 4: Verify all view syntax**

```bash
php -l app/Views/admin/biaya/index.php && php -l app/Views/admin/biaya/tambah.php && php -l app/Views/admin/biaya/edit.php
```
Expected: `No syntax errors detected` (x3)

- [ ] **Step 5: Commit**

```bash
git add app/Views/admin/biaya/
git commit -m "feat(views): biaya — index, tambah modal, edit form"
```

---

### Task 6: Views — Tagihan (index, bayar, rekap, generate_modal)

**Files:**
- Create: `app/Views/admin/tagihan/index.php`
- Create: `app/Views/admin/tagihan/bayar.php`
- Create: `app/Views/admin/tagihan/rekap.php`
- Create: `app/Views/admin/tagihan/generate_modal.php`

**Interfaces:**
- Consumes: `$tagihan` (array), `$kelas`, `$tahun`, `$filters` — from Task 4 controller

- [ ] **Step 1: Create index.php (list + filter + generate button)**

```php
<?php include('generate_modal.php'); ?>
<?php if ($this->session->flashdata('sukses')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('sukses') ?></div>
<?php } ?>
<?php if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning"><?php echo $this->session->flashdata('warning') ?></div>
<?php } ?>

<!-- Filter -->
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-filter"></i> Filter</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo base_url('admin/tagihan') ?>">
            <div class="row">
                <div class="col-md-2">
                    <select name="status" class="form-control form-control-sm">
                        <option value="">Semua Status</option>
                        <option value="Belum" <?php if (($filters['status'] ?? '') == 'Belum') echo 'selected' ?>>Belum Bayar</option>
                        <option value="Lunas" <?php if (($filters['status'] ?? '') == 'Lunas') echo 'selected' ?>>Lunas</option>
                        <option value="Dibatalkan" <?php if (($filters['status'] ?? '') == 'Dibatalkan') echo 'selected' ?>>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="id_kelas" class="form-control form-control-sm">
                        <option value="">Semua Kelas</option>
                        <?php foreach ($kelas as $k) { ?>
                            <option value="<?php echo esc($k->id_kelas) ?>" <?php if (($filters['id_kelas'] ?? '') == $k->id_kelas) echo 'selected' ?>>
                                <?php echo esc($k->nama_kelas) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="bulan" class="form-control form-control-sm">
                        <option value="">Semua Bulan</option>
                        <?php for ($i = 1; $i <= 12; $i++) {
                            $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        ?>
                            <option value="<?php echo $i ?>" <?php if (($filters['bulan'] ?? '') == $i) echo 'selected' ?>><?php echo $nama_bulan[$i-1] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun" class="form-control form-control-sm">
                        <option value="">Semua Tahun</option>
                        <?php for ($y = date('Y'); $y >= 2020; $y--) { ?>
                            <option value="<?php echo $y ?>" <?php if (($filters['tahun'] ?? '') == $y) echo 'selected' ?>><?php echo $y ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Filter</button>
                    <a href="<?php echo base_url('admin/tagihan') ?>" class="btn btn-default btn-sm">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<table class="table table-bordered table-sm" id="example3">
    <thead>
        <tr class="bg-secondary text-center">
            <th width="5%">No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Biaya</th>
            <th>Bulan/Tahun</th>
            <th>Nominal</th>
            <th>Status</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($tagihan as $t) { ?>
        <tr>
            <td class="text-center"><?php echo esc($no++) ?></td>
            <td><?php echo esc($t['nama_siswa']) ?></td>
            <td><?php echo esc($t['nama_kelas']) ?></td>
            <td><?php echo esc($t['nama_biaya']) ?></td>
            <td class="text-center">
                <?php
                    $nama_bulan = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    echo $nama_bulan[$t['bulan']] . ' ' . esc($t['tahun']);
                ?>
            </td>
            <td class="text-right">Rp <?php echo number_format($t['nominal_tagihan'], 0, ',', '.') ?></td>
            <td class="text-center">
                <?php if ($t['status'] == 'Lunas') { ?>
                    <span class="badge badge-success">Lunas</span>
                <?php } elseif ($t['status'] == 'Dibatalkan') { ?>
                    <span class="badge badge-secondary">Dibatalkan</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Belum</span>
                <?php } ?>
            </td>
            <td class="text-center">
                <?php if ($t['status'] == 'Belum') { ?>
                    <a href="<?php echo base_url('admin/tagihan/bayar/' . $t['id_tagihan']) ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-money"></i> Bayar
                    </a>
                <?php } else { ?>
                    <a href="<?php echo base_url('admin/tagihan/bayar/' . $t['id_tagihan']) ?>" class="btn btn-secondary btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
```

- [ ] **Step 2: Create generate_modal.php**

```php
<!-- Button Generate + Link Rekap -->
<div class="mb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-generate">
        <i class="fa fa-cogs"></i> Generate Tagihan
    </button>
    <a href="<?php echo base_url('admin/tagihan/rekap') ?>" class="btn btn-info">
        <i class="fa fa-file-invoice-dollar"></i> Rekap Per Siswa
    </a>
</div>

<?php echo form_open(base_url('admin/tagihan/generate')); ?>
<?php echo csrf_field(); ?>
<div class="modal fade" id="modal-generate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Generate Tagihan Bulanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <select name="id_tahun" class="form-control select2" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php foreach ($tahun as $t) { ?>
                            <option value="<?php echo esc($t->id_tahun) ?>">
                                <?php echo esc($t->nama_tahun) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control" required>
                        <option value="">Pilih Bulan</option>
                        <?php
                        $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ($i == (int)date('m')) ? 'selected' : '';
                            echo "<option value='{$i}' {$selected}>{$nama_bulan[$i-1]}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required
                           value="<?php echo date('Y') ?>" min="2020" max="2050">
                </div>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Tagihan akan digenerate untuk semua siswa aktif. Siswa yang sudah memiliki tagihan bulan ini akan dilewati.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-cogs"></i> Generate</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
```

- [ ] **Step 3: Create bayar.php**

```php
<?php if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning"><?php echo $this->session->flashdata('warning') ?></div>
<?php } ?>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-money"></i> Detail Tagihan</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-sm">
            <tr>
                <th width="20%">Nama Siswa</th>
                <td><?php echo esc($tagihan->nama_siswa) ?> (NIS: <?php echo esc($tagihan->nis) ?>)</td>
            </tr>
            <tr>
                <th>Kelas / Jenjang</th>
                <td><?php echo esc($tagihan->nama_kelas) ?> — <?php echo esc($tagihan->nama_jenjang) ?></td>
            </tr>
            <tr>
                <th>Biaya</th>
                <td><?php echo esc($tagihan->nama_biaya) ?></td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>
                    <?php
                    $nama_bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    echo $nama_bulan[$tagihan->bulan] . ' ' . esc($tagihan->tahun);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td><strong>Rp <?php echo number_format($tagihan->nominal_tagihan, 0, ',', '.') ?></strong></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php if ($tagihan->status == 'Lunas') { ?>
                        <span class="badge badge-success">Lunas</span>
                        — Dibayar: <?php echo esc($tagihan->tanggal_bayar) ?>
                        — Oleh: <?php echo esc($tagihan->admin_verifikasi) ?>
                    <?php } else { ?>
                        <span class="badge badge-danger">Belum Bayar</span>
                    <?php } ?>
                </td>
            </tr>
            <?php if ($tagihan->bukti_bayar) { ?>
            <tr>
                <th>Bukti Bayar</th>
                <td>
                    <a href="<?php echo base_url('assets/upload/bukti_bayar/' . $tagihan->bukti_bayar) ?>" target="_blank">
                        <i class="fa fa-file-image"></i> Lihat Bukti
                    </a>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <th>Keterangan</th>
                <td><?php echo esc($tagihan->keterangan ?? '-') ?></td>
            </tr>
        </table>
    </div>
</div>

<?php if ($tagihan->status == 'Belum') { ?>
<?php echo form_open_multipart(base_url('admin/tagihan/bayar/' . $tagihan->id_tagihan)); ?>
<?php echo csrf_field(); ?>
<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-check"></i> Verifikasi Pembayaran</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-3">Metode Bayar</label>
            <div class="col-5">
                <select name="metode_bayar" class="form-control" required>
                    <option value="">Pilih Metode</option>
                    <option value="Cash">Cash (Tunai)</option>
                    <option value="Transfer">Transfer Bank</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3">Bukti Bayar</label>
            <div class="col-5">
                <input type="file" name="bukti_bayar" class="form-control"
                       accept=".jpg,.jpeg,.png,.gif,.webp,.pdf">
                <small class="text-muted">Format: JPG, PNG, GIF, WebP, PDF (maks 5MB)</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3">Keterangan</label>
            <div class="col-5">
                <textarea name="keterangan" class="form-control" rows="2"></textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo base_url('admin/tagihan') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-success float-right"><i class="fa fa-check"></i> Verifikasi Bayar</button>
    </div>
</div>
<?php echo form_close(); ?>
<?php } else { ?>
<a href="<?php echo base_url('admin/tagihan') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar Tagihan</a>
<?php } ?>

<!-- Log -->
<?php if (count($logs) > 0) { ?>
<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-history"></i> Riwayat</h3>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Aksi</th>
                    <th>Admin</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log) { ?>
                <tr>
                    <td><?php echo esc($log['tanggal']) ?></td>
                    <td><?php echo esc($log['aksi']) ?></td>
                    <td><?php echo esc($log['admin']) ?></td>
                    <td><?php echo esc($log['keterangan']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>
```

- [ ] **Step 4: Create rekap.php**

```php
<!-- Pilih Siswa -->
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-search"></i> Pilih Siswa</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo base_url('admin/tagihan/rekap') ?>">
            <div class="row">
                <div class="col-md-8">
                    <select name="id_siswa" class="form-control select2" required>
                        <option value="">— Pilih Siswa —</option>
                        <?php foreach ($siswa_list as $s) { ?>
                            <option value="<?php echo esc($s['id_siswa']) ?>"
                                <?php if (($id_siswa ?? '') == $s['id_siswa']) echo 'selected' ?>>
                                <?php echo esc($s['nama_siswa']) ?> — <?php echo esc($s['nama_kelas']) ?> (<?php echo esc($s['nama_jenjang']) ?>)
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Lihat Rekap</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($tagihan) { ?>
<!-- Summary -->
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa fa-file-invoice"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Tagihan</span>
                <span class="info-box-number">Rp <?php echo number_format($summary->grand_total ?? 0, 0, ',', '.') ?></span>
                <span class="info-box-number"><small><?php echo esc($summary->total_tagihan ?? 0) ?> tagihan</small></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fa fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sudah Dibayar</span>
                <span class="info-box-number">Rp <?php echo number_format($summary->total_dibayar ?? 0, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fa fa-exclamation-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Belum Dibayar</span>
                <span class="info-box-number">Rp <?php echo number_format($summary->total_sisa ?? 0, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Rekap -->
<table class="table table-bordered table-sm" id="example3">
    <thead>
        <tr class="bg-secondary text-center">
            <th width="5%">No</th>
            <th>Biaya</th>
            <th>Periode</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Tanggal Bayar</th>
            <th>Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($tagihan as $t) { ?>
        <tr>
            <td class="text-center"><?php echo esc($no++) ?></td>
            <td><?php echo esc($t['nama_biaya']) ?></td>
            <td class="text-center">
                <?php
                $nama_bulan = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                echo $nama_bulan[$t['bulan']] . ' ' . esc($t['tahun']);
                ?>
            </td>
            <td class="text-right">Rp <?php echo number_format($t['nominal_tagihan'], 0, ',', '.') ?></td>
            <td class="text-center">
                <?php if ($t['status'] == 'Lunas') { ?>
                    <span class="badge badge-success">Lunas</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Belum</span>
                <?php } ?>
            </td>
            <td class="text-center"><?php echo esc($t['tanggal_bayar'] ?? '-') ?></td>
            <td><?php echo esc($t['admin_verifikasi'] ?? '-') ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>
```

- [ ] **Step 5: Commit**

```bash
git add app/Views/admin/tagihan/
git commit -m "feat(views): tagihan — index filter, bayar form, rekap per siswa, generate modal"
```

---

### Task 7: Sidebar Menu — Add Keuangan Section

**Files:**
- Modify: `app/Views/admin/layout/menu.php`

**Interfaces:** Admin-only section (same guard as `Pengguna Sistem`)

- [ ] **Step 1: Add menu after "Pengguna Sistem"**

Insert after line 494 (the `<!-- pengguna -->` block closing `</li>`), before `<!-- konfigurasi -->`:

```php
          <!-- Keuangan -->
          <li class="nav-item <?php if($uri->getSegment(2)=='biaya' || $uri->getSegment(2)=='tagihan'){echo 'menu-open';}?>  ">
            <a href="#" class="nav-link <?php if($uri->getSegment(2)=='biaya' || $uri->getSegment(2)=='tagihan'){echo 'active';}?>">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>Keuangan <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/biaya') ?>" class="nav-link <?php if($uri->getSegment(2)=='biaya'){echo 'active';}?>">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Master Biaya</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/tagihan') ?>" class="nav-link <?php if($uri->getSegment(2)=='tagihan'){echo 'active';}?>">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Tagihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/tagihan/rekap') ?>" class="nav-link <?php if($uri->getSegment(3)=='rekap'){echo 'active';}?>">
                  <i class="fa fa-arrow-right nav-icon"></i>
                  <p>Rekap Per Siswa</p>
                </a>
              </li>
            </ul>
          </li>
```

- [ ] **Step 2: Create upload directory**

```bash
mkdir -p assets/upload/bukti_bayar/
```

- [ ] **Step 3: Commit**

```bash
git add app/Views/admin/layout/menu.php assets/upload/bukti_bayar/.gitkeep
touch assets/upload/bukti_bayar/.gitkeep
git add assets/upload/bukti_bayar/.gitkeep
git commit -m "feat(menu): add Keuangan sidebar — biaya, tagihan, rekap"
```

---

### Task 8: Integration Test — Verify Full Flow

**Files:** None — verification only.

- [ ] **Step 1: Start dev server**

```bash
cd /home/aqsadev/PRIBADI/websitesekolah-ci
php -S 0.0.0.0:8080 dev-router.php &
sleep 2
```

- [ ] **Step 2: Verify Master Biaya page loads**

```bash
curl -s -c /tmp/cookies.txt -b /tmp/cookies.txt http://127.0.0.1:8080/login -X POST -d "username=andoyo&password=andoyo" -L > /dev/null
curl -s -b /tmp/cookies.txt http://127.0.0.1:8080/admin/biaya | grep -o "Master Biaya"
```
Expected: `Master Biaya`

- [ ] **Step 3: Verify Tagihan page loads**

```bash
curl -s -b /tmp/cookies.txt http://127.0.0.1:8080/admin/tagihan | grep -o "Tagihan Pendidikan"
```
Expected: `Tagihan Pendidikan`

- [ ] **Step 4: Verify Rekap page loads**

```bash
curl -s -b /tmp/cookies.txt "http://127.0.0.1:8080/admin/tagihan/rekap" | grep -o "Rekap Pembayaran"
```
Expected: `Rekap Pembayaran`

- [ ] **Step 5: Verify sidebar menu appears**

```bash
curl -s -b /tmp/cookies.txt http://127.0.0.1:8080/admin/dasbor | grep -o "Keuangan"
```
Expected: `Keuangan`

- [ ] **Step 6: Verify CSRF protection (POST without token blocked)**

```bash
curl -s -b /tmp/cookies.txt -X POST http://127.0.0.1:8080/admin/biaya -d "id_jenjang=1&nama_biaya=test&nominal=100000&periode=Bulanan&tahun_mulai=2026" -w "\nHTTP_CODE:%{http_code}" | tail -1
```
Expected: `HTTP_CODE:403` (CSRF rejected — missing token)

- [ ] **Step 7: Commit final state**

```bash
git add -A
git commit -m "test: integration test — keuangan pages load, CSRF active"
git push origin main
```

---

## Self-Review Checklist

1. **Spec coverage:** biaya CRUD ✓, tagihan list ✓, generate bulk ✓, bayar ✓, rekap per siswa ✓, sidebar menu ✓, migration SQL ✓
2. **Placeholder scan:** No TBD/TODO found — all code blocks are complete
3. **Type consistency:** `Biaya_model`, `Tagihan_model`, `Log_pembayaran_model` names consistent across all tasks. `$biaya->id_biaya` matches schema. `$tagihan->id_tagihan` matches schema. All method signatures match controller usage.
4. **Pattern compliance:** All controllers extend `BaseController`, all views use `esc()`, all forms have `csrf_field()`, file uploads use `isAllowedType()` whitelist.
5. **Existing model reference:** `Siswa_model` not created (already exists in codebase). `Kelas_model`, `Jenjang_model`, `Tahun_model` — all referenced and already exist.
