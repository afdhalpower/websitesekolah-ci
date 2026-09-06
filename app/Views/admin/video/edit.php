<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/video') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($video->judul) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/video/edit/'.$video->id_video)) ?>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Judul Video <span class="text-danger">*</span></label>
        <input type="text" name="judul" class="form-control" value="<?= esc($video->judul) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Kode Video YouTube</label>
        <input type="text" name="video" class="form-control" value="<?= esc($video->video) ?>" required>
        <small style="font-size:var(--font-xs);color:var(--muted);">Bagian ID dari link YouTube</small>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Upload Thumbnail</label>
        <?php if($video->gambar != ''): ?>
        <div class="mb-2">
          <img src="<?= base_url('assets/upload/image/thumbs/'.$video->gambar) ?>" style="width:80px;height:60px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
        </div>
        <?php endif; ?>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti thumbnail</small>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_video" class="form-select">
          <option value="Publish" <?= ($video->status_video == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($video->status_video == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Posisi Video</label>
        <select name="posisi_video" class="form-select">
          <option value="Beranda" <?= ($video->posisi_video == 'Beranda') ? 'selected' : '' ?>>Beranda</option>
          <option value="Video" <?= ($video->posisi_video == 'Video') ? 'selected' : '' ?>>Galeri Video</option>
        </select>
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Keterangan</label>
      <textarea name="keterangan" class="form-control" rows="3"><?= esc($video->keterangan) ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Urutan</label>
      <input type="number" name="urutan" class="form-control" value="<?= esc($video->urutan) ?>" style="max-width:200px;">
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/video') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
