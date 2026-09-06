<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/fasilitas') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($fasilitas->judul_fasilitas) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/fasilitas/edit/'.$fasilitas->id_fasilitas)) ?>

    <h6 style="color:var(--primary);font-weight:600;margin-bottom:1rem;"><i class="fas fa-info-circle"></i> Informasi Fasilitas</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Judul/Nama Fasilitas <span class="text-danger">*</span></label>
        <input type="text" name="judul_fasilitas" class="form-control" value="<?= esc($fasilitas->judul_fasilitas) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Kode/Nomor</label>
        <input type="text" name="kode_nomor_fasilitas" class="form-control" value="<?= esc($fasilitas->kode_nomor_fasilitas) ?>">
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-clipboard-check"></i> Kondisi & Tahun</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Kondisi</label>
        <select name="kondisi_fasilitas" class="form-select">
          <option value="Baik" <?= ($fasilitas->kondisi_fasilitas == 'Baik') ? 'selected' : '' ?>>Baik</option>
          <option value="Rusak" <?= ($fasilitas->kondisi_fasilitas == 'Rusak') ? 'selected' : '' ?>>Rusak</option>
          <option value="Hilang" <?= ($fasilitas->kondisi_fasilitas == 'Hilang') ? 'selected' : '' ?>>Hilang</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun_fasilitas" class="form-control" value="<?= esc($fasilitas->tahun_fasilitas) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal</label>
        <input type="text" name="tanggal_fasilitas" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($fasilitas->tanggal_fasilitas)) ?>">
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-tags"></i> Kategori & Status</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Kategori</label>
        <select name="id_kategori_fasilitas" class="form-select select2">
          <?php foreach($kategori_fasilitas as $kf): ?>
          <option value="<?= esc($kf->id_kategori_fasilitas) ?>" <?= ($kf->id_kategori_fasilitas == $fasilitas->id_kategori_fasilitas) ? 'selected' : '' ?>>
            <?= esc($kf->nama_kategori_fasilitas) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_fasilitas" class="form-select">
          <option value="Publish" <?= ($fasilitas->status_fasilitas == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($fasilitas->status_fasilitas == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Teks Slider</label>
        <select name="status_text" class="form-select">
          <option value="Ya" <?= ($fasilitas->status_text == 'Ya') ? 'selected' : '' ?>>Aktif</option>
          <option value="Tidak" <?= ($fasilitas->status_text == 'Tidak') ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-image"></i> Gambar</h6>
    <div class="form-section">
      <label class="form-label">Upload Gambar</label>
      <?php if($fasilitas->gambar != ''): ?>
      <div class="mb-2">
        <img src="<?= base_url('assets/upload/image/thumbs/'.$fasilitas->gambar) ?>" style="width:80px;height:60px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
      </div>
      <?php endif; ?>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
      <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-align-left"></i> Konten</h6>
    <div class="form-section">
      <label class="form-label">Isi Fasilitas</label>
      <textarea name="isi" class="form-control konten" rows="5"><?= esc($fasilitas->isi) ?></textarea>
    </div>
    <div class="form-grid">
      <div class="form-section mt-3">
        <label class="form-label">Text Tombol Link</label>
        <input type="text" name="text_website" class="form-control" value="<?= esc($fasilitas->text_website) ?>">
      </div>
      <div class="form-section mt-3">
        <label class="form-label">Link/URL</label>
        <input type="text" name="website" class="form-control" value="<?= esc($fasilitas->website) ?>">
      </div>
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/fasilitas') ?>" class="btn btn-secondary-action">
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
