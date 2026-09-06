<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/galeri') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Flash Messages -->
<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-plus-circle"></i> Tambah Gambar Galeri</h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/galeri/tambah')) ?>

    <div class="form-grid">
      <!-- Judul -->
      <div class="form-section">
        <label class="form-label">Judul Galeri <span class="text-danger">*</span></label>
        <input type="text" name="judul_galeri" class="form-control" value="<?= set_value('judul_galeri') ?>" required placeholder="Masukkan judul gambar">
      </div>

      <!-- Gambar -->
      <div class="form-section">
        <label class="form-label">Upload Gambar <span class="text-danger">*</span></label>
        <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF, WEBP. Maks 5MB.</small>
      </div>

      <!-- Kategori -->
      <div class="form-section">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="id_kategori_galeri" class="form-select" required>
          <?php foreach($kategori_galeri as $kg): ?>
          <option value="<?= esc($kg->id_kategori_galeri) ?>"><?= esc($kg->nama_kategori_galeri) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Jenis -->
      <div class="form-section">
        <label class="form-label">Jenis Galeri <span class="text-danger">*</span></label>
        <select name="jenis_galeri" class="form-select" required>
          <option value="Galeri">Galeri</option>
          <option value="Homepage">Homepage Slider</option>
          <option value="Header">Header Halaman</option>
          <option value="Pop Up">Pop Up Homepage</option>
        </select>
      </div>

      <!-- Status Text -->
      <div class="form-section">
        <label class="form-label">Status Teks</label>
        <select name="status_text" class="form-select">
          <option value="Ya">Aktif</option>
          <option value="Tidak">Tidak Aktif</option>
        </select>
      </div>
    </div>

    <!-- Isi Galeri -->
    <div class="form-section mt-3">
      <label class="form-label">Isi / Deskripsi Galeri</label>
      <textarea name="isi" class="form-control konten" rows="6" placeholder="Deskripsi singkat gambar"><?= set_value('isi') ?></textarea>
    </div>

    <!-- Text & Link -->
    <div class="form-grid mt-3">
      <div class="form-section">
        <label class="form-label">Teks Tombol Link</label>
        <input type="text" name="text_website" class="form-control" value="<?= set_value('text_website') ?>" placeholder="Contoh: Selengkapnya">
      </div>
      <div class="form-section">
        <label class="form-label">URL Link</label>
        <input type="text" name="website" class="form-control" value="<?= set_value('website') ?>" placeholder="https://...">
      </div>
    </div>

    <!-- Actions -->
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/galeri') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Gambar
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
