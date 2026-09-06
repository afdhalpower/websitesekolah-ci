<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/agenda') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-plus-circle"></i> Tambah Agenda / Even</h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/agenda/tambah')) ?>

    <!-- Section 1: Info Dasar -->
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-info-circle"></i> Informasi Dasar
    </h6>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Nama Agenda / Even <span class="text-danger">*</span></label>
        <input type="text" name="nama_agenda" class="form-control" value="<?= set_value('nama_agenda') ?>" required placeholder="Contoh: Seminar Parenting">
      </div>
      <div class="form-section">
        <label class="form-label">Kode Agenda <span class="text-danger">*</span></label>
        <input type="text" name="kode_agenda" class="form-control text-uppercase" value="<?= set_value('kode_agenda') ?>" required placeholder="Contoh: SEMPAR">
      </div>
      <div class="form-section">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="id_kategori_agenda" class="form-select" required>
          <?php foreach($kategori_agenda as $ka): ?>
          <option value="<?= esc($ka['id_kategori_agenda']) ?>"><?= esc($ka['nama_kategori_agenda']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_agenda" class="form-select">
          <option value="Publish">Published</option>
          <option value="Draft">Draft</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Pendaftaran</label>
        <select name="status_pendaftaran" class="form-select">
          <option value="Buka">Buka</option>
          <option value="Tutup">Tutup</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Urutan</label>
        <input type="number" name="urutan" class="form-control" value="<?= set_value('urutan') ?>" min="0">
      </div>
    </div>

    <!-- Gambar -->
    <div class="form-section mt-3">
      <label class="form-label">Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.svg">
      <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF, SVG</small>
    </div>

    <!-- Section 2: Biaya & Tanggal -->
    <hr style="margin:1.5rem 0;border-color:var(--border);">
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-money-bill-wave"></i> Biaya & Periode
    </h6>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Biaya Normal <span class="text-danger">*</span></label>
        <input type="number" name="harga" class="form-control" value="<?= set_value('harga') ?>" required placeholder="0">
      </div>
      <div class="form-section">
        <label class="form-label">Biaya Diskon <span class="text-danger">*</span></label>
        <input type="number" name="harga_diskon" class="form-control" value="<?= set_value('harga_diskon') ?>" required placeholder="0">
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Buka Pendaftaran <span class="text-danger">*</span></label>
        <input type="text" name="tanggal_buka" class="form-control tanggal" value="<?= set_value('tanggal_buka') ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Tutup Pendaftaran <span class="text-danger">*</span></label>
        <input type="text" name="tanggal_tutup" class="form-control tanggal" value="<?= set_value('tanggal_tutup') ?>">
      </div>
    </div>

    <div class="form-grid mt-3">
      <div class="form-section">
        <label class="form-label">Tanggal Mulai Diskon <span class="text-danger">*</span></label>
        <div class="d-flex gap-2">
          <input type="text" name="tanggal_mulai" class="form-control tanggal" value="<?= set_value('tanggal_mulai') ?>">
          <input type="text" name="jam_mulai" class="form-control jam" value="<?= set_value('jam_mulai') ?>" style="max-width:100px;">
        </div>
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Selesai Diskon <span class="text-danger">*</span></label>
        <div class="d-flex gap-2">
          <input type="text" name="tanggal_selesai" class="form-control tanggal" value="<?= set_value('tanggal_selesai') ?>">
          <input type="text" name="jam_selesai" class="form-control jam" value="<?= set_value('jam_selesai') ?>" style="max-width:100px;">
        </div>
      </div>
    </div>

    <!-- Section 3: Venue -->
    <hr style="margin:1.5rem 0;border-color:var(--border);">
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-map-marker-alt"></i> Venue / Tempat Pelaksanaan
    </h6>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Nama Tempat <span class="text-danger">*</span></label>
        <input type="text" name="nama_tempat" class="form-control" value="<?= set_value('nama_tempat') ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Link Google Map <span class="text-danger">*</span></label>
        <input type="text" name="link_google_map" class="form-control" value="<?= set_value('link_google_map') ?>" required>
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Alamat Lengkap</label>
      <textarea name="alamat" class="form-control" rows="2"><?= set_value('alamat') ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Iframe Google Map</label>
      <textarea name="google_map" class="form-control" rows="3" placeholder="Paste iframe embed code dari Google Maps"><?= set_value('google_map') ?></textarea>
    </div>

    <!-- Section 4: Deskripsi -->
    <hr style="margin:1.5rem 0;border-color:var(--border);">
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-align-left"></i> Deskripsi & Konten
    </h6>

    <div class="form-section">
      <label class="form-label">Deskripsi Ringkas</label>
      <textarea name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan singkat tentang agenda"><?= set_value('deskripsi') ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Deskripsi Lengkap</label>
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
      <textarea name="isi" class="form-control konten" rows="10" placeholder="Deskripsi lengkap agenda"><?= set_value('isi') ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Keywords SEO</label>
      <textarea name="keywords" class="form-control" rows="2" placeholder="Pisahkan dengan koma"><?= set_value('keywords') ?></textarea>
    </div>

    <!-- Actions -->
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/agenda') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="reset" class="btn btn-secondary-action">
        <i class="fas fa-times"></i> Reset
      </button>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Agenda
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>

<!-- Include Modals -->
<?php echo view('admin/berita/media'); ?>
<?php echo view('admin/berita/galeri'); ?>
<?php echo view('admin/berita/download'); ?>
