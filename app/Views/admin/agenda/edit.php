<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/agenda') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($agenda['nama_agenda']) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/agenda/edit/'.$agenda['id_agenda'])) ?>

    <!-- Section 1: Info Dasar -->
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-info-circle"></i> Informasi Dasar
    </h6>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Nama Agenda / Even <span class="text-danger">*</span></label>
        <input type="text" name="nama_agenda" class="form-control" value="<?= esc($agenda['nama_agenda']) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Kode Agenda <span class="text-danger">*</span></label>
        <input type="text" name="kode_agenda" class="form-control text-uppercase" value="<?= esc($agenda['kode_agenda']) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="id_kategori_agenda" class="form-select" required>
          <?php foreach($kategori_agenda as $ka): ?>
          <option value="<?= esc($ka['id_kategori_agenda']) ?>" <?= ($ka['id_kategori_agenda'] == $agenda['id_kategori_agenda']) ? 'selected' : '' ?>>
            <?= esc($ka['nama_kategori_agenda']) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_agenda" class="form-select">
          <option value="Publish" <?= ($agenda['status_agenda'] == 'Publish') ? 'selected' : '' ?>>Published</option>
          <option value="Draft" <?= ($agenda['status_agenda'] == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Pendaftaran</label>
        <select name="status_pendaftaran" class="form-select">
          <option value="Buka" <?= ($agenda['status_pendaftaran'] == 'Buka') ? 'selected' : '' ?>>Buka</option>
          <option value="Tutup" <?= ($agenda['status_pendaftaran'] == 'Tutup') ? 'selected' : '' ?>>Tutup</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Urutan</label>
        <input type="number" name="urutan" class="form-control" value="<?= esc($agenda['urutan']) ?>" min="0">
      </div>
    </div>

    <!-- Gambar -->
    <div class="form-section mt-3">
      <label class="form-label">Gambar</label>
      <?php if(!empty($agenda['gambar'])): ?>
      <div class="mb-2">
        <img src="<?= base_url('assets/upload/image/thumbs/'.$agenda['gambar']) ?>" class="berita-thumb" alt="" style="width:80px;height:80px;">
      </div>
      <?php endif; ?>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.svg">
      <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
    </div>

    <!-- Section 2: Biaya & Tanggal -->
    <hr style="margin:1.5rem 0;border-color:var(--border);">
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-money-bill-wave"></i> Biaya & Periode
    </h6>

    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Biaya Normal <span class="text-danger">*</span></label>
        <input type="number" name="harga" class="form-control" value="<?= esc($agenda['harga']) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Biaya Diskon <span class="text-danger">*</span></label>
        <input type="number" name="harga_diskon" class="form-control" value="<?= esc($agenda['harga_diskon']) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Buka Pendaftaran</label>
        <input type="text" name="tanggal_buka" class="form-control tanggal" value="<?= date('d-m-Y', strtotime($agenda['tanggal_buka'])) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Tutup Pendaftaran</label>
        <input type="text" name="tanggal_tutup" class="form-control tanggal" value="<?= date('d-m-Y', strtotime($agenda['tanggal_tutup'])) ?>">
      </div>
    </div>

    <div class="form-grid mt-3">
      <div class="form-section">
        <label class="form-label">Tanggal Mulai Diskon</label>
        <div class="d-flex gap-2">
          <input type="text" name="tanggal_mulai" class="form-control tanggal" value="<?= date('d-m-Y', strtotime($agenda['tanggal_mulai'])) ?>">
          <input type="text" name="jam_mulai" class="form-control jam" value="<?= date('H:i:s', strtotime($agenda['tanggal_mulai'])) ?>" style="max-width:100px;">
        </div>
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Selesai Diskon</label>
        <div class="d-flex gap-2">
          <input type="text" name="tanggal_selesai" class="form-control tanggal" value="<?= date('d-m-Y', strtotime($agenda['tanggal_selesai'])) ?>">
          <input type="text" name="jam_selesai" class="form-control jam" value="<?= date('H:i:s', strtotime($agenda['tanggal_selesai'])) ?>" style="max-width:100px;">
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
        <input type="text" name="nama_tempat" class="form-control" value="<?= esc($agenda['nama_tempat']) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Link Google Map <span class="text-danger">*</span></label>
        <input type="text" name="link_google_map" class="form-control" value="<?= esc($agenda['link_google_map']) ?>" required>
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Alamat Lengkap</label>
      <textarea name="alamat" class="form-control" rows="2"><?= esc($agenda['alamat']) ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Iframe Google Map</label>
      <textarea name="google_map" class="form-control" rows="3"><?= esc($agenda['google_map']) ?></textarea>
    </div>

    <!-- Section 4: Deskripsi -->
    <hr style="margin:1.5rem 0;border-color:var(--border);">
    <h6 style="font-size:0.85rem;font-weight:600;color:var(--green);margin-bottom:1rem;text-transform:uppercase;letter-spacing:0.03em;">
      <i class="fas fa-align-left"></i> Deskripsi & Konten
    </h6>

    <div class="form-section">
      <label class="form-label">Deskripsi Ringkas</label>
      <textarea name="deskripsi" class="form-control" rows="3"><?= esc($agenda['deskripsi']) ?></textarea>
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
      <textarea name="isi" class="form-control konten" rows="10"><?= esc($agenda['isi']) ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Keywords SEO</label>
      <textarea name="keywords" class="form-control" rows="2"><?= esc($agenda['keywords']) ?></textarea>
    </div>

    <!-- Actions -->
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/agenda') ?>" class="btn btn-secondary-action">
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
<?php echo view('admin/berita/media'); ?>
<?php echo view('admin/berita/galeri'); ?>
<?php echo view('admin/berita/download'); ?>
