<?php echo form_open(base_url('admin/konfigurasi/seo')); ?>
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">SEO & Meta Tags</h5>
        <p class="page-subtitle">Optimasi pencarian Google, Facebook Pixel, Google Analytics</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-search" style="color:var(--amber);margin-right:6px;"></i> Pengaturan SEO</h6>
    </div>
    <div class="card-modern-body">
        <input type="hidden" name="id_konfigurasi" value="<?= esc($konfigurasi->id_konfigurasi) ?>">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Keywords (untuk pencarian Google)</label>
                <textarea name="keywords" class="form-control" rows="3" placeholder="pisahkan dengan koma"><?= esc($konfigurasi->keywords) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Metatext, Facebook Pixel, Google Analytics</label>
                <textarea name="metatext" class="form-control" rows="4" placeholder="Paste kode tracking di sini"><?= esc($konfigurasi->metatext) ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close(); ?>
