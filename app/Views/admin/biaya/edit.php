<!-- Back -->
<div class="mb-3">
  <a href="<?= base_url('admin/biaya') ?>" class="btn btn-action btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Biaya
  </a>
</div>

<!-- Form Card -->
<div class="form-card">
  <div class="form-card-header">
    <i class="fas fa-pen"></i>
    <h5 class="form-card-title">Edit Biaya: <?= esc($biaya->nama_biaya) ?></h5>
  </div>
  <?php echo form_open(base_url('admin/biaya/edit/' . $biaya->id_biaya)); ?>
  <?php echo csrf_field(); ?>
  <div class="form-card-body">
    <div class="form-grid">
      <label>Jenjang <span style="color:var(--red)">*</span></label>
      <div>
        <select name="id_jenjang" class="form-select" required>
          <?php foreach ($jenjang as $j): ?>
            <option value="<?= esc($j->id_jenjang) ?>"
              <?php if ($j->id_jenjang == $biaya->id_jenjang) echo 'selected' ?>>
              <?= esc($j->nama_jenjang) ?> — <?= esc($j->keterangan) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <label>Nama Biaya <span style="color:var(--red)">*</span></label>
      <div>
        <input type="text" name="nama_biaya" class="form-control" required
               value="<?= esc($biaya->nama_biaya) ?>">
      </div>

      <label>Nominal (Rp) <span style="color:var(--red)">*</span></label>
      <div>
        <input type="number" name="nominal" class="form-control" required min="0"
               value="<?= esc($biaya->nominal) ?>">
      </div>

      <label>Periode <span style="color:var(--red)">*</span></label>
      <div>
        <select name="periode" class="form-select" required>
          <option value="Bulanan" <?= ($biaya->periode === 'Bulanan') ? 'selected' : '' ?>>Bulanan</option>
          <option value="Tahunan" <?= ($biaya->periode === 'Tahunan') ? 'selected' : '' ?>>Tahunan</option>
        </select>
      </div>

      <label>Tahun Mulai <span style="color:var(--red)">*</span></label>
      <div>
        <input type="number" name="tahun_mulai" class="form-control" required
               value="<?= esc($biaya->tahun_mulai) ?>">
      </div>

      <label>Tahun Selesai</label>
      <div>
        <input type="number" name="tahun_selesai" class="form-control"
               value="<?= esc($biaya->tahun_selesai ?? '') ?>"
               placeholder="Kosongkan jika masih aktif">
      </div>

      <label>Status</label>
      <div>
        <select name="status" class="form-select">
          <option value="Aktif" <?= ($biaya->status === 'Aktif') ? 'selected' : '' ?>>Aktif</option>
          <option value="Non Aktif" <?= ($biaya->status === 'Non Aktif') ? 'selected' : '' ?>>Non Aktif</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-card-footer">
    <a href="<?= base_url('admin/biaya') ?>" class="btn btn-action btn-secondary-action">
      <i class="fas fa-arrow-left"></i> Batal
    </a>
    <button type="submit" class="btn btn-action btn-primary-action">
      <i class="fas fa-save"></i> Simpan Perubahan
    </button>
  </div>
  <?php echo form_close(); ?>
</div>
