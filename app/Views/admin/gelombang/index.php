<!-- Page Header -->
<div class="page-header-modern">
  <div class="page-header-left">
    <h5 class="page-title">Data Periode PPDB</h5>
    <p class="page-subtitle">Kelola periode pendaftaran siswa baru</p>
  </div>
  <div class="page-header-right">
    <a href="<?php echo base_url('admin/gelombang/tambah') ?>" class="btn btn-success btn-lg rounded-pill">
      <i class="fas fa-plus"></i> Tambah Periode
    </a>
  </div>
</div>

<!-- Summary Stats -->
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-green"><i class="fas fa-calendar-alt"></i></div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo count($gelombang) ?></span>
        <span class="stat-card-label">Total Periode</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-blue"><i class="fas fa-users"></i></div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $total_semua ?></span>
        <span class="stat-card-label">Total Pendaftar</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-amber"><i class="fas fa-clock"></i></div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $total_proses ?></span>
        <span class="stat-card-label">Proses Review</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-emerald"><i class="fas fa-user-check"></i></div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $total_diterima ?></span>
        <span class="stat-card-label">Diterima</span>
      </div>
    </div>
  </div>
</div>

<!-- Gelombang Cards -->
<?php if(empty($gelombang)): ?>
  <div class="empty-state">
    <i class="fas fa-calendar-plus"></i>
    <h5>Belum Ada Periode PPDB</h5>
    <p>Klik "Tambah Periode" untuk membuat periode pendaftaran baru.</p>
    <a href="<?php echo base_url('admin/gelombang/tambah') ?>" class="btn btn-success btn-lg rounded-pill">
      <i class="fas fa-plus"></i> Tambah Periode
    </a>
  </div>
<?php else: ?>
  <div class="row g-3">
    <?php foreach($gelombang as $g):
      $s = $gelombang_stats[$g->id_gelombang];
      $is_buka = ($g->status_gelombang == 'Buka');
    ?>
    <div class="col-lg-6">
      <div class="card-modern">
        <!-- Card Header -->
        <div class="card-modern-header">
          <div class="card-modern-title-row">
            <?php if($g->gambar != ""): ?>
              <img src="<?php echo base_url('assets/upload/image/thumbs/'.$g->gambar) ?>" class="card-modern-thumb" alt="">
            <?php else: ?>
              <div class="card-modern-thumb card-modern-thumb-placeholder">
                <i class="fas fa-calendar"></i>
              </div>
            <?php endif; ?>
            <div>
              <h5 class="card-modern-title"><?php echo esc($g->judul) ?></h5>
              <div class="card-modern-dates">
                <span><i class="fas fa-door-open"></i> Buka: <?php echo esc($this->website->hari($g->tanggal_buka)) ?></span>
                <span><i class="fas fa-door-closed"></i> Tutup: <?php echo esc($this->website->hari($g->tanggal_tutup)) ?></span>
                <span><i class="fas fa-bullhorn"></i> Umumkan: <?php echo esc($this->website->hari($g->tanggal_pengumuman)) ?></span>
              </div>
            </div>
          </div>
          <span class="status-badge <?php echo $is_buka ? 'status-buka' : 'status-tutup' ?>">
            <i class="fas fa-circle"></i> <?php echo esc($g->status_gelombang) ?>
          </span>
        </div>

        <!-- Stats Row -->
        <div class="card-modern-stats">
          <div class="cs-item"><span class="cs-num cs-total"><?php echo $s['semua'] ?></span><span class="cs-label">Total</span></div>
          <div class="cs-item"><span class="cs-num cs-waiting"><?php echo $s['menunggu'] ?></span><span class="cs-label">Menunggu</span></div>
          <div class="cs-item"><span class="cs-num cs-review"><?php echo $s['diperiksa'] ?></span><span class="cs-label">Diperiksa</span></div>
          <div class="cs-item"><span class="cs-num cs-ok"><?php echo $s['diterima'] ?></span><span class="cs-label">Diterima</span></div>
          <div class="cs-item"><span class="cs-num cs-reject"><?php echo $s['tidak'] ?></span><span class="cs-label">Ditolak</span></div>
        </div>

        <!-- Progress Bar -->
        <?php if($s['semua'] > 0): ?>
        <div class="card-modern-progress">
          <div class="progress-track">
            <div class="progress-bar-ok" style="width: <?php echo ($s['diterima'] / $s['semua'] * 100) ?>%"></div>
            <div class="progress-bar-review" style="width: <?php echo ($s['diperiksa'] / $s['semua'] * 100) ?>%"></div>
            <div class="progress-bar-waiting" style="width: <?php echo ($s['menunggu'] / $s['semua'] * 100) ?>%"></div>
          </div>
          <div class="progress-legend">
            <span class="legend-dot"><span class="dot" style="background:var(--haqi)"></span> Diterima</span>
            <span class="legend-dot"><span class="dot" style="background:var(--amber)"></span> Diperiksa</span>
            <span class="legend-dot"><span class="dot" style="background:var(--gray)"></span> Menunggu</span>
          </div>
        </div>
        <?php endif; ?>

        <!-- Actions -->
        <div class="card-modern-actions">
          <div class="card-actions-left">
            <a href="<?php echo base_url('admin/gelombang/detail/'.$g->id_gelombang.'/Semua/Semua') ?>" class="btn btn-action btn-primary-action">
              <i class="fas fa-user-check"></i> Data Pendaftar
            </a>
            <a href="<?php echo base_url('admin/gelombang/export/'.$g->id_gelombang.'/Semua/Semua') ?>" class="btn btn-action btn-success-action" target="_blank">
              <i class="fas fa-file-excel"></i> Ekspor
            </a>
            <a href="<?php echo base_url('admin/gelombang/unduh_data/'.$g->id_gelombang.'/Semua/Semua') ?>" class="btn btn-action btn-danger-action" target="_blank">
              <i class="fas fa-file-pdf"></i> Unduh
            </a>
          </div>
          <div class="card-actions-right">
            <a href="<?php echo base_url('admin/gelombang/edit/'.$g->id_gelombang) ?>" class="btn btn-action btn-secondary-action" title="Edit">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="<?php echo base_url('admin/gelombang/delete/'.$g->id_gelombang) ?>" class="btn btn-action btn-delete-action delete-link" title="Hapus">
              <i class="fas fa-trash"></i> Hapus
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
