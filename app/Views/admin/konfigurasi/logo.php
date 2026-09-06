<form action="<?= base_url('admin/konfigurasi/logo') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Logo Website</h5>
        <p class="page-subtitle">Upload dan ganti logo utama website</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-palette" style="color:var(--green);margin-right:6px;"></i> Upload Logo</h6>
    </div>
    <div class="card-modern-body">
        <input type="hidden" name="id_konfigurasi" value="<?= esc($konfigurasi->id_konfigurasi) ?>">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Upload Logo Baru</label>
                <div class="upload-zone" onclick="this.querySelector('input[type=file]').click();" style="cursor:pointer;text-align:center;padding:20px;">
                    <input type="file" name="logo" style="display:none;" onchange="this.closest('.upload-zone').querySelector('.upload-text').textContent=this.files[0]?.name||'Pilih file...';">
                    <i class="fas fa-cloud-upload-alt" style="font-size:2rem;color:var(--gray);"></i>
                    <p class="upload-text" style="margin:8px 0 0;color:var(--gray);">Pilih atau seret file logo</p>
                    <small style="color:var(--gray);">Format: JPG, PNG, GIF &bull; Maks 5MB</small>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Logo Saat Ini</label>
                <img src="<?= esc($this->website->logo()) ?>" class="img-fluid rounded" style="max-height:120px;border:1px solid var(--border);">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close(); ?>
