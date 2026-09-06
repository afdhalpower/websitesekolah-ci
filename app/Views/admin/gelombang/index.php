<!-- Page Header -->
<div class="page-header-modern">
  <div class="page-header-left">
    <h5 class="page-title">Data Periode PPDB</h5>
    <p class="page-subtitle">Kelola periode pendaftaran siswa baru</p>
  </div>
  <div class="page-header-right">
    <a href="<?php echo base_url('admin/gelombang/tambah') ?>" class="btn btn-modern btn-success">
      <i class="fas fa-plus"></i> Tambah Periode
    </a>
  </div>
</div>

<!-- Summary Stats -->
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="mini-stat">
      <div class="mini-stat-icon" style="background: linear-gradient(135deg, #166308, #22c55e);">
        <i class="fas fa-calendar-alt"></i>
      </div>
      <div class="mini-stat-info">
        <span class="mini-stat-num"><?php echo count($gelombang) ?></span>
        <span class="mini-stat-label">Total Periode</span>
      </div>
    </div>
  </div>
  <?php
    $total_semua = 0; $total_menunggu = 0; $total_diperiksa = 0; $total_diterima = 0; $total_tidak = 0;
    foreach($gelombang as $g) {
      $s_semua = $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Semua','Semua');
      $s_menunggu = $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Menunggu','Semua');
      $s_diperiksa = $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Diperiksa','Semua');
      $s_diterima = $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Diterima','Semua');
      $s_tidak = $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Tidak-Diterima','Semua');
      $total_semua += $s_semua->total ?? 0;
      $total_menunggu += $s_menunggu->total ?? 0;
      $total_diperiksa += $s_diperiksa->total ?? 0;
      $total_diterima += $s_diterima->total ?? 0;
      $total_tidak += $s_tidak->total ?? 0;
    }
  ?>
  <div class="col-6 col-md-3">
    <div class="mini-stat">
      <div class="mini-stat-icon" style="background: linear-gradient(135deg, #1d4ed8, #3b82f6);">
        <i class="fas fa-users"></i>
      </div>
      <div class="mini-stat-info">
        <span class="mini-stat-num"><?php echo $total_semua ?></span>
        <span class="mini-stat-label">Total Pendaftar</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="mini-stat">
      <div class="mini-stat-icon" style="background: linear-gradient(135deg, #d97706, #fbbf24);">
        <i class="fas fa-clock"></i>
      </div>
      <div class="mini-stat-info">
        <span class="mini-stat-num"><?php echo $total_menunggu + $total_diperiksa ?></span>
        <span class="mini-stat-label">Proses Review</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="mini-stat">
      <div class="mini-stat-icon" style="background: linear-gradient(135deg, #059669, #34d399);">
        <i class="fas fa-user-check"></i>
      </div>
      <div class="mini-stat-info">
        <span class="mini-stat-num"><?php echo $total_diterima ?></span>
        <span class="mini-stat-label">Diterima</span>
      </div>
    </div>
  </div>
</div>

<!-- Gelombang Cards -->
<?php if(empty($gelombang)): ?>
  <div class="empty-state">
    <i class="fas fa-calendar-plus"></i>
    <h6>Belum Ada Periode PPDB</h6>
    <p>Klik "Tambah Periode" untuk membuat periode pendaftaran baru.</p>
    <a href="<?php echo base_url('admin/gelombang/tambah') ?>" class="btn btn-modern btn-success">
      <i class="fas fa-plus"></i> Tambah Periode
    </a>
  </div>
