<form action="<?= base_url('admin/konfigurasi/banner') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Banner & About Us</h5>
        <p class="page-subtitle">Gambar banner, deskripsi tentang, dan link video profil</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-info-circle" style="color:var(--blue);margin-right:6px;"></i> Konten About Us</h6>
    </div>
    <div class="card-modern-body">
        <input type="hidden" name="id_konfigurasi" value="<?= esc($konfigurasi->id_konfigurasi) ?>">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Ringkasan Tentang Website <span style="color:var(--red);">*</span></label>
                <textarea name="ringkasan" class="form-control" rows="2"><?= esc($konfigurasi->ringkasan) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Tentang Website <span style="color:var(--red);">*</span></label>
                <div style="margin-bottom:6px;">
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-media">
                        <i class="fas fa-plus-circle"></i> Upload Media
                    </button>
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-galeri">
                        <i class="fas fa-image"></i> Galeri
                    </button>
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-download">
                        <i class="fas fa-download"></i> File
                    </button>
                </div>
                <textarea name="tentang" class="form-control konten" rows="5"><?= esc($konfigurasi->tentang) ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-link" style="color:var(--green);margin-right:6px;"></i> Link & Video</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Text Link About Website <span style="color:var(--red);">*</span></label>
                <input type="text" name="link_text" class="form-control" value="<?= esc($konfigurasi->link_text) ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Link About Website <span style="color:var(--red);">*</span></label>
                <input type="text" name="link_website" class="form-control" value="<?= esc($konfigurasi->link_website) ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Link Video Profil</label>
                <input type="text" name="link_video" class="form-control" value="<?= esc($konfigurasi->link_video) ?>">
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-image" style="color:var(--amber);margin-right:6px;"></i> Banner</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Upload Banner Baru <span style="color:var(--red);">*</span></label>
                <div class="upload-zone" onclick="this.querySelector('input[type=file]').click();" style="cursor:pointer;text-align:center;padding:20px;">
                    <input type="file" name="banner" style="display:none;" onchange="this.closest('.upload-zone').querySelector('.upload-text').textContent=this.files[0]?.name||'Pilih file...';">
                    <i class="fas fa-cloud-upload-alt" style="font-size:2rem;color:var(--gray);"></i>
                    <p class="upload-text" style="margin:8px 0 0;color:var(--gray);">Pilih atau seret file banner</p>
                    <small style="color:var(--gray);">Format: JPG, PNG, GIF &bull; Maks 5MB</small>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Banner Saat Ini</label>
                <img src="<?= esc($this->website->banner()) ?>" class="img-fluid rounded" style="max-height:150px;border:1px solid var(--border);">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close();
echo view('admin/berita/media');
echo view('admin/berita/download');
echo view('admin/berita/galeri');
?>
