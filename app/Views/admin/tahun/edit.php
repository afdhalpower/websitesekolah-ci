<div class="mb-3">
  <a href="<?= base_url('admin/tahun') ?>" class="btn btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
  </a>
</div>

<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-edit"></i> Edit: <?= esc($tahun->nama_tahun) ?></h5>
  </div>
  <div class="card-modern-body">
    <?= form_open(base_url('admin/tahun/edit/'.$tahun->id_tahun)) ?>
    <div class="form-grid">
      <div class="form-section">
        <label class="form-label">Nama Tahun <span class="text-danger">*</span></label>
        <input type="text" name="nama_tahun" class="form-control" value="<?= esc($tahun->nama_tahun) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Tahun Mulai <span class="text-danger">*</span></label>
        <input type="number" name="tahun_mulai" class="form-control" value="<?= esc($tahun->tahun_mulai) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Tahun Selesai <span class="text-danger">*</span></label>
        <input type="number" name="tahun_selesai" class="form-control" value="<?= esc($tahun->tahun_selesai) ?>" required>
      </div>
      <div class="form-section">
        <label class="form-label">Keterangan <span class="text-danger">*</span></label>
        <textarea name="keterangan" class="form-control" rows="3" required><?= esc($tahun->keterangan) ?></textarea>
      </div>
    </div>
    <div class="form-actions mt-4">
      <a href="<?= base_url('admin/tahun') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Batal
      </a>
      <button type="submit" class="btn btn-success-action">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>
    <?= form_close() ?>
  </div>
</div>
