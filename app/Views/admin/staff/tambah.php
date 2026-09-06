<div class="mb-3">
  <button type="button" class="btn btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Staff Baru
  </button>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="border-radius:var(--radius-lg);border:none;">
      <div class="modal-header" style="background:var(--primary);color:#fff;border-radius:var(--radius-lg) var(--radius-lg) 0 0;padding:1rem 1.5rem;">
        <h5 class="modal-title"><i class="fas fa-users"></i> Tambah Staff Baru</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart(base_url('admin/staff/tambah')) ?>
      <div class="modal-body" style="padding:1.5rem;">
        <h6 style="color:var(--primary);font-weight:600;margin-bottom:1rem;"><i class="fas fa-user"></i> Data Diri</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Nama Staff <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" required placeholder="Nama lengkap staff">
          </div>
          <div class="form-section">
            <label class="form-label">Jenis Kelamin</label>
            <div class="d-flex gap-3" style="padding-top:0.5rem;">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="L" required>
                <label class="form-check-label" for="jkL">Laki-laki</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="P" required>
                <label class="form-check-label" for="jkP">Perempuan</label>
              </div>
            </div>
          </div>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-briefcase"></i> Jabatan & Kategori</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?= set_value('jabatan') ?>" placeholder="Jabatan staff">
          </div>
          <div class="form-section">
            <label class="form-label">No Urut</label>
            <input type="number" name="urutan" class="form-control" value="<?= set_value('urutan') ?>" placeholder="Nomor urut tampil">
          </div>
          <div class="form-section">
            <label class="form-label">Kategori Staff</label>
            <select name="id_kategori_staff" class="form-select">
              <?php foreach($kategori_staff as $ks): ?>
              <option value="<?= esc($ks->id_kategori_staff) ?>"><?= esc($ks->nama_kategori_staff) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Status</label>
            <select name="status_staff" class="form-select">
              <option value="Publish">Publish</option>
              <option value="Draft">Draft</option>
            </select>
          </div>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-calendar-alt"></i> Kelahiran</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir') ?>" placeholder="Kota kelahiran">
          </div>
          <div class="form-section">
            <label class="form-label">Tanggal Lahir</label>
            <input type="text" name="tanggal_lahir" class="form-control tanggal" value="<?= set_value('tanggal_lahir') ?>" placeholder="dd-mm-yyyy">
          </div>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-address-book"></i> Kontak</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" placeholder="Email staff">
          </div>
          <div class="form-section">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= set_value('telepon') ?>" placeholder="Nomor telepon">
          </div>
          <div class="form-section">
            <label class="form-label">Website</label>
            <input type="text" name="website" class="form-control" value="<?= set_value('website') ?>" placeholder="https://...">
          </div>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap..."><?= set_value('alamat') ?></textarea>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Keahlian</label>
          <textarea name="keahlian" class="form-control" rows="3" placeholder="Daftar keahlian staff..."><?= set_value('keahlian') ?></textarea>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-camera"></i> Foto Profil</h6>
        <div class="form-section">
          <label class="form-label">Upload Foto</label>
          <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
          <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF, WEBP. Maks 5MB.</small>
        </div>
      </div>
      <div class="modal-footer" style="border-top:1px solid var(--border);padding:1rem 1.5rem;">
        <button type="button" class="btn btn-secondary-action" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
        <button type="submit" class="btn btn-success-action"><i class="fas fa-save"></i> Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
