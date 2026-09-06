<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/download') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($download->judul_download) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/download/edit/'.$download->id_download)) ?>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Judul Download <span class="text-danger">*</span></label>
        <input type="text" name="judul_download" class="form-control" value="<?= esc($download->judul_download) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Upload File</label>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
        <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti file</small>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Kategori</label>
        <select name="id_kategori_download" class="form-select">
          <?php foreach($kategori_download as $kd): ?>
          <option value="<?= esc($kd->id_kategori_download) ?>" <?= ($kd->id_kategori_download == $download->id_kategori_download) ? 'selected' : '' ?>>
            <?= esc($kd->nama_kategori_download) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Jenis Konten</label>
        <select name="jenis_download" class="form-select">
          <option value="Download" <?= ($download->jenis_download == 'Download') ? 'selected' : '' ?>>Download</option>
          <option value="Panduan" <?= ($download->jenis_download == 'Panduan') ? 'selected' : '' ?>>Panduan</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_download" class="form-select">
          <option value="Publish" <?= ($download->status_download == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($download->status_download == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Isi/Deskripsi</label>
      <textarea name="isi" class="form-control konten" rows="5"><?= esc($download->isi) ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Link/URL</label>
      <input type="text" name="website" class="form-control" value="<?= esc($download->website) ?>">
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/download') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
