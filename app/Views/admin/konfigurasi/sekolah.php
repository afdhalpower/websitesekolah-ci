<?php
$url_cetak = base_url('admin/konfigurasi/unduh');
?>
<div class="page-header-modern">
    <div>
        <h5 class="page-title">Informasi Sekolah</h5>
        <p class="page-subtitle">Data dasar, kontak, akreditasi, yayasan, dan tanah/bangunan</p>
    </div>
    <div>
        <a href="<?= $url_cetak ?>" class="btn-secondary-action" target="_blank">
            <i class="fas fa-file-pdf"></i> Cetak/Unduh PDF
        </a>
    </div>
</div>

<?php echo form_open(base_url('admin/konfigurasi/sekolah')); ?>
<?php echo csrf_field(); ?>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-school" style="color:var(--green);margin-right:6px;"></i> Data Dasar Sekolah</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Lengkap Sekolah</label>
                <input type="text" name="nama_sekolah" class="form-control" value="<?= esc($sekolah->nama_sekolah) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nama di Cover</label>
                <input type="text" name="nama_sekolah_cover" class="form-control" value="<?= esc($sekolah->nama_sekolah_cover) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nama Singkat</label>
                <input type="text" name="nama_singkat" class="form-control" value="<?= esc($sekolah->nama_singkat) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">NPSN/NSS/NISN</label>
                <input type="text" name="nis" class="form-control" value="<?= esc($sekolah->nis) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Status Sekolah</label>
                <input type="text" name="status_sekolah" class="form-control" value="<?= esc($sekolah->status_sekolah) ?>">
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-map-marker-alt" style="color:var(--blue);margin-right:6px;"></i> Kontak dan Alamat Sekolah</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2"><?= esc($sekolah->alamat) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Kelurahan</label>
                <input type="text" name="kelurahan" class="form-control" value="<?= esc($sekolah->kelurahan) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control" value="<?= esc($sekolah->kecamatan) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Kabupaten</label>
                <input type="text" name="kabupaten" class="form-control" value="<?= esc($sekolah->kabupaten) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Provinsi</label>
                <input type="text" name="provinsi" class="form-control" value="<?= esc($sekolah->provinsi) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Kode Pos</label>
                <input type="text" name="kode_pos" class="form-control" value="<?= esc($sekolah->kode_pos) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="<?= esc($sekolah->telepon) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($sekolah->email) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Website</label>
                <input type="text" name="website" class="form-control" value="<?= esc($sekolah->website) ?>">
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-certificate" style="color:var(--amber);margin-right:6px;"></i> Informasi, Akreditasi dan Yayasan</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Yayasan</label>
                <input type="text" name="nama_yayasan" class="form-control" value="<?= esc($sekolah->nama_yayasan) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nama Cover Rapor</label>
                <input type="text" name="nama_cover" class="form-control" value="<?= esc($sekolah->nama_cover) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Kota Cover Rapor</label>
                <input type="text" name="kota_cover" class="form-control" value="<?= esc($sekolah->kota_cover) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nama Footer Rapor</label>
                <input type="text" name="nama_footer" class="form-control" value="<?= esc($sekolah->nama_footer) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Berdiri</label>
                <input type="text" name="tanggal_berdiri" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($sekolah->tanggal_berdiri)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nama Kepala Sekolah</label>
                <input type="text" name="nama_kepsek" class="form-control" value="<?= esc($sekolah->nama_kepsek) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Jumlah Rombel</label>
                <input type="text" name="jumlah_rombel" class="form-control" value="<?= esc($sekolah->jumlah_rombel) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Jumlah Siswa</label>
                <input type="text" name="jumlah_murid" class="form-control" value="<?= esc($sekolah->jumlah_murid) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Jumlah Pegawai</label>
                <input type="text" name="jumlah_pegawai" class="form-control" value="<?= esc($sekolah->jumlah_pegawai) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nilai Akreditasi</label>
                <select name="nilai_akreditasi" class="form-control">
                    <option value="A" <?= $sekolah->nilai_akreditasi=='A' ? 'selected' : '' ?>>A</option>
                    <option value="B" <?= $sekolah->nilai_akreditasi=='B' ? 'selected' : '' ?>>B</option>
                    <option value="C" <?= $sekolah->nilai_akreditasi=='C' ? 'selected' : '' ?>>C</option>
                    <option value="D" <?= $sekolah->nilai_akreditasi=='D' ? 'selected' : '' ?>>D</option>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Tahun Akreditasi</label>
                <input type="text" name="tahun_akreditasi" class="form-control" value="<?= esc($sekolah->tahun_akreditasi) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Akreditasi</label>
                <input type="text" name="tanggal_berlaku" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($sekolah->tanggal_berlaku)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Kadaluarsa</label>
                <input type="text" name="tanggal_kadaluarsa" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($sekolah->tanggal_kadaluarsa)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nomor Izin Sekolah</label>
                <input type="text" name="nomor_izin" class="form-control" value="<?= esc($sekolah->nomor_izin) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"><?= esc($sekolah->keterangan) ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-building" style="color:var(--blue);margin-right:6px;"></i> Informasi Tanah dan Bangunan</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Luas Tanah (m&sup2;)</label>
                <input type="text" name="luas_tanah" class="form-control" value="<?= esc($sekolah->luas_tanah) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Luas Bangunan (m&sup2;)</label>
                <input type="text" name="luas_bangunan" class="form-control" value="<?= esc($sekolah->luas_bangunan) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Status Kepemilikan</label>
                <input type="text" name="status_tanah" class="form-control" value="<?= esc($sekolah->status_tanah) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nomor IMB</label>
                <input type="text" name="imb" class="form-control" value="<?= esc($sekolah->imb) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Nomor Sertifikat Tanah</label>
                <input type="text" name="nomor_sertifikat" class="form-control" value="<?= esc($sekolah->nomor_sertifikat) ?>">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <button type="submit" class="btn-success-action">
        <i class="fas fa-save"></i> Simpan
    </button>
</div>

<?php echo form_close(); ?>
