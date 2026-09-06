<div class="mb-3">
  <button type="button" class="btn btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Video Baru
  </button>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="border-radius:var(--radius-lg);border:none;">
      <div class="modal-header" style="background:var(--primary);color:#fff;border-radius:var(--radius-lg) var(--radius-lg) 0 0;padding:1rem 1.5rem;">
        <h5 class="modal-title"><i class="fas fa-video"></i> Tambah Video Baru</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open(base_url('admin/video'), 'enctype="multipart/form-data"') ?>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Judul Video <span class="text-danger">*</span></label>
            <input type="text" name="judul" class="form-control" value="<?= set_value('judul') ?>" required placeholder="Judul video">
          </div>
          <div class="form-section">
            <label class="form-label">Kode Video YouTube</label>
            <input type="text" name="video" class="form-control" value="<?= set_value('video') ?>" placeholder="cxLeZXObWDA" required>
            <small style="font-size:var(--font-xs);color:var(--muted);">Bagian ID dari link YouTube. Contoh: <strong>youtu.be/cxLeZXObWDA</strong> → isi cxLeZXObWDA</small>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Upload Thumbnail</label>
            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
            <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF. Maks 5MB.</small>
          </div>
          <div class="form-section">
            <label class="form-label">Status Publikasi</label>
            <select name="status_video" class="form-select">
              <option value="Publish">Publish</option>
              <option value="Draft">Draft</option>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Posisi Video</label>
            <select name="posisi_video" class="form-select">
              <option value="Beranda">Beranda</option>
              <option value="Video">Galeri Video</option>
            </select>
          </div>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="3" placeholder="Deskripsi singkat video..."><?= set_value('keterangan') ?></textarea>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Urutan</label>
          <input type="number" name="urutan" class="form-control" value="<?= set_value('urutan') ?>" placeholder="Nomor urut tampil" style="max-width:200px;">
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
