<?php
/**
 * Gelombang Detail View
 * Pre-compute URLs at the top to avoid parser issues with inline PHP in HTML attributes.
 */
$back_url = base_url('admin/gelombang');
$detail_base = base_url('admin/gelombang/detail/' . $gelombang->id_gelombang);
$export_url = base_url('admin/gelombang/export/' . $gelombang->id_gelombang . '/' . $status_pendaftaran . '/' . $id_jenjang_pendidikan);
$unduh_data_url = base_url('admin/gelombang/unduh_data/' . $gelombang->id_gelombang . '/' . $status_pendaftaran . '/' . $id_jenjang_pendidikan);
$unduh_pengumuman_url = base_url('admin/gelombang/unduh_pengumuman/' . $gelombang->id_gelombang . '/' . $status_pendaftaran . '/' . $id_jenjang_pendidikan);
$pendaftaran_url = base_url('pendaftaran');
$form_action = base_url('admin/gelombang/detail/' . $gelombang->id_gelombang . '/' . $status_pendaftaran . '/' . $id_jenjang_pendidikan);
?>

<!-- Back Button -->
<div class="mb-3">
  <a href="<?= $back_url ?>" class="btn btn-action btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Periode
  </a>
</div>

<!-- Period Info Card -->
<div class="card-modern mb-4">
  <div class="card-modern-header">
    <div class="card-modern-title-row">
      <div class="card-modern-thumb card-modern-thumb-placeholder">
        <i class="fas fa-calendar-alt" style="font-size:1.5rem;color:var(--green);"></i>
      </div>
      <div>
        <h4 class="card-modern-title"><?= esc($gelombang->judul) ?></h4>
        <div class="card-modern-dates">
          <span><i class="fas fa-clock"></i> <?= date('d M Y', strtotime($gelombang->tanggal_buka)) ?> — <?= date('d M Y', strtotime($gelombang->tanggal_tutup)) ?></span>
        </div>
      </div>
    </div>
  </div>
  <div class="card-modern-body">
    <div class="info-grid">
      <div class="info-item">
        <span class="info-label">Periode</span>
        <span class="info-value"><?= esc($gelombang->judul) ?></span>
      </div>
      <div class="info-item">
        <span class="info-label">Tahun Ajaran</span>
        <span class="info-value"><?= esc($gelombang->tahun_ajaran) ?></span>
      </div>
      <div class="info-item">
        <span class="info-label">Jenjang</span>
        <span class="info-value"><?= esc($judul_jenjang_pendidikan) ?></span>
      </div>
      <div class="info-item">
        <span class="info-label">Filter</span>
        <span class="info-value"><?= esc($status_pendaftaran) ?> / <?= esc($id_jenjang_pendidikan) ?></span>
      </div>
    </div>
  </div>
</div>

<!-- Status Tabs -->
<div class="status-tabs mb-4">
  <?php foreach (['Semua', 'Menunggu', 'Diperiksa', 'Diterima', 'Tidak-Diterima'] as $tab_status): ?>
  <a href="<?= $detail_base . '/' . $tab_status . '/' . $id_jenjang_pendidikan ?>" class="status-tab <?= ($status_pendaftaran === $tab_status) ? 'active' : '' ?>">
    <?php
    $count = 0;
    switch ($tab_status) {
      case 'Semua':      $count = $s_semua; break;
      case 'Menunggu':   $count = $s_menunggu; break;
      case 'Diperiksa':  $count = $s_diperiksa; break;
      case 'Diterima':   $count = $s_diterima; break;
      case 'Tidak-Diterima': $count = $s_tidak; break;
    }
    ?>
    <i class="fas <?= ($tab_status === 'Semua' ? 'fa-list' : ($tab_status === 'Menunggu' ? 'fa-clock' : ($tab_status === 'Diperiksa' ? 'fa-search' : ($tab_status === 'Diterima' ? 'fa-check' : 'fa-times')))) ?>"></i>
    <?= $tab_status ?> <span class="status-tab-count"><?= $count ?></span>
  </a>
  <?php endforeach; ?>
</div>

