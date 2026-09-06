<?php echo form_open(base_url('admin/konfigurasi/pendaftaran')); ?>
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Pendaftaran Online (PPDB)</h5>
        <p class="page-subtitle">Aktifkan/deaktifkan fitur pendaftaran siswa baru</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-user-plus" style="color:var(--green);margin-right:6px;"></i> Pengaturan Pendaftaran</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Fitur Pendaftaran Online</label>
                <select name="fitur_pendaftaran" class="form-control">
                    <option value="Off" <?= $konfigurasi->fitur_pendaftaran=='Off' ? 'selected' : '' ?>>Off - Non Aktif</option>
                    <option value="On" <?= $konfigurasi->fitur_pendaftaran=='On' ? 'selected' : '' ?>>On - Aktif</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-calendar" style="color:var(--blue);margin-right:6px;"></i> Periode Pendaftaran</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Tanggal Mulai</label>
                <input type="text" name="mulai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($konfigurasi->mulai_pendaftaran)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Selesai</label>
                <input type="text" name="selesai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($konfigurasi->selesai_pendaftaran)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Pengumuman</label>
                <input type="text" name="pengumuman_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($konfigurasi->pengumuman_pendaftaran)) ?>">
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-info-circle" style="color:var(--amber);margin-right:6px;"></i> Informasi Pendaftaran</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Keterangan / Informasi Pendaftaran</label>
                <textarea name="keterangan_pendaftaran" class="form-control konten" rows="5"><?= esc($konfigurasi->keterangan_pendaftaran) ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close(); ?>
