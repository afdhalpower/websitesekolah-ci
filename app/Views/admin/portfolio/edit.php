<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($portfolio->judul_portfolio) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/portfolio/edit/'.$portfolio->id_portfolio)) ?>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Judul Portfolio <span class="text-danger">*</span></label>
        <input type="text" name="judul_portfolio" class="form-control" value="<?= esc($portfolio->judul_portfolio) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Upload Gambar</label>
        <?php if($portfolio->gambar != ''): ?>
        <div class="mb-2">
          <img src="<?= base_url('assets/upload/image/thumbs/'.$portfolio->gambar) ?>" style="width:80px;height:80px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
        </div>
        <?php endif; ?>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Kategori</label>
        <select name="id_kategori_portfolio" class="form-select">
          <?php foreach($kategori_portfolio as $kp): ?>
          <option value="<?= esc($kp->id_kategori_portfolio) ?>" <?= ($kp->id_kategori_portfolio == $portfolio->id_kategori_portfolio) ? 'selected' : '' ?>>
            <?= esc($kp->nama_kategori_portfolio) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Jenis Konten</label>
        <select name="jenis_portfolio" class="form-select">
          <option value="Portfolio" <?= ($portfolio->jenis_portfolio == 'Portfolio') ? 'selected' : '' ?>>Portfolio</option>
          <option value="Homepage" <?= ($portfolio->jenis_portfolio == 'Homepage') ? 'selected' : '' ?>>Homepage Slider</option>
          <option value="Header" <?= ($portfolio->jenis_portfolio == 'Header') ? 'selected' : '' ?>>Header Halaman</option>
          <option value="Pop Up" <?= ($portfolio->jenis_portfolio == 'Pop Up') ? 'selected' : '' ?>>Pop Up Homepage</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Teks Slider</label>
        <select name="status_text" class="form-select">
          <option value="Ya" <?= ($portfolio->status_text == 'Ya') ? 'selected' : '' ?>>Aktif</option>
          <option value="Tidak" <?= ($portfolio->status_text == 'Tidak') ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_portfolio" class="form-select">
          <option value="Publish" <?= ($portfolio->status_portfolio == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($portfolio->status_portfolio == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Isi Portfolio</label>
      <textarea name="isi" class="form-control konten" rows="5"><?= esc($portfolio->isi) ?></textarea>
    </div>

    <div class="form-grid">
      <div class="form-section mt-3">
        <label class="form-label">Text Tombol Link</label>
        <input type="text" name="text_website" class="form-control" value="<?= esc($portfolio->text_website) ?>">
      </div>
      <div class="form-section mt-3">
        <label class="form-label">Link/URL</label>
        <input type="text" name="website" class="form-control" value="<?= esc($portfolio->website) ?>">
      </div>
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