<!-- Summary Row -->
<div class="row g-3 mb-4">
  <!-- Summary Card -->
  <div class="col-md-4">
    <div class="card-modern">
      <div class="card-modern-header" style="border-bottom:none;">
        <h5 class="card-modern-title">Ringkasan</h5>
      </div>
      <div class="card-modern-body">
        <div class="summary-list">
          <div class="summary-item">
            <i class="fas fa-user-check" style="color:var(--blue);"></i>
            <span>Jumlah Pendaftar</span>
            <span class="summary-num"><?= $s_semua ?></span>
          </div>
          <div class="summary-item">
            <i class="fas fa-clock" style="color:var(--amber);"></i>
            <span>Menunggu</span>
            <span class="summary-num"><?= $s_menunggu ?></span>
          </div>
          <div class="summary-item">
            <i class="fas fa-check-circle" style="color:var(--green);"></i>
            <span>Diterima</span>
            <span class="summary-num"><?= $s_diterima ?></span>
          </div>
          <div class="summary-item">
            <i class="fas fa-times-circle" style="color:var(--red);"></i>
            <span>Ditolak</span>
            <span class="summary-num"><?= $s_tidak ?></span>
          </div>
          <div class="summary-item">
            <i class="fas fa-edit" style="color:var(--purple);"></i>
            <span>Diperiksa</span>
            <span class="summary-num"><?= $s_diperiksa ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jenjang Breakdown -->
  <div class="col-md-8">
    <div class="card-modern">
      <div class="card-modern-header" style="border-bottom:none;">
        <h5 class="card-modern-title">Jenjang Pendidikan</h5>
      </div>
      <div class="card-modern-body" style="padding:0;">
        <table class="table-modern">
          <thead>
            <tr>
              <th>Jenjang</th>
              <th class="text-center">Menunggu</th>
              <th class="text-center">Diterima</th>
              <th class="text-center">Ditolak</th>
              <th class="text-center">Diperiksa</th>
              <th width="22%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($akumulasi as $a): ?>
            <tr>
              <td>
                <strong><?= esc($a->judul_jenjang_pendidikan) ?></strong>
              </td>
              <td class="text-center">
                <span class="status-badge status-warning"><?= $a->menunggu ?> siswa</span>
              </td>
              <td class="text-center">
                <span class="status-badge status-success"><?= $a->diterima ?> siswa</span>
              </td>
              <td class="text-center">
                <span class="status-badge status-danger"><?= $a->tidak ?> siswa</span>
              </td>
              <td class="text-center">
                <span class="status-badge status-info"><?= $a->diperiksa ?> siswa</span>
              </td>
              <td>
                <div class="table-actions">
                  <a href="<?= $detail_base . '/Semua/' . $a->id_jenjang_pendidikan ?>" class="btn btn-action btn-info-action" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a href="<?= base_url('admin/gelombang/export/' . $gelombang->id_gelombang . '/Semua/' . $a->id_jenjang_pendidikan) ?>" class="btn btn-action btn-success-action" target="_blank" title="Ekspor Excel">
                    <i class="fas fa-file-excel"></i>
                  </a>
                  <a href="<?= base_url('admin/gelombang/unduh_data/' . $gelombang->id_gelombang . '/Semua/' . $a->id_jenjang_pendidikan) ?>" class="btn btn-action btn-danger-action" target="_blank" title="Cetak PDF">
                    <i class="fas fa-file-pdf"></i>
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
</div>

