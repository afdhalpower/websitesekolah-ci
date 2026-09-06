<!-- Back Button -->
<div class="mb-3">
  <a href="<?= base_url('admin/staff') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<!-- Form Card -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($staff->nama) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open_multipart(base_url('admin/staff/edit/'.$staff->id_staff)) ?>

    <h6 style="color:var(--primary);font-weight:600;margin-bottom:1rem;"><i class="fas fa-user"></i> Data Diri</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Nama Staff <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" value="<?= esc($staff->nama) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Jenis Kelamin</label>
        <div class="d-flex gap-3" style="padding-top:0.5rem;">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="L" <?= ($staff->jenis_kelamin == 'L') ? 'checked' : '' ?> required>
            <label class="form-check-label" for="jkL">Laki-laki</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="P" <?= ($staff->jenis_kelamin == 'P') ? 'checked' : '' ?> required>
            <label class="form-check-label" for="jkP">Perempuan</label>
          </div>
        </div>
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-briefcase"></i> Jabatan & Kategori</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="<?= esc($staff->jabatan) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">No Urut</label>
        <input type="number" name="urutan" class="form-control" value="<?= esc($staff->urutan) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Kategori Staff</label>
        <select name="id_kategori_staff" class="form-select">
          <?php foreach($kategori_staff as $ks): ?>
          <option value="<?= esc($ks->id_kategori_staff) ?>" <?= ($ks->id_kategori_staff == $staff->id_kategori_staff) ? 'selected' : '' ?>>
            <?= esc($ks->nama_kategori_staff) ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-section">
        <label class="form-label">Status</label>
        <select name="status_staff" class="form-select">
          <option value="Publish" <?= ($staff->status_staff == 'Publish') ? 'selected' : '' ?>>Publish</option>
          <option value="Draft" <?= ($staff->status_staff == 'Draft') ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-calendar-alt"></i> Kelahiran</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" value="<?= esc($staff->tempat_lahir) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Tanggal Lahir</label>
        <input type="text" name="tanggal_lahir" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($staff->tanggal_lahir)) ?>">
      </div>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-address-book"></i> Kontak</h6>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= esc($staff->email) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="<?= esc($staff->telepon) ?>">
      </div>
      <div class="form-section">
        <label class="form-label">Website</label>
        <input type="text" name="website" class="form-control" value="<?= esc($staff->website) ?>">
      </div>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" rows="3"><?= esc($staff->alamat) ?></textarea>
    </div>

    <div class="form-section mt-3">
      <label class="form-label">Keahlian</label>
      <textarea name="keahlian" class="form-control" rows="3"><?= esc($staff->keahlian) ?></textarea>
    </div>

    <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-camera"></i> Foto Profil</h6>
    <div class="form-section">
      <label class="form-label">Upload Foto</label>
      <?php if($staff->gambar != ''): ?>
      <div class="mb-2">
        <img src="<?= base_url('assets/upload/staff/thumbs/'.$staff->gambar) ?>" style="width:80px;height:80px;object-fit:cover;border-radius:50%;border:1px solid var(--border);" alt="">
      </div>
      <?php endif; ?>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
      <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti foto</small>
    </div>

    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/staff') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <?= form_close() ?>
  </div>
</div>
