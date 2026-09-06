<!-- Student Selector -->
<div class="card-modern mb-4">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-search"></i> Pilih Siswa</h5>
  </div>
  <div class="card-modern-body">
    <form method="GET" action="<?= base_url('admin/tagihan/rekap') ?>">
      <div style="display:flex;gap:0.75rem;align-items:end;flex-wrap:wrap;">
        <div style="flex:1;min-width:300px;">
          <label style="font-size:var(--font-sm);font-weight:600;color:var(--dark);display:block;margin-bottom:0.35rem;">
            Pilih Siswa
          </label>
          <select name="id_siswa" class="form-select" required style="width:100%;">
            <option value="">— Pilih Siswa —</option>
            <?php foreach ($siswa_list as $s): ?>
              <option value="<?= esc($s['id_siswa']) ?>"
                <?= (($id_siswa ?? '') == $s['id_siswa']) ? 'selected' : '' ?>>
                <?= esc($s['nama_siswa']) ?> — <?= esc($s['nama_kelas']) ?> (<?= esc($s['nama_jenjang']) ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <button type="submit" class="btn btn-action btn-primary-action">
            <i class="fas fa-search"></i> Lihat Rekap
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php if ($tagihan): ?>
<!-- Summary -->
<div class="summary-row">
  <div class="summary-item-card">
    <div class="summary-icon blue"><i class="fas fa-file-invoice"></i></div>
    <div class="summary-text">
      <div class="summary-label">Total Tagihan</div>
      <div class="summary-value">Rp <?= number_format($summary->grand_total ?? 0, 0, ',', '.') ?></div>
      <div class="summary-sub"><?= $summary->total_tagihan ?? 0 ?> tagihan</div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon green"><i class="fas fa-check-circle"></i></div>
    <div class="summary-text">
      <div class="summary-label">Sudah Dibayar</div>
      <div class="summary-value">Rp <?= number_format($summary->total_dibayar ?? 0, 0, ',', '.') ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon red"><i class="fas fa-exclamation-circle"></i></div>
    <div class="summary-text">
      <div class="summary-label">Belum Dibayar</div>
      <div class="summary-value">Rp <?= number_format($summary->total_sisa ?? 0, 0, ',', '.') ?></div>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card-modern">
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern">
        <thead>
          <tr>
            <th width="5%" class="text-center">No</th>
            <th>Biaya</th>
            <th class="text-center">Periode</th>
            <th class="text-right">Nominal</th>
            <th class="text-center">Status</th>
            <th class="text-center">Tanggal Bayar</th>
            <th>Verifikasi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($tagihan as $t): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><strong><?= esc($t['nama_biaya']) ?></strong></td>
            <td class="text-center">
              <?php
              $nama_bulan = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
              echo $nama_bulan[$t['bulan']] . ' ' . esc($t['tahun']);
              ?>
            </td>
            <td class="text-right">
              <span class="amount-display-sm">Rp <?= number_format($t['nominal_tagihan'], 0, ',', '.') ?></span>
            </td>
            <td class="text-center">
              <?php if ($t['status'] === 'Lunas'): ?>
                <span class="status-badge status-success"><i class="fas fa-check"></i> Lunas</span>
              <?php else: ?>
                <span class="status-badge status-danger"><i class="fas fa-clock"></i> Belum</span>
              <?php endif; ?>
            </td>
            <td class="text-center"><?= esc($t['tanggal_bayar'] ?? '-') ?></td>
            <td><?= esc($t['admin_verifikasi'] ?? '-') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php endif; ?>