<!-- Data Table -->
<div class="card-modern mb-4">
  <div class="card-modern-header">
    <h5 class="card-modern-title">
      <i class="fas fa-users"></i> Data Pendaftar
      <span class="status-tab-count" style="margin-left:0.5rem;"><?= $s_semua ?></span>
    </h5>
    <div class="bulk-actions">
      <select name="status_pendaftaran" class="form-select form-select-sm" style="width:auto;">
        <option value="">-- Ubah Status --</option>
        <option value="Menunggu">Menunggu</option>
        <option value="Diperiksa">Diperiksa</option>
        <option value="Diterima">Diterima</option>
        <option value="Tidak-Diterima">Tidak Diterima</option>
      </select>
      <button type="submit" name="submit" value="update_status" class="btn btn-action btn-warning-action">
        <i class="fas fa-sync"></i> Update Status
      </button>
      <button type="submit" name="submit" value="export" class="btn btn-action btn-success-action">
        <i class="fas fa-file-excel"></i> Export
      </button>
      <button type="submit" name="submit" value="unduh" class="btn btn-action btn-danger-action">
        <i class="fas fa-file-pdf"></i> Cetak PDF
      </button>
    </div>
  </div>
  <div class="card-modern-body" style="padding:0;">
    <?php echo form_open($form_action) ?>
    <div class="table-responsive">
      <table class="table-modern">
        <thead>
          <tr>
            <th width="4%" class="text-center"><input type="checkbox" id="checkAll" class="form-check-input"></th>
            <th width="25%">Nama & Info</th>
            <th width="18%">Alamat</th>
            <th width="10%" class="text-center">Dokumen</th>
            <th width="8%" class="text-center">Status</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($siswa)): ?>
          <tr>
            <td colspan="6" class="text-center" style="padding:2rem;color:var(--gray);">
              <i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:0.5rem;"></i>
              Tidak ada data pendaftar
            </td>
          </tr>
          <?php else: ?>
          <?php foreach ($siswa as $s): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="id_siswa[]" value="<?= esc($s->id_siswa) ?>" class="form-check-input row-check">
            </td>
            <td>
              <div class="table-name">
                <a href="<?= base_url('admin/gelombang/edit_siswa/' . $s->slug_siswa) ?>" class="name-link">
                  <?= esc($s->nama_siswa) ?>
                </a>
                <span class="meta-tag"><?= esc($s->kode_siswa) ?></span>
                <div class="table-meta">
                  <span class="meta-tag"><i class="fas fa-graduation-cap"></i> <?= esc($s->judul_jenjang_pendidikan) ?></span>
                  <span class="meta-tag"><i class="fas fa-calendar"></i> <?= esc($s->tahun_ajaran) ?></span>
                  <?php if ($s->usia_teks): ?>
                  <span class="meta-tag"><i class="fas fa-birthday-cake"></i> <?= esc($s->usia_teks) ?></span>
                  <?php endif; ?>
                  <?php if (isset($s->judul)): ?>
                  <span class="meta-tag"><i class="fas fa-layer-group"></i> <?= esc($s->judul) ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </td>
            <td>
              <div class="table-address"><?= esc($s->alamat) ?></div>
            </td>
            <td class="text-center">
              <?php
              $doc_total = ($s->dokumen_wajib_upload ?? 0) + ($s->dokumen_tidak_wajib_upload ?? 0);
              $doc_needed = ($s->dokumen_wajib_total ?? 0) + ($s->dokumen_tidak_wajib_total ?? 0);
              $doc_missing = max(0, $doc_needed - $doc_total);
              ?>
              <div class="doc-num <?= ($doc_missing === 0) ? 'doc-complete' : 'doc-incomplete' ?>">
                <?= $doc_total ?>/<?= $doc_needed ?>
              </div>
              <div class="doc-label">
                <?php if ($doc_missing === 0): ?>
                  <span class="doc-complete">Lengkap</span>
                <?php else: ?>
                  <span class="doc-incomplete">Kurang <?= $doc_missing ?></span>
                <?php endif; ?>
              </div>
            </td>
            <td class="text-center">
              <?php if ($s->status_pendaftaran == 'Menunggu'): ?>
              <span class="status-badge status-warning"><i class="fas fa-clock"></i> Menunggu</span>
              <?php elseif ($s->status_pendaftaran == 'Diterima'): ?>
              <span class="status-badge status-success"><i class="fas fa-check"></i> Diterima</span>
              <?php elseif ($s->status_pendaftaran == 'Tidak-Diterima'): ?>
              <span class="status-badge status-danger"><i class="fas fa-times"></i> Ditolak</span>
              <?php else: ?>
              <span class="status-badge status-info"><i class="fas fa-search"></i> <?= esc($s->status_pendaftaran) ?></span>
              <?php endif; ?>
            </td>
            <td>
              <div class="table-actions">
                <a href="<?= base_url('admin/gelombang/dokumen/' . $s->slug_siswa) ?>" class="btn btn-action btn-primary-action" title="Lihat Dokumen">
                  <i class="fas fa-folder-open"></i>
                </a>
                <a href="<?= base_url('admin/gelombang/edit_siswa/' . $s->slug_siswa) ?>" class="btn btn-action btn-secondary-action" title="Edit Siswa">
                  <i class="fas fa-pen"></i>
                </a>
                <a href="<?= base_url('admin/gelombang/cetak/' . $s->slug_siswa) ?>" class="btn btn-action btn-danger-action" title="Cetak PDF">
                  <i class="fas fa-print"></i>
                </a>
                <?php if ($s->status_pendaftaran == 'Menunggu'): ?>
                <a href="<?= base_url('admin/gelombang/delete_siswa/' . $s->slug_siswa . '/' . $s->id_gelombang) ?>" class="btn btn-action btn-danger-action" title="Hapus" onclick="return confirm('Yakin hapus data ini?')">
                  <i class="fas fa-trash"></i>
                </a>
                <?php endif; ?>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php echo form_close() ?>
  </div>
</div>

<!-- Export Buttons -->
<div class="export-bar">
  <a href="<?= $export_url ?>" class="btn btn-action btn-success-action" target="_blank">
    <i class="fas fa-file-excel"></i> Ekspor Excel
  </a>
  <a href="<?= $unduh_data_url ?>" class="btn btn-action btn-danger-action" target="_blank">
    <i class="fas fa-file-pdf"></i> Cetak PDF
  </a>
  <a href="<?= $unduh_pengumuman_url ?>" class="btn btn-action btn-danger-action" target="_blank">
    <i class="fas fa-file-pdf"></i> Cetak Pengumuman
  </a>
  <a href="<?= $pendaftaran_url ?>" class="btn btn-action btn-primary-action" target="_blank">
    <i class="fas fa-eye"></i> Lihat Form Pendaftaran
  </a>
</div>
