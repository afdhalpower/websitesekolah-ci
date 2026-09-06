<!-- Page Header -->
<div class="page-header-modern">
  <div class="page-header-left">
    <h5 class="page-title">Master Biaya Pendidikan</h5>
    <p class="page-subtitle">Kelola data biaya pendidikan per jenjang dan periode</p>
  </div>
  <div class="page-header-right">
    <a href="<?= base_url('admin/biaya/tambah') ?>" class="btn btn-action btn-primary-action">
      <i class="fas fa-plus"></i> Tambah Biaya
    </a>
  </div>
</div>

<!-- Summary Cards -->
<div class="summary-row">
  <div class="summary-item-card">
    <div class="summary-icon blue"><i class="fas fa-coins"></i></div>
    <div class="summary-text">
      <div class="summary-label">Total Biaya</div>
      <div class="summary-value"><?= $total_biaya ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon green"><i class="fas fa-check-circle"></i></div>
    <div class="summary-text">
      <div class="summary-label">Aktif</div>
      <div class="summary-value"><?= $aktif ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon red"><i class="fas fa-pause-circle"></i></div>
    <div class="summary-text">
      <div class="summary-label">Non Aktif</div>
      <div class="summary-value"><?= $non_aktif ?></div>
    </div>
  </div>
  <div class="summary-item-card">
    <div class="summary-icon amber"><i class="fas fa-calendar"></i></div>
    <div class="summary-text">
      <div class="summary-label">Bulanan</div>
      <div class="summary-value"><?= $bulanan ?></div>
    </div>
  </div>
</div>

<!-- Table -->
<?php if (empty($biaya)): ?>
<div class="card-modern">
  <div class="card-modern-body">
    <div class="empty-state">
      <i class="fas fa-coins"></i>
      <div class="empty-state-title">Belum ada data biaya</div>
      <div class="empty-state-desc">Mulai tambahkan data biaya pendidikan untuk setiap jenjang.</div>
      <a href="<?= base_url('admin/biaya/tambah') ?>" class="btn btn-action btn-primary-action">
        <i class="fas fa-plus"></i> Tambah Biaya Pertama
      </a>
    </div>
  </div>
</div>
<?php else: ?>
<div class="card-modern">
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern">
        <thead>
          <tr>
            <th width="5%" class="text-center">No</th>
            <th>Nama Biaya</th>
            <th>Jenjang</th>
            <th class="text-right">Nominal</th>
            <th class="text-center">Periode</th>
            <th class="text-center">Tahun</th>
            <th class="text-center">Status</th>
            <th width="12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($biaya as $b): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><strong><?= esc($b['nama_biaya']) ?></strong></td>
            <td><?= esc($b['nama_jenjang']) ?></td>
            <td class="text-right">
              <span class="amount-display-sm">Rp <?= number_format($b['nominal'], 0, ',', '.') ?></span>
            </td>
            <td class="text-center">
              <span class="status-badge <?= $b['periode'] === 'Bulanan' ? 'status-info' : 'status-success' ?>">
                <?= esc($b['periode']) ?>
              </span>
            </td>
            <td class="text-center">
              <?= esc($b['tahun_mulai']) ?><?= $b['tahun_selesai'] ? ' — ' . esc($b['tahun_selesai']) : '' ?>
            </td>
            <td class="text-center">
              <?php if ($b['status'] === 'Aktif'): ?>
                <span class="status-badge status-success"><i class="fas fa-check-circle"></i> Aktif</span>
              <?php else: ?>
                <span class="status-badge status-danger"><i class="fas fa-pause-circle"></i> Non Aktif</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="table-actions">
                <a href="<?= base_url('admin/biaya/edit/' . $b['id_biaya']) ?>" class="btn btn-action btn-secondary-action" title="Edit">
                  <i class="fas fa-pen"></i>
                </a>
                <a href="<?= base_url('admin/biaya/delete/' . $b['id_biaya']) ?>" class="btn btn-action btn-danger-action delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
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
