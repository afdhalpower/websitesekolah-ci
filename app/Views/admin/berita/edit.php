<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($berita->judul_berita) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/berita/edit/'.$berita->id_berita)) ?>

    <div class="form-grid">
      <!-- Judul -->
      <div class="form-section">
        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
        <input type="text" name="judul_berita" class="form-control" value="<?= esc($berita->judul_berita) ?>" required>
      </div>

      <!-- Gambar -->
      <div class="form-section">
        <label class="form-label">Gambar Berita</label>
        <?php if($berita->gambar != ''): ?>
        <div class="mb-2">
          <img src="<?= base_url('assets/upload/image/thumbs/'.$berita->gambar) ?>" style="width:80px;height:80px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
        </div>
        <?php endif; ?>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
      </div>

      <!-- Kategori, Jenis, Status -->
      <div class="form-section">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="id_kategori" class="form-select" required>
          <?php foreach($kategori as $k): ?>
          <option value="<?= esc($k->id_kategori) ?>" <?= ($k->id_kategori == $berita->id_kategori) ? 'selected' : '' ?>>
            <?= esc($k->nama_kategori) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-section">
        <label class="form-label">Jenis Konten <span class="text-danger">*</span></label>
        <select name="jenis_berita" class="form-select" required>
          <?php foreach(['Berita','Layanan','Profil','Keunggulan'] as $j): ?>
          <option value="<?= $j ?>" <?= ($j == $berita->jenis_berita) ? 'selected' : '' ?>><?= $j ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_berita" class="form-select">
          <option value="Publish" <?= ($berita->status_berita == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($berita->status_berita == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>

      <div class="form-section">
        <label class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" value="<?= esc($berita->icon) ?>">
        <small style="font-size:var(--font-xs);color:var(--muted);">Font Awesome icon class</small>
      </div>

      <!-- Tanggal Publish, Jam, Urutan -->
      <div class="form-section">
        <label class="form-label">Tanggal Publikasi</label>
        <input type="text" name="tanggal_publish" class="form-control tanggal"
               value="<?= date('d-m-Y', strtotime($berita->tanggal_publish)) ?>">
      </div>

      <div class="form-section">
        <label class="form-label">Jam Publikasi</label>
        <input type="text" name="jam" class="form-control jam"
               value="<?= date('H:i:s', strtotime($berita->tanggal_publish)) ?>">
      </div>

      <div class="form-section">
        <label class="form-label">Urutan</label>
        <input type="number" name="urutan" class="form-control" value="<?= esc($berita->urutan) ?>" min="0">
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="form-section mt-3">
      <label class="form-label">Ringkasan</label>
      <textarea name="ringkasan" class="form-control" rows="3"><?= esc($berita->ringkasan) ?></textarea>
    </div>

    <!-- Isi Berita -->
    <div class="form-section mt-3">
      <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
      <div class="d-flex gap-2 mb-2">
        <button type="button" class="btn btn-secondary-action btn-sm" data-toggle="modal" data-target="#modal-media">
          <i class="fas fa-plus-circle"></i> Upload Media
        </button>
        <button type="button" class="btn btn-secondary-action btn-sm" data-toggle="modal" data-target="#modal-galeri">
          <i class="fas fa-image"></i> Galeri
        </button>
        <button type="button" class="btn btn-secondary-action btn-sm" data-toggle="modal" data-target="#modal-download">
          <i class="fas fa-download"></i> File Download
        </button>
      </div>
      <textarea name="isi" class="form-control konten" rows="12" required><?= esc($berita->isi) ?></textarea>
    </div>

    <!-- SEO Keywords -->
    <div class="form-section mt-3">
      <label class="form-label">Keyword SEO</label>
      <textarea name="keywords" class="form-control" rows="2"><?= esc($berita->keywords) ?></textarea>
    </div>

    <!-- Actions -->
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>

<!-- Include Modals -->
<?php include('media.php'); ?>
<?php include('galeri.php'); ?>
<?php include('download.php'); ?>
