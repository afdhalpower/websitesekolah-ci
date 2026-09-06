<div class="mb-3">
  <button type="button" class="btn btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Prestasi Baru
  </button>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="border-radius:var(--radius-lg);border:none;">
      <div class="modal-header" style="background:var(--primary);color:#fff;border-radius:var(--radius-lg) var(--radius-lg) 0 0;padding:1rem 1.5rem;">
        <h5 class="modal-title"><i class="fas fa-trophy"></i> Tambah Prestasi Baru</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open(base_url('admin/prestasi/tambah'), 'enctype="multipart/form-data"') ?>
      <div class="modal-body" style="padding:1.5rem;">
        <h6 style="color:var(--primary);font-weight:600;margin-bottom:1rem;"><i class="fas fa-info-circle"></i> Informasi Prestasi</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Judul Prestasi <span class="text-danger">*</span></label>
            <input type="text" name="judul_prestasi" class="form-control" value="<?= set_value('judul_prestasi') ?>" required placeholder="Judul prestasi">
          </div>
          <div class="form-section">
            <label class="form-label">Nama Penerima</label>
            <input type="text" name="nama_penerima" class="form-control" value="<?= set_value('nama_penerima') ?>" placeholder="Nama penerima prestasi">
          </div>
          <div class="form-section">
            <label class="form-label">Penyelenggara</label>
            <input type="text" name="penyelenggara" class="form-control" value="<?= set_value('penyelenggara') ?>" placeholder="Penyelenggara kegiatan">
          </div>
          <div class="form-section">
            <label class="form-label">Hadiah/Penghargaan</label>
            <input type="text" name="hadiah_prestasi" class="form-control" value="<?= set_value('hadiah_prestasi') ?>" placeholder="Piala, Uang Tunai, dll">
          </div>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-calendar-alt"></i> Waktu & Level</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Jenjang</label>
            <select name="jenjang_prestasi" class="form-select">
              <option value="Sekolah">Sekolah</option>
              <option value="Kelurahan">Kelurahan</option>
              <option value="Kecamatan">Kecamatan</option>
              <option value="Kabupaten">Kabupaten</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Nasional">Nasional</option>
              <option value="Internasional">Internasional</option>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun_prestasi" class="form-control" value="<?= set_value('tahun_prestasi', date('Y')) ?>">
          </div>
          <div class="form-section">
            <label class="form-label">Tanggal Prestasi</label>
            <input type="text" name="tanggal_prestasi" class="form-control tanggal" value="<?= set_value('tanggal_prestasi', date('d-m-Y')) ?>">
          </div>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-tags"></i> Kategori & Status</h6>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Kategori</label>
            <select name="id_kategori_prestasi" class="form-select select2">
              <?php foreach($kategori_prestasi as $kp): ?>
              <option value="<?= esc($kp->id_kategori_prestasi) ?>"><?= esc($kp->nama_kategori_prestasi) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Status Publikasi</label>
            <select name="status_prestasi" class="form-select">
              <option value="Publish">Publish</option>
              <option value="Draft">Draft</option>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Status Teks Slider</label>
            <select name="status_text" class="form-select">
              <option value="Ya">Aktif</option>
              <option value="Tidak">Tidak Aktif</option>
            </select>
          </div>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-image"></i> Gambar</h6>
        <div class="form-section">
          <label class="form-label">Upload Gambar</label>
          <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
          <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF, WEBP. Maks 5MB.</small>
        </div>

        <h6 style="color:var(--primary);font-weight:600;margin:1.2rem 0 0.8rem;"><i class="fas fa-align-left"></i> Konten</h6>
        <div class="form-section">
          <label class="form-label">Isi Prestasi</label>
          <textarea name="isi" class="form-control konten" rows="5" placeholder="Isi konten prestasi..."><?= set_value('isi') ?></textarea>
        </div>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Text Tombol Link</label>
            <input type="text" name="text_website" class="form-control" value="<?= set_value('text_website') ?>" placeholder="Teks untuk tombol link">
          </div>
          <div class="form-section">
            <label class="form-label">Link/URL</label>
            <input type="text" name="website" class="form-control" value="<?= set_value('website') ?>" placeholder="https://...">
          </div>
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