<?php else: ?>
  <?php
    // Hitung stats untuk setiap gelombang
    $gelombang_stats = [];
    foreach($gelombang as $g) {
      $gelombang_stats[$g->id_gelombang] = [
        'semua'     => $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Semua','Semua')->total ?? 0,
        'menunggu'  => $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Menunggu','Semua')->total ?? 0,
        'diperiksa' => $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Diperiksa','Semua')->total ?? 0,
        'diterima'  => $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Diterima','Semua')->total ?? 0,
        'tidak'     => $m_siswa->total_gelombang_status_siswa($g->id_gelombang,'Tidak-Diterima','Semua')->total ?? 0,
      ];
    }
  ?>

  <div class="row g-3">
    <?php $no=1; foreach($gelombang as $g): 
      $stats = $gelombang_stats[$g->id_gelombang];
      $is_buka = ($g->status_gelombang == 'Buka');
    ?>
    <div class="col-lg-6">
      <div class="gelombang-card">
        <!-- Card Header -->
        <div class="gelombang-card-header">
          <div class="gelombang-card-title-row">
            <?php if($g->gambar != ""): ?>
              <img src="<?php echo base_url('assets/upload/image/thumbs/'.$g->gambar) ?>" class="gelombang-thumb" alt="">
            <?php else: ?>
              <div class="gelombang-thumb gelombang-thumb-placeholder">
                <i class="fas fa-calendar"></i>
              </div>
            <?php endif; ?>
            <div>
              <h6 class="gelombang-card-title"><?php echo esc($g->judul) ?></h6>
              <div class="gelombang-dates">
                <span><i class="fas fa-door-open"></i> <?php echo esc($this->website->hari($g->tanggal_buka)) ?></span>
                <span><i class="fas fa-door-closed"></i> <?php echo esc($this->website->hari($g->tanggal_tutup)) ?></span>
                <span><i class="fas fa-bullhorn"></i> <?php echo esc($this->website->hari($g->tanggal_pengumuman)) ?></span>
              </div>
            </div>
          </div>
          <div class="gelombang-status">
            <?php if($is_buka): ?>
              <span class="status-badge status-buka">
                <i class="fas fa-circle"></i> Buka
              </span>
            <?php else: ?>
              <span class="status-badge status-tutup">
                <i class="fas fa-circle"></i> Tutup
              </span>
            <?php endif; ?>
          </div>
        </div>

        <!-- Stats Bar -->
        <div class="gelombang-stats">
          <div class="gstat">
            <span class="gstat-num gstat-total"><?php echo $stats['semua'] ?></span>
            <span class="gstat-label">Total</span>
          </div>
          <div class="gstat">
            <span class="gstat-num gstat-menunggu"><?php echo $stats['menunggu'] ?></span>
            <span class="gstat-label">Menunggu</span>
          </div>
          <div class="gstat">
            <span class="gstat-num gstat-diperiksa"><?php echo $stats['diperiksa'] ?></span>
            <span class="gstat-label">Diperiksa</span>
          </div>
          <div class="gstat">
            <span class="gstat-num gstat-diterima"><?php echo $stats['diterima'] ?></span>
            <span class="gstat-label">Diterima</span>
          </div>
          <div class="gstat">
            <span class="gstat-num gstat-tidak"><?php echo $stats['tidak'] ?></span>
            <span class="gstat-label">Ditolak</span>
          </div>
        </div>

        <!-- Progress Bar -->
        <?php if($stats['semua'] > 0): ?>
        <div class="gelombang-progress">
          <div class="progress-track">
            <div class="progress-fill progress-diterima" style="width: <?php echo ($stats['diterima'] / $stats['semua'] * 100) ?>%" title="Diterima"></div>
            <div class="progress-fill progress-diperiksa" style="width: <?php echo ($stats['diperiksa'] / $stats['semua'] * 100) ?>%" title="Diperiksa"></div>
            <div class="progress-fill progress-menunggu" style="width: <?php echo ($stats['menunggu'] / $stats['semua'] * 100) ?>%" title="Menunggu"></div>
          </div>
          <div class="progress-legend">
            <span class="legend-item"><span class="legend-dot" style="background:#166308"></span> Diterima</span>
            <span class="legend-item"><span class="legend-dot" style="background:#d97706"></span> Diperiksa</span>
            <span class="legend-item"><span class="legend-dot" style="background:#6b7280"></span> Menunggu</span>
          </div>
        </div>
        <?php endif; ?>

        <!-- Actions -->
        <div class="gelombang-actions">
          <div class="actions-left">
            <a href="<?php echo base_url('admin/gelombang/detail/'.$g->id_gelombang.'/Semua/Semua') ?>" class="btn btn-sm btn-action btn-action-primary" title="Data Pendaftar">
              <i class="fas fa-user-check"></i> Pendaftar
            </a>
            <a href="<?php echo base_url('admin/gelombang/export/'.$g->id_gelombang.'/Semua/Semua') ?>" class="btn btn-sm btn-action btn-action-success" title="Ekspor Excel" target="_blank">
              <i class="fas fa-file-excel"></i> Ekspor
            </a>
            <a href="<?php echo base_url('admin/gelombang/unduh_data/'.$g->id_gelombang.'/Semua/Semua') ?>" class="btn btn-sm btn-action btn-action-danger" title="Unduh PDF" target="_blank">
              <i class="fas fa-file-pdf"></i> Unduh
            </a>
          </div>
          <div class="actions-right">
            <a href="<?php echo base_url('admin/gelombang/edit/'.$g->id_gelombang) ?>" class="btn btn-sm btn-action btn-action-edit" title="Edit">
              <i class="fas fa-edit"></i>
            </a>
            <a href="<?php echo base_url('admin/gelombang/delete/'.$g->id_gelombang) ?>" class="btn btn-sm btn-action btn-action-delete delete-link" title="Hapus">
              <i class="fas fa-trash"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php $no++; endforeach; ?>
  </div>
<?php endif; ?>
