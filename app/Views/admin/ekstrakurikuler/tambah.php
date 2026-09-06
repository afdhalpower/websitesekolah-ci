<div class="mb-3">
  <button type="button" class="btn btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Ekstrakurikuler Baru
  </button>
</div>

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="border-radius:var(--radius-lg);border:none;">
      <div class="modal-header" style="background:var(--primary);color:#fff;border-radius:var(--radius-lg) var(--radius-lg) 0 0;padding:1rem 1.5rem;">
        <h5 class="modal-title"><i class="fas fa-running"></i> Tambah Ekstrakurikuler Baru</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open(base_url('admin/ekstrakurikuler/tambah'), 'enctype="multipart/form-data"') ?>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Judul Ekstrakurikuler <span class="text-danger">*</span></label>
            <input type="text" name="judul_ekstrakurikuler" class="form-control" value="<?= set_value('judul_ekstrakurikuler') ?>" required placeholder="Nama kegiatan ekstrakurikuler">
          </div>
          <div class="form-section">
            <label class="form-label">Penanggung Jawab</label>
            <input type="text" name="nama_penanggung_jawab" class="form-control" value="<?= set_value('nama_penanggung_jawab') ?>" placeholder="Nama pembina/penanggung jawab">
          </div>
        </div>

        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Kategori</label>
            <select name="id_kategori_ekstrakurikuler" class="form-select select2">
              <?php foreach($kategori_ekstrakurikuler as $ke): ?>
              <option value="<?= esc($ke->id_kategori_ekstrakurikuler) ?>"><?= esc($ke->nama_kategori_ekstrakurikuler) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-section">
            <label class="form-label">Status Publikasi</label>
            <select name="status_ekstrakurikuler" class="form-select">
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

        <div class="form-section mt-3">
          <label class="form-label">Upload Gambar</label>
          <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
          <small style="font-size:var(--font-xs);color:var(--muted);">Format: JPG, PNG, GIF, WEBP. Maks 5MB.</small>
        </div>

        <div class="form-section mt-3">
          <label class="form-label">Isi Ekstrakurikuler</label>
          <textarea name="isi" class="form-control konten" rows="5" placeholder="Deskripsi kegiatan ekstrakurikuler..."><?= set_value('isi') ?></textarea>
        </div>

        <div class="form-grid">
          <div class="form-section mt-3">
            <label class="form-label">Text Tombol Link</label>
            <input type="text" name="text_website" class="form-control" value="<?= set_value('text_website') ?>" placeholder="Teks untuk tombol link">
          </div>
          <div class="form-section mt-3">
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
