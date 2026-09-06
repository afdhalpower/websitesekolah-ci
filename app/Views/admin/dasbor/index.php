<!-- Welcome Banner -->
<div class="dashboard-welcome">
  <div class="welcome-content">
    <div class="welcome-text">
      <h4 class="welcome-greeting">Assalamu'alaikum, <strong><?php echo Session()->get('nama') ?></strong></h4>
      <p class="welcome-sub">Selamat datang di panel <strong><?php echo esc($this->website->namasekolah()) ?></strong>. Kelola sistem informasi sekolah dengan mudah.</p>
    </div>
    <div class="welcome-quick">
      <a href="<?php echo base_url('admin/berita/tambah') ?>" class="btn btn-quick">
        <i class="fas fa-plus"></i> Tambah Berita
      </a>
      <a href="<?php echo base_url('admin/galeri/tambah') ?>" class="btn btn-quick">
        <i class="fas fa-image"></i> Tambah Galeri
      </a>
      <a href="<?php echo base_url('admin/konfigurasi/sekolah') ?>" class="btn btn-quick">
        <i class="fas fa-cog"></i> Setting
      </a>
    </div>
  </div>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-green">
        <i class="fas fa-user-graduate"></i>
      </div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $stats['siswa'] ?></span>
        <span class="stat-card-label">Siswa Aktif</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-blue">
        <i class="fas fa-newspaper"></i>
      </div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $stats['berita'] ?></span>
        <span class="stat-card-label">Berita & Artikel</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-purple">
        <i class="fas fa-images"></i>
      </div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $stats['galeri'] ?></span>
        <span class="stat-card-label">Media Galeri</span>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="stat-card-icon stat-card-amber">
        <i class="fas fa-money-bill-wave"></i>
      </div>
      <div class="stat-card-info">
        <span class="stat-card-num"><?php echo $stats['tagihan_pending'] ?></span>
        <span class="stat-card-label">Tagihan Pending</span>
      </div>
    </div>
  </div>
</div>

<!-- Menu Cards -->
<div class="row g-3 mb-4">
  <!-- Card 1: PPDB -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/gelombang') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #059669, #10b981);">
        <i class="fas fa-user-plus"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">PPDB Online</h6>
        <p class="dash-card-desc">Kelola pendaftaran siswa baru</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 2: Berita -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/berita') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #dc2626, #ef4444);">
        <i class="fas fa-newspaper"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Berita & Profil</h6>
        <p class="dash-card-desc"><?php echo $stats['berita'] ?> artikel terbit</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 3: Galeri -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/galeri') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #166308, #22c55e);">
        <i class="fas fa-images"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Galeri & Banner</h6>
        <p class="dash-card-desc"><?php echo $stats['galeri'] ?> media tersedia</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 4: Keuangan -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/biaya') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
        <i class="fas fa-wallet"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Keuangan</h6>
        <p class="dash-card-desc"><?php echo $stats['tagihan'] ?> tagihan tercatat</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 5: Staff -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/staff') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
        <i class="fas fa-chalkboard-teacher"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Guru & Staff</h6>
        <p class="dash-card-desc"><?php echo $stats['staff'] ?> personel terdaftar</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 6: Agenda -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/agenda') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);">
        <i class="fas fa-calendar-alt"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Event & Agenda</h6>
        <p class="dash-card-desc"><?php echo $stats['agenda'] ?> event terjadwal</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 7: Video -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/video') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #dc2626, #f87171);">
        <i class="fab fa-youtube"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Video Youtube</h6>
        <p class="dash-card-desc"><?php echo $stats['video'] ?> video terupload</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>

  <!-- Card 8: Setting -->
  <div class="col-6 col-lg-4 col-xl-3">
    <a href="<?php echo base_url('admin/konfigurasi/sekolah') ?>" class="dash-card">
      <div class="dash-card-icon" style="background: linear-gradient(135deg, #374151, #6b7280);">
        <i class="fas fa-cog"></i>
      </div>
      <div class="dash-card-body">
        <h6 class="dash-card-title">Setting Sekolah</h6>
        <p class="dash-card-desc">Konfigurasi website</p>
        <span class="dash-card-link">Buka <i class="fas fa-arrow-right"></i></span>
      </div>
    </a>
  </div>
</div>

<!-- Bottom Row: Siswa per Jenjang + Panduan -->
<div class="row g-3">
  <!-- Siswa per Jenjang -->
  <div class="col-lg-8">
    <div class="dash-panel">
      <div class="dash-panel-header">
        <h6 class="dash-panel-title"><i class="fas fa-chart-bar text-success me-2"></i> Siswa per Jenjang</h6>
      </div>
      <div class="dash-panel-body">
        <?php if(empty($siswa_per_jenjang)): ?>
          <p class="text-muted text-center py-3">Belum ada data siswa</p>
        <?php else: ?>
          <?php foreach($siswa_per_jenjang as $row): ?>
            <div class="jenjang-bar">
              <div class="jenjang-info">
                <span class="jenjang-name"><?php echo esc($row->nama_jenjang ?? 'Tidak Ditetapkan') ?></span>
                <span class="jenjang-count"><?php echo $row->jumlah ?> siswa</span>
              </div>
              <div class="jenjang-progress">
                <div class="jenjang-fill" style="width: <?php echo $stats['siswa'] > 0 ? ($row->jumlah / $stats['siswa'] * 100) : 0 ?>%"></div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Panduan Cepat -->
  <div class="col-lg-4">
    <div class="dash-panel">
      <div class="dash-panel-header">
        <h6 class="dash-panel-title"><i class="fas fa-question-circle text-success me-2"></i> Panduan Cepat</h6>
      </div>
      <div class="dash-panel-body">
        <a href="<?php echo base_url('admin/dasbor/panduan') ?>" class="panduan-link">
          <i class="fas fa-book"></i>
          <div>
            <strong>Manual Penggunaan</strong>
            <small>Panduan lengkap admin panel</small>
          </div>
          <i class="fas fa-chevron-right"></i>
        </a>
        <a href="<?php echo base_url('admin/konfigurasi/sekolah') ?>" class="panduan-link">
          <i class="fas fa-school"></i>
          <div>
            <strong>Profil Sekolah</strong>
            <small>Update informasi sekolah</small>
          </div>
          <i class="fas fa-chevron-right"></i>
        </a>
        <a href="<?php echo base_url('admin/user') ?>" class="panduan-link">
          <i class="fas fa-users-cog"></i>
          <div>
            <strong>Kelola Pengguna</strong>
            <small>Tambah/hapus akun admin</small>
          </div>
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>
