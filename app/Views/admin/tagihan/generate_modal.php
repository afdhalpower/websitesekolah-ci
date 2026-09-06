<!-- Button Generate + Link Rekap -->
<div class="mb-4" style="display:flex;gap:0.75rem;flex-wrap:wrap;">
  <button type="button" class="btn btn-action btn-primary-action" data-toggle="modal" data-target="#modal-generate">
    <i class="fas fa-cogs"></i> Generate Tagihan
  </button>
  <a href="<?= base_url('admin/tagihan/rekap') ?>" class="btn btn-action btn-info-action">
    <i class="fas fa-file-invoice-dollar"></i> Rekap Per Siswa
  </a>
</div>

<?php echo form_open(base_url('admin/tagihan/generate')); ?>
<?php echo csrf_field(); ?>
<div class="modal fade" id="modal-generate">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:var(--green);color:#fff;padding:1rem 1.25rem;">
        <h5 class="modal-title" style="font-size:var(--font-lg);font-weight:700;">
          <i class="fas fa-cogs"></i> Generate Tagihan Bulanan
        </h5>
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:0.8;">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-grid">
          <label>Tahun Ajaran <span style="color:var(--red)">*</span></label>
          <div>
            <select name="id_tahun" class="form-select" required>
              <option value="">— Pilih Tahun Ajaran —</option>
              <?php foreach ($tahun as $t): ?>
                <option value="<?= esc($t->id_tahun) ?>"><?= esc($t->nama_tahun) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <label>Bulan <span style="color:var(--red)">*</span></label>
          <div>
            <select name="bulan" class="form-select" required>
              <option value="">— Pilih Bulan —</option>
              <?php
              $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
              for ($i = 1; $i <= 12; $i++):
                $selected = ($i == (int)date('m')) ? 'selected' : '';
              ?>
                <option value="<?= $i ?>" <?= $selected ?>><?= $nama_bulan[$i-1] ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <label>Tahun <span style="color:var(--red)">*</span></label>
          <div>
            <input type="number" name="tahun" class="form-control" required
                   value="<?= date('Y') ?>" min="2020" max="2050">
          </div>
        </div>
        <div style="background:rgba(29,78,216,0.08);border:1px solid rgba(29,78,216,0.2);border-radius:var(--radius);padding:1rem;margin-top:1rem;display:flex;gap:0.75rem;align-items:start;">
          <i class="fas fa-info-circle" style="color:var(--blue);margin-top:0.15rem;"></i>
          <span style="font-size:var(--font-sm);color:var(--dark-soft);">
            Tagihan akan digenerate untuk semua siswa aktif. Siswa yang sudah memiliki tagihan bulan ini akan dilewati.
          </span>
        </div>
      </div>
      <div class="modal-footer" style="padding:1rem 1.25rem;border-top:1px solid var(--border);">
        <button type="button" class="btn btn-action btn-secondary-action" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-action btn-primary-action">
          <i class="fas fa-cogs"></i> Generate
        </button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
