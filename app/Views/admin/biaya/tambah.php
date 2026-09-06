<!-- Back -->
<div class="mb-3">
  <a href="<?= base_url('admin/biaya') ?>" class="btn btn-action btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Biaya
  </a>
</div>

<!-- Form Card -->
<div class="form-card">
  <div class="form-card-header">
    <i class="fas fa-plus-circle"></i>
    <h5 class="form-card-title">Tambah Biaya Pendidikan</h5>
  </div>
  <?php echo form_open(base_url('admin/biaya/tambah')); ?>
  <?php echo csrf_field(); ?>
  <div class="form-card-body">
    <div class="form-grid">
      <label>Jenjang <span style="color:var(--red)">*</span></label>
      <div>
        <select name="id_jenjang" class="form-select" required>
          <option value="">— Pilih Jenjang —</option>
          <?php foreach ($jenjang as $j): ?>
            <option value="<?= esc($j->id_jenjang) ?>">
              <?= esc($j->nama_jenjang) ?> — <?= esc($j->keterangan) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <label>Nama Biaya <span style="color:var(--red)">*</span></label>
      <div>
        <input type="text" name="nama_biaya" class="form-control" required
               placeholder="Contoh: SPP Bulanan PAUD">
      </div>

      <label>Nominal (Rp) <span style="color:var(--red)">*</span></label>
      <div>
        <input type="number" name="nominal" class="form-control" required min="0"
               placeholder="500000">
      </div>

      <label>Periode <span style="color:var(--red)">*</span></label>
      <div>
        <select name="periode" class="form-select" required>
          <option value="Bulanan">Bulanan</option>
          <option value="Tahunan">Tahunan</option>
        </select>
      </div>

      <label>Tahun Mulai <span style="color:var(--red)">*</span></label>
      <div>
        <input type="number" name="tahun_mulai" class="form-control" required
               value="<?= date('Y') ?>" min="2020" max="2050">
      </div>

      <label>Tahun Selesai</label>
      <div>
        <input type="number" name="tahun_selesai" class="form-control"
               placeholder="Kosongkan jika masih aktif" min="2020" max="2050">
      </div>

      <label>Status</label>
      <div>
        <select name="status" class="form-select">
          <option value="Aktif">Aktif</option>
          <option value="Non Aktif">Non Aktif</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-card-footer">
    <a href="<?= base_url('admin/biaya') ?>" class="btn btn-action btn-secondary-action">
      <i class="fas fa-arrow-left"></i> Batal
    </a>
    <button type="submit" class="btn btn-action btn-primary-action">
      <i class="fas fa-save"></i> Simpan Biaya
    </button>
  </div>
  <?php echo form_close(); ?>
</div>
