<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/ekstrakurikuler') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($ekstrakurikuler->judul_ekstrakurikuler) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/ekstrakurikuler/edit/'.$ekstrakurikuler->id_ekstrakurikuler)) ?>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Judul Ekstrakurikuler <span class="text-danger">*</span></label>
        <input type="text" name="judul_ekstrakurikuler" class="form-control" value="<?= esc($ekstrakurikuler->judul_ekstrakurikuler) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Penanggung Jawab</label>
        <input type="text" name="nama_penanggung_jawab" class="form-control" value="<?= esc($ekstrakurikuler->nama_penanggung_jawab) ?>">
      </div>
    </div>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Kategori</label>
        <select name="id_kategori_ekstrakurikuler" class="form-select select2">
          <?php foreach($kategori_ekstrakurikuler as $ke): ?>
          <option value="<?= esc($ke->id_kategori_ekstrakurikuler) ?>" <?= ($ke->id_kategori_ekstrakurikuler == $ekstrakurikuler->id_kategori_ekstrakurikuler) ? 'selected' : '' ?>>
            <?= esc($ke->nama_kategori_ekstrakurikuler) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_ekstrakurikuler" class="form-select">
          <option value="Publish" <?= ($ekstrakurikuler->status_ekstrakurikuler == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($ekstrakurikuler->status_ekstrakurikuler == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Teks Slider</label>
        <select name="status_text" class="form-select">
          <option value="Ya" <?= ($ekstrakurikuler->status_text == 'Ya') ? 'selected' : '' ?>>Aktif</option>
          <option value="Tidak" <?= ($ekstrakurikuler->status_text == 'Tidak') ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Upload Gambar</label>
      <?php if($ekstrakurikuler->gambar != ''): ?>
      <div class="mb-2">
        <img src="<?= base_url('assets/upload/image/thumbs/'.$ekstrakurikuler->gambar) ?>" style="width:80px;height:60px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
      </div>
      <?php endif; ?>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
      <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Isi Ekstrakurikuler</label>
      <textarea name="isi" class="form-control konten" rows="5"><?= esc($ekstrakurikuler->isi) ?></textarea>
    </div>

    <div class="form-grid">
      <div class="form-section mt-3">
        <label class="form-label">Text Tombol Link</label>
        <input type="text" name="text_website" class="form-control" value="<?= esc($ekstrakurikuler->text_website) ?>">
      </div>
      <div class="form-section mt-3">
        <label class="form-label">Link/URL</label>
        <input type="text" name="website" class="form-control" value="<?= esc($ekstrakurikuler->website) ?>">
      </div>
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/ekstrakurikuler') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
<?php
echo view('admin/berita/media');
echo view('admin/berita/download');
echo view('admin/berita/galeri');
?>
