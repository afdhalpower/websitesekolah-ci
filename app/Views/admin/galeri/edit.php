<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/galeri') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($galeri->judul_galeri) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/galeri/edit/'.$galeri->id_galeri)) ?>

    <div class="form-grid">
      <!-- Judul -->
      <div class="form-section">
        <label class="form-label">Judul Galeri <span class="text-danger">*</span></label>
        <input type="text" name="judul_galeri" class="form-control" value="<?= esc($galeri->judul_galeri) ?>" required>
      </div>

      <!-- Gambar -->
      <div class="form-section">
        <label class="form-label">Gambar</label>
        <?php if($galeri->gambar != ''): ?>
        <div class="mb-2">
          <img src="<?= base_url('assets/upload/image/thumbs/'.$galeri->gambar) ?>" class="berita-thumb" alt="" style="width:80px;height:80px;">
        </div>
        <?php endif; ?>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
      </div>

      <!-- Kategori -->
      <div class="form-section">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="id_kategori_galeri" class="form-select" required>
          <?php foreach($kategori_galeri as $kg): ?>
          <option value="<?= esc($kg->id_kategori_galeri) ?>" <?= ($kg->id_kategori_galeri == $galeri->id_kategori_galeri) ? 'selected' : '' ?>>
            <?= esc($kg->nama_kategori_galeri) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Jenis -->
      <div class="form-section">
        <label class="form-label">Jenis Galeri <span class="text-danger">*</span></label>
        <select name="jenis_galeri" class="form-select" required>
          <?php foreach(['Galeri','Homepage','Header','Pop Up'] as $j): ?>
          <option value="<?= $j ?>" <?= ($j == $galeri->jenis_galeri) ? 'selected' : '' ?>><?= $j ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Status Text -->
      <div class="form-section">
        <label class="form-label">Status Teks</label>
        <select name="status_text" class="form-select">
          <option value="Ya" <?= ($galeri->status_text == 'Ya') ? 'selected' : '' ?>>Aktif</option>
          <option value="Tidak" <?= ($galeri->status_text == 'Tidak') ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
      </div>
    </div>

    <!-- Isi Galeri -->
    <div class="form-section mt-3">
      <label class="form-label">Isi / Deskripsi Galeri</label>
      <textarea name="isi" class="form-control konten" rows="6"><?= esc($galeri->isi) ?></textarea>
    </div>

    <!-- Text & Link -->
    <div class="form-grid mt-3">
      <div class="form-section">
        <label class="form-label">Teks Tombol Link</label>
        <input type="text" name="text_website" class="form-control" value="<?= esc($galeri->text_website) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">URL Link</label>
        <input type="text" name="website" class="form-control" value="<?= esc($galeri->website) ?>">
      </div>
    </div>

    <!-- Actions -->
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/galeri') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
