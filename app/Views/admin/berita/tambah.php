<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-plus-circle"></i> Tulis Berita Baru</h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/berita/tambah')) ?>

    <div class="form-grid">
      <!-- Judul -->
      <div class="form-section">
        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
        <input type="text" name="judul_berita" class="form-control" value="<?= set_value('judul_berita') ?>" required placeholder="Masukkan judul berita">
      </div>

      <!-- Gambar -->
      <div class="form-section">
        <label class="form-label">Gambar Berita</label>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF, WEBP. Maks 5MB.</small>
      </div>

      <!-- Kategori, Jenis, Status -->
      <div class="form-section">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="id_kategori" class="form-select" required>
          <?php foreach($kategori as $k): ?>
          <option value="<?= esc($k->id_kategori) ?>"><?= esc($k->nama_kategori) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-section">
        <label class="form-label">Jenis Konten <span class="text-danger">*</span></label>
        <select name="jenis_berita" class="form-select" required>
          <option value="Berita">Berita</option>
          <option value="Layanan">Layanan</option>
          <option value="Profil">Profil</option>
          <option value="Keunggulan">Keunggulan</option>
        </select>
      </div>

      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_berita" class="form-select">
          <option value="Publish">Publish</option>
          <option value="Draft">Draft</option>
        </select>
      </div>

      <div class="form-section">
        <label class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" value="<?= set_value('icon') ?>" placeholder="fa-newspaper">
        <small style="font-size:var(--font-xs);color:var(--muted);">Font Awesome icon class. <a href="https://fontawesome.com/icons" target="_blank">Lihat daftar</a></small>
      </div>

      <!-- Tanggal Publish, Jam, Urutan -->
      <div class="form-section">
        <label class="form-label">Tanggal Publikasi</label>
        <input type="text" name="tanggal_publish" class="form-control tanggal" value="<?= date('d-m-Y') ?>">
        <small style="font-size:var(--font-xs);color:var(--muted);">Format: dd-mm-yyyy</small>
      </div>

      <div class="form-section">
        <label class="form-label">Jam Publikasi</label>
        <input type="text" name="jam" class="form-control jam" value="<?= date('H:i:s') ?>">
        <small style="font-size:var(--font-xs);color:var(--muted);">Format: HH:MM:SS</small>
      </div>

      <div class="form-section">
        <label class="form-label">Urutan</label>
        <input type="number" name="urutan" class="form-control" value="0" min="0">
        <small style="font-size:var(--font-xs);color:var(--muted);">Nomor urut tampil</small>
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="form-section mt-3">
      <label class="form-label">Ringkasan</label>
      <textarea name="ringkasan" class="form-control" rows="3" placeholder="Ringkasan singkat berita (opsional)"><?= set_value('ringkasan') ?></textarea>
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
      <textarea name="isi" class="form-control konten" rows="12" required><?= set_value('isi') ?></textarea>
    </div>

    <!-- SEO Keywords -->
    <div class="form-section mt-3">
      <label class="form-label">Keyword SEO</label>
      <textarea name="keywords" class="form-control" rows="2" placeholder="Kata kunci untuk pencarian Google"><?= set_value('keywords') ?></textarea>
    </div>

    <!-- Actions -->
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="reset" class="btn btn-secondary-action">
        <i class="fas fa-times"></i> Reset
      </button>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Berita
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>

<!-- Include Modals -->
<?php include('media.php'); ?>
<?php include('galeri.php'); ?>
<?php include('download.php'); ?>
