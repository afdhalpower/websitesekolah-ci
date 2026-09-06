<div class="mb-3">
  <button type="button" class="btn btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Download Baru
  </button>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius:var(--radius-lg);border:none;">
      <div class="modal-header" style="background:var(--primary);color:#fff;border-radius:var(--radius-lg) var(--radius-lg) 0 0;padding:1rem 1.5rem;">
        <h5 class="modal-title"><i class="fas fa-download"></i> Tambah Download Baru</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open(base_url('admin/download/tambah'), 'enctype="multipart/form-data"') ?>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Judul Download <span class="text-danger">*</span></label>
            <input type="text" name="judul_download" class="form-control" value="<?= set_value('judul_download') ?>" required placeholder="Judul file download">
          </div>
          <div class="form-section">
            <label class="form-label">Upload File</label>
            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
            <small style="font-size:var(--font-xs);color:var(--muted);">Format: PDF, DOC, DOCX, XLS, XLSX, PPT, ZIP, RAR, JPG, PNG. Maks 24MB.</small>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Kategori</label>
            <select name="id_kategori_download" class="form-select">
              <?php foreach($kategori_download as $kd): ?>
              <option value="<?= esc($kd->id_kategori_download) ?>"><?= esc($kd->nama_kategori_download) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Jenis Konten</label>
            <select name="jenis_download" class="form-select">
              <option value="Download">Download</option>
              <option value="Panduan">Panduan</option>
              <option value="Member">Member</option>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Status Publikasi</label>
            <select name="status_download" class="form-select">
              <option value="Publish">Publish</option>
              <option value="Draft">Draft</option>
            </select>
          </div>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Isi/Deskripsi</label>
          <textarea name="isi" class="form-control konten" rows="5" placeholder="Deskripsi file download..."><?= set_value('isi') ?></textarea>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Link/URL</label>
          <input type="text" name="website" class="form-control" value="<?= set_value('website') ?>" placeholder="https://...">
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
