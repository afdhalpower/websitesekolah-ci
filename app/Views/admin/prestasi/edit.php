<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/prestasi') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($prestasi->judul_prestasi) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/prestasi/edit/'.$prestasi->id_prestasi)) ?>

    <h6 style="color:var(--primary);font-weight:600;margin-bottom:1rem;"><i class="fas fa-info-circle"></i> Informasi Prestasi</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Judul Prestasi <span class="text-danger">*</span></label>
        <input type="text" name="judul_prestasi" class="form-control" value="<?= esc($prestasi->judul_prestasi) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Nama Penerima</label>
        <input type="text" name="nama_penerima" class="form-control" value="<?= esc($prestasi->nama_penerima) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Penyelenggara</label>
        <input type="text" name="penyelenggara" class="form-control" value="<?= esc($prestasi->penyelenggara) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Hadiah/Penghargaan</label>
        <input type="text" name="hadiah_prestasi" class="form-control" value="<?= esc($prestasi->hadiah_prestasi) ?>">
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-calendar-alt"></i> Waktu & Level</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Jenjang</label>
        <select name="jenjang_prestasi" class="form-select">
          <?php foreach(['Sekolah','Kelurahan','Kecamatan','Kabupaten','Provinsi','Nasional','Internasional'] as $j): ?>
          <option value="<?= $j ?>" <?= ($prestasi->jenjang_prestasi == $j) ? 'selected' : '' ?>><?= $j ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun_prestasi" class="form-control" value="<?= esc($prestasi->tahun_prestasi) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Prestasi</label>
        <input type="text" name="tanggal_prestasi" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($prestasi->tanggal_prestasi)) ?>">
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-tags"></i> Kategori & Status</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Kategori</label>
        <select name="id_kategori_prestasi" class="form-select select2">
          <?php foreach($kategori_prestasi as $kp): ?>
          <option value="<?= esc($kp->id_kategori_prestasi) ?>" <?= ($kp->id_kategori_prestasi == $prestasi->id_kategori_prestasi) ? 'selected' : '' ?>>
            <?= esc($kp->nama_kategori_prestasi) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Publikasi</label>
        <select name="status_prestasi" class="form-select">
          <option value="Publish" <?= ($prestasi->status_prestasi == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($prestasi->status_prestasi == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status Teks Slider</label>
        <select name="status_text" class="form-select">
          <option value="Ya" <?= ($prestasi->status_text == 'Ya') ? 'selected' : '' ?>>Aktif</option>
          <option value="Tidak" <?= ($prestasi->status_text == 'Tidak') ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-image"></i> Gambar</h6>
    <div class="form-section">
      <label class="form-label">Upload Gambar</label>
      <?php if($prestasi->gambar != ''): ?>
      <div class="mb-2">
        <img src="<?= base_url('assets/upload/image/thumbs/'.$prestasi->gambar) ?>" style="width:80px;height:60px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
      </div>
      <?php endif; ?>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
      <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti gambar</small>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-align-left"></i> Konten</h6>
    <div class="form-section">
      <label class="form-label">Isi Prestasi</label>
      <textarea name="isi" class="form-control konten" rows="5"><?= esc($prestasi->isi) ?></textarea>
    </div>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Text Tombol Link</label>
        <input type="text" name="text_website" class="form-control" value="<?= esc($prestasi->text_website) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Link/URL</label>
        <input type="text" name="website" class="form-control" value="<?= esc($prestasi->website) ?>">
      </div>
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/prestasi') ?>" class="btn btn-secondary-action">
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
