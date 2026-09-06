<div class="page-header-modern">
    <div>
        <h5 class="page-title">Import Siswa</h5>
        <p class="page-subtitle">Import data siswa dari file Excel</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 2fr;gap:1.5rem;">
    <div class="card-modern">
        <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-file-excel" style="color:var(--green);margin-right:6px;"></i> Template Import</h6></div>
        <div class="card-modern-body" style="text-align:center;">
            <div class="info-box-modern">
                <i class="fas fa-exclamation-triangle" style="color:var(--amber);font-size:1.5rem;"></i>
                <p style="margin:8px 0;font-size:0.85rem;">Pastikan Anda mengimpor data siswa dengan benar. Unduh template di bawah ini. Jangan mengubah posisi kolom yang ada pada template. Baca petunjuk pada template sebelum import.</p>
                <p style="font-size:0.85rem;">Data siswa harus dikelompokkan perkelas dan rombongan belajar. Silakan <a href="<?= base_url('admin/rombel') ?>">Kelola Rombel di sini</a>.</p>
            </div>
            <a href="<?= base_url('assets/template/template-siswa.xlsx') ?>" class="btn-success-action" style="display:inline-flex;margin-top:12px;" target="_blank">
                <i class="fas fa-file-excel"></i> Unduh Template
            </a>
        </div>
    </div>

    <div class="card-modern">
        <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-upload" style="color:var(--blue);margin-right:6px;"></i> Formulir Import</h6></div>
        <div class="card-modern-body">
            <?php echo form_open_multipart(base_url('admin/siswa/import')); ?>
            <input type="hidden" name="ID_USER" value="<?= Session()->get('id_user'); ?>">
            <div class="form-grid">
                <div class="form-section">
                    <label class="form-label">Status Siswa <span style="color:var(--red);">*</span></label>
                    <select name="status_siswa" class="form-control" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Pindah">Pindah</option>
                        <option value="Meninggal">Meninggal</option>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Rombongan Belajar <span style="color:var(--red);">*</span></label>
                    <select name="id_rombel" class="form-control select2" required>
                        <option value="">Pilih Kelas dan Tahun Ajaran</option>
                        <?php foreach($rombel as $r) { ?>
                            <option value="<?= esc($r->id_rombel) ?>"><?= esc($r->nama_kelas) ?> (<?= esc($r->nama_jenjang) ?>) - <?= esc($r->nama_tahun) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Import ke Rombel? <span style="color:var(--red);">*</span></label>
                    <select name="import_rombel" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">File Excel <span style="color:var(--red);">*</span></label>
                    <input type="file" name="file_excel" class="form-control" required>
                    <small style="color:var(--red);">Format: xls, xlsx, csv (maks 8MB)</small>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= base_url('admin/siswa') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn-success-action" name="submit" value="submit"><i class="fas fa-upload"></i> Upload dan Import</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
