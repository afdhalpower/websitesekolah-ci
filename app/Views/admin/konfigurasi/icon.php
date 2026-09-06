<form action="<?= base_url('admin/konfigurasi/icon') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Icon Website</h5>
        <p class="page-subtitle">Favicon yang tampil di tab browser</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-icons" style="color:var(--amber);margin-right:6px;"></i> Upload Icon</h6>
    </div>
    <div class="card-modern-body">
        <input type="hidden" name="id_konfigurasi" value="<?= esc($konfigurasi->id_konfigurasi) ?>">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Upload Icon Baru</label>
                <div class="upload-zone" onclick="this.querySelector('input[type=file]').click();" style="cursor:pointer;text-align:center;padding:20px;">
                    <input type="file" name="icon" style="display:none;" onchange="this.closest('.upload-zone').querySelector('.upload-text').textContent=this.files[0]?.name||'Pilih file...';">
                    <i class="fas fa-cloud-upload-alt" style="font-size:2rem;color:var(--gray);"></i>
                    <p class="upload-text" style="margin:8px 0 0;color:var(--gray);">Pilih atau seret file icon</p>
                    <small style="color:var(--gray);">Format: JPG, PNG, GIF &bull; Maks 5MB</small>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Icon Saat Ini</label>
                <img src="<?= esc($this->website->icon()) ?>" class="img-fluid rounded" style="max-height:80px;border:1px solid var(--border);">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close(); ?>
