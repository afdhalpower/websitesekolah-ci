<!-- Generate Modal (kept as modal — quick action) -->
<?php include('generate_modal.php'); ?>

<!-- Summary Cards -->
<div class="summary-row">
  <div class="summary-item-card">
    <div class="summary-icon blue"><i class="fas fa-file-invoice"></i></div>
    <div class="summary-text">
      <div class="summary-label">Total Tagihan</div>
      <div class="summary-value"><?= $stats->total_tagihan ?? 0 ?></div>
      <div class="summary-sub">Rp <?= number_format($stats->grand_total ?? 0, 0, ',', '.') ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon green"><i class="fas fa-check-circle"></i></div>
    <div class="summary-text">
      <div class="summary-label">Lunas</div>
      <div class="summary-value"><?= $stats->lunas ?? 0 ?></div>
      <div class="summary-sub">Rp <?= number_format($stats->total_dibayar ?? 0, 0, ',', '.') ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon red"><i class="fas fa-exclamation-circle"></i></div>
    <div class="summary-text">
      <div class="summary-label">Belum Bayar</div>
      <div class="summary-value"><?= $stats->belum ?? 0 ?></div>
      <div class="summary-sub">Rp <?= number_format(($stats->grand_total ?? 0) - ($stats->total_dibayar ?? 0), 0, ',', '.') ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon purple"><i class="fas fa-ban"></i></div>
    <div class="summary-text">
      <div class="summary-label">Dibatalkan</div>
      <div class="summary-value"><?= $stats->dibatalkan ?? 0 ?></div>
    </div>
  </div>
</div>

<!-- Filter -->
<div class="card-modern mb-4">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-filter"></i> Filter</h5>
  </div>
  <div class="card-modern-body">
    <form method="GET" action="<?= base_url('admin/tagihan') ?>">
      <div class="filter-bar">
        <select name="status" class="form-select">
          <option value="">Semua Status</option>
          <option value="Belum" <?= (($filters['status'] ?? '') === 'Belum') ? 'selected' : '' ?>>Belum Bayar</option>
          <option value="Lunas" <?= (($filters['status'] ?? '') === 'Lunas') ? 'selected' : '' ?>>Lunas</option>
          <option value="Dibatalkan" <?= (($filters['status'] ?? '') === 'Dibatalkan') ? 'selected' : '' ?>>Dibatalkan</option>
        </select>
        <select name="id_kelas" class="form-select">
          <option value="">Semua Kelas</option>
          <?php foreach ($kelas as $k): ?>
            <option value="<?= esc($k->id_kelas) ?>" <?= (($filters['id_kelas'] ?? '') == $k->id_kelas) ? 'selected' : '' ?>>
              <?= esc($k->nama_kelas) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <select name="bulan" class="form-select">
          <option value="">Semua Bulan</option>
          <?php
          $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
          for ($i = 1; $i <= 12; $i++):
          ?>
            <option value="<?= $i ?>" <?= (($filters['bulan'] ?? '') == $i) ? 'selected' : '' ?>><?= $nama_bulan[$i-1] ?></option>
          <?php endfor; ?>
        </select>
        <select name="tahun" class="form-select">
          <option value="">Semua Tahun</option>
          <?php for ($y = date('Y'); $y >= 2020; $y--): ?>
            <option value="<?= $y ?>" <?= (($filters['tahun'] ?? '') == $y) ? 'selected' : '' ?>><?= $y ?></option>
          <?php endfor; ?>
        </select>
        <button type="submit" class="btn btn-action btn-primary-action">
          <i class="fas fa-search"></i> Filter
        </button>
        <a href="<?= base_url('admin/tagihan') ?>" class="btn btn-action btn-secondary-action">
          <i class="fas fa-times"></i> Reset
        </a>
      </div>
    </form>
  </div>
</div>

<!-- Table -->
<?php if (empty($tagihan)): ?>
<div class="card-modern">
  <div class="card-modern-body">
    <div class="empty-state">
      <i class="fas fa-file-invoice"></i>
      <div class="empty-state-title">Tidak ada tagihan ditemukan</div>
      <div class="empty-state-desc">Coba ubah filter atau generate tagihan baru.</div>
    </div>
  </div>
</div>
<?php else: ?>
<div class="card-modern">
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="5%" class="text-center">No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Biaya</th>
            <th class="text-center">Periode</th>
            <th class="text-right">Nominal</th>
            <th class="text-center">Status</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($tagihan as $t): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><strong><?= esc($t['nama_siswa']) ?></strong></td>
            <td><?= esc($t['nama_kelas']) ?></td>
            <td><?= esc($t['nama_biaya']) ?></td>
            <td class="text-center">
              <?php
              $nama_bulan_s = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
              echo $nama_bulan_s[$t['bulan']] . ' ' . esc($t['tahun']);
              ?>
            </td>
            <td class="text-right">
              <span class="amount-display-sm">Rp <?= number_format($t['nominal_tagihan'], 0, ',', '.') ?></span>
            </td>
            <td class="text-center">
              <?php if ($t['status'] === 'Lunas'): ?>
                <span class="status-badge status-success"><i class="fas fa-check"></i> Lunas</span>
              <?php elseif ($t['status'] === 'Dibatalkan'): ?>
                <span class="status-badge status-secondary"><i class="fas fa-ban"></i> Dibatalkan</span>
              <?php else: ?>
                <span class="status-badge status-danger"><i class="fas fa-clock"></i> Belum</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="table-actions">
                <a href="<?= base_url('admin/tagihan/bayar/' . $t['id_tagihan']) ?>"
                   class="btn btn-action <?= $t['status'] === 'Belum' ? 'btn-success-action' : 'btn-secondary-action' ?>"
                   title="<?= $t['status'] === 'Belum' ? 'Bayar' : 'Lihat Detail' ?>">
                  <i class="fas <?= $t['status'] === 'Belum' ? 'fa-money-bill' : 'fa-eye' ?>"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php endif; ?>
