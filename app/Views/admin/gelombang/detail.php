<!-- Back Button -->
<div class="mb-3">
  <a href="<?php echo base_url('admin/gelombang') ?>" class="btn btn-action btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Periode
  </a>
</div>

<!-- Period Info Card -->
<div class="card-modern mb-4">
  <div class="card-modern-header">
    <div class="card-modern-title-row">
      <div class="card-modern-thumb card-modern-thumb-placeholder">
        <i class="fas fa-calendar-alt"></i>
      </div>
      <div>
        <h5 class="card-modern-title"><?php echo esc($gelombang->judul) ?></h5>
        <div class="card-modern-dates">
          <span><i class="fas fa-door-open"></i> Buka: <?php echo esc($this->website->hari($gelombang->tanggal_buka)) ?></span>
          <span><i class="fas fa-door-closed"></i> Tutup: <?php echo esc($this->website->hari($gelombang->tanggal_tutup)) ?></span>
          <span><i class="fas fa-bullhorn"></i> Umumkan: <?php echo esc($this->website->hari($gelombang->tanggal_pengumuman)) ?></span>
        </div>
      </div>
    </div>
    <span class="status-badge <?php echo ($gelombang->status_gelombang == 'Buka') ? 'status-buka' : 'status-tutup' ?>">
      <i class="fas fa-circle"></i> <?php echo esc($gelombang->status_gelombang) ?>
    </span>
  </div>
  <div class="card-modern-body">
    <div class="info-grid">
      <div class="info-item"><span class="info-label">Periode</span><span class="info-value"><?php echo esc($gelombang->tahun) ?></span></div>
      <div class="info-item"><span class="info-label">Tahun Ajaran</span><span class="info-value"><?php echo esc($gelombang->tahun_ajaran) ?></span></div>
      <div class="info-item"><span class="info-label">Jenjang</span><span class="info-value"><?php echo esc($judul_jenjang_pendidikan) ?></span></div>
      <div class="info-item"><span class="info-label">Filter</span><span class="info-value"><?php echo esc($status_pendaftaran) ?></span></div>
    </div>
  </div>
</div>

<!-- Status Filter Tabs -->
<div class="status-tabs mb-4">
  <a href="<?php echo base_url('admin/gelombang/detail/'.$id_gelombang.'/Semua/'.$id_jenjang_pendidikan) ?>" class="status-tab <?php echo ($status_pendaftaran == 'Semua') ? 'active' : '' ?>">
    <span class="status-tab-num"><?php echo $s_semua ?></span> Semua
  </a>
  <a href="<?php echo base_url('admin/gelombang/detail/'.$id_gelombang.'/Menunggu/'.$id_jenjang_pendidikan) ?>" class="status-tab <?php echo ($status_pendaftaran == 'Menunggu') ? 'active' : '' ?>">
    <span class="status-tab-num"><?php echo $s_menunggu ?></span> Menunggu
  </a>
  <a href="<?php echo base_url('admin/gelombang/detail/'.$id_gelombang.'/Diperiksa/'.$id_jenjang_pendidikan) ?>" class="status-tab <?php echo ($status_pendaftaran == 'Diperiksa') ? 'active' : '' ?>">
    <span class="status-tab-num"><?php echo $s_diperiksa ?></span> Diperiksa
  </a>
  <a href="<?php echo base_url('admin/gelombang/detail/'.$id_gelombang.'/Diterima/'.$id_jenjang_pendidikan) ?>" class="status-tab <?php echo ($status_pendaftaran == 'Diterima') ? 'active' : '' ?>">
    <span class="status-tab-num"><?php echo $s_diterima ?></span> Diterima
  </a>
  <a href="<?php echo base_url('admin/gelombang/detail/'.$id_gelombang.'/Tidak-Diterima/'.$id_jenjang_pendidikan) ?>" class="status-tab <?php echo ($status_pendaftaran == 'Tidak-Diterima') ? 'active' : '' ?>">
    <span class="status-tab-num"><?php echo $s_tidak ?></span> Ditolak
  </a>
</div>

<!-- Jenjang Breakdown -->
<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card-modern">
      <div class="card-modern-header" style="border-bottom:none;">
        <h5 class="card-modern-title">Ringkasan</h5>
      </div>
      <div class="card-modern-body">
        <div class="summary-list">
          <div class="summary-item"><i class="fas fa-user-check" style="color:var(--blue)"></i><span>Jumlah Pendaftar</span><strong><?php echo $s_semua ?></strong></div>
          <div class="summary-item"><i class="fas fa-clock" style="color:var(--amber)"></i><span>Menunggu</span><strong><?php echo $s_menunggu ?></strong></div>
          <div class="summary-item"><i class="fas fa-check-circle" style="color:var(--haqi)"></i><span>Diterima</span><strong><?php echo $s_diterima ?></strong></div>
          <div class="summary-item"><i class="fas fa-times-circle" style="color:var(--red)"></i><span>Tidak Diterima</span><strong><?php echo $s_tidak ?></strong></div>
          <div class="summary-item"><i class="fas fa-edit" style="color:var(--purple)"></i><span>Diperiksa</span><strong><?php echo $s_diperiksa ?></strong></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card-modern">
      <div class="card-modern-header" style="border-bottom:none;">
        <h5 class="card-modern-title">Per Jenjang Pendidikan</h5>
      </div>
      <div class="card-modern-body" style="padding:0;">
        <table class="table-modern">
          <thead>
            <tr>
              <th>Jenjang</th>
              <th>Status</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($akumulasi as $a): ?>
            <tr>
              <td><strong><?php echo esc($a->judul_jenjang_pendidikan) ?></strong></td>
              <td>
                <?php if($a->status_pendaftaran=='Menunggu'): ?>
                  <span class="badge-pill badge-amber"><i class="fas fa-clock"></i> Menunggu</span>
                <?php elseif($a->status_pendaftaran=='Diterima'): ?>
                  <span class="badge-pill badge-green"><i class="fas fa-check-circle"></i> Diterima</span>
                <?php elseif($a->status_pendaftaran=='Tidak-Diterima'): ?>
                  <span class="badge-pill badge-red"><i class="fas fa-times-circle"></i> Ditolak</span>
                <?php else: ?>
                  <span class="badge-pill badge-blue"><i class="fas fa-tasks"></i> <?php echo esc($a->status_pendaftaran) ?></span>
                <?php endif; ?>
              </td>
              <td><strong><?php echo esc($a->jumlah_siswa) ?></strong></td>
              <td>
                <div class="table-actions">
                  <a href="<?php echo base_url('admin/gelombang/detail/'.$gelombang->id_gelombang.'/'.$a->status_pendaftaran.'/'.$a->id_jenjang_pendidikan) ?>" class="btn btn-action btn-primary-action"><i class="fas fa-eye"></i></a>
                  <a href="<?php echo base_url('admin/gelombang/export/'.$gelombang->id_gelombang.'/'.$a->status_pendaftaran.'/'.$a->id_jenjang_pendidikan) ?>" class="btn btn-action btn-success-action" target="_blank"><i class="fas fa-file-excel"></i></a>
                  <a href="<?php echo base_url('admin/gelombang/unduh_data/'.$gelombang->id_gelombang.'/'.$a->status_pendaftaran.'/'.$a->id_jenjang_pendidikan) ?>" class="btn btn-action btn-danger-action" target="_blank"><i class="fas fa-file-pdf"></i></a>
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

<!-- Bulk Action Form -->
<?php echo form_open(base_url('admin/gelombang/detail/'.$gelombang->id_gelombang.'/'.$status_pendaftaran.'/'.$id_jenjang_pendidikan)) ?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/','',CURRENT_URL()) ?>">

<div class="card-modern mb-4">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-users" style="color:var(--haqi);margin-right:0.4rem;"></i> Data Pendaftar (<?php echo count($siswa) ?>)</h5>
    <div class="bulk-actions">
      <select name="status_pendaftaran" class="form-select form-select-sm" style="width:auto;display:inline-block;">
        <option value="">Ubah Status...</option>
        <option value="Menunggu">Menunggu</option>
        <option value="Diterima">Diterima</option>
        <option value="Tidak-Diterima">Tidak Diterima</option>
        <option value="Diperiksa">Diperiksa</option>
      </select>
      <button type="submit" name="submit" value="update" class="btn btn-success btn-lg rounded-pill">
        <i class="fas fa-save"></i> Update Status
      </button>
    </div>
  </div>
  <div class="card-modern-body" style="padding:0;">
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
          <?php if(empty($siswa)): ?>
          <tr>
            <td colspan="6" class="text-center" style="padding:2rem;color:var(--gray);">
              <i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:0.5rem;"></i>
              Tidak ada data pendaftar
            </td>
          </tr>
          <?php else: ?>
          <?php foreach($siswa as $s): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="id_siswa[]" value="<?php echo esc($s->id_siswa) ?>" class="form-check-input row-check">
            </td>
            <td>
              <strong class="table-name"><?php echo esc($s->nama_siswa) ?></strong>
              <div class="table-meta">
                <span><i class="fas fa-graduation-cap"></i> <?php echo esc($s->judul_jenjang_pendidikan) ?></span>
                <span><i class="fas fa-id-card"></i> <?php echo esc($s->kode_siswa) ?></span>
                <span><i class="fas fa-birthday-cake"></i> <?php echo esc($s->usia_teks) ?></span>
                <span><i class="fas fa-user"></i> <?php echo esc($s->nama_wali) ?></span>
              </div>
            </td>
            <td>
              <div class="table-address"><?php echo esc($s->alamat) ?></div>
              <div class="table-meta">
                <span><i class="fas fa-phone"></i> <?php echo esc($s->telepon) ?></span>
                <span><i class="fas fa-envelope"></i> <?php echo esc($s->email) ?></span>
              </div>
            </td>
            <td class="text-center">
              <div class="doc-status">
                <span class="doc-num <?php echo ($s->dokumen_wajib_upload >= $s->dokumen_wajib_total) ? 'doc-ok' : 'doc-missing' ?>"><?php echo $s->dokumen_wajib_upload ?>/<?php echo $s->dokumen_wajib_total ?></span>
                <small>Wajib</small>
              </div>
              <div class="doc-status">
                <span class="doc-num <?php echo ($s->dokumen_tidak_wajib_upload >= $s->dokumen_tidak_wajib_total) ? 'doc-ok' : 'doc-missing' ?>"><?php echo $s->dokumen_tidak_wajib_upload ?>/<?php echo $s->dokumen_tidak_wajib_total ?></span>
                <small>Tidak Wajib</small>
              </div>
            </td>
            <td>
              <?php if($s->status_pendaftaran=='Menunggu'): ?>
                <span class="badge-pill badge-amber"><i class="fas fa-clock"></i> Menunggu</span>
              <?php elseif($s->status_pendaftaran=='Diterima'): ?>
                <span class="badge-pill badge-green"><i class="fas fa-check-circle"></i> Diterima</span>
              <?php elseif($s->status_pendaftaran=='Tidak-Diterima'): ?>
                <span class="badge-pill badge-red"><i class="fas fa-times-circle"></i> Ditolak</span>
              <?php else: ?>
                <span class="badge-pill badge-blue"><i class="fas fa-tasks"></i> <?php echo esc($s->status_pendaftaran) ?></span>
              <?php endif; ?>
            </td>
            <td>
              <div class="table-actions">
                <a href="<?php echo base_url('admin/gelombang/dokumen/'.$s->slug_siswa) ?>" class="btn btn-action btn-primary-action" title="Review"><i class="fas fa-tasks"></i></a>
                <a href="<?php echo base_url('admin/gelombang/edit_siswa/'.$s->slug_siswa) ?>" class="btn btn-action btn-secondary-action" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="<?php echo base_url('admin/gelombang/cetak/'.$s->slug_siswa) ?>" class="btn btn-action btn-danger-action" title="Unduh PDF" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <?php if($s->status_pendaftaran=='Menunggu'): ?>
                  <a href="<?php echo base_url('admin/gelombang/delete_siswa/'.$s->slug_siswa.'/'.$s->id_gelombang) ?>" class="btn btn-action btn-delete-action delete-link" title="Hapus"><i class="fas fa-trash"></i></a>
                <?php endif; ?>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<!-- Export Buttons -->
<div class="export-bar">
  <a href="<?php echo base_url('admin/gelombang/export/'.$gelombang->id_gelombang.'/'.$status_pendaftaran.'/'.$id_jenjang_pendidikan) ?>" class="btn btn-action btn-success-action" target="_blank">
    <i class="fas fa-file-excel"></i> Ekspor Excel
  </a>
  <a href="<?php echo base_url('admin/gelombang/unduh_data/'.$gelombang->id_gelombang/'.$status_pendaftaran.'/'.$id_jenjang_pendidikan) ?>" class="btn btn-action btn-danger-action" target="_blank">
    <i class="fas fa-file-pdf"></i> Cetak PDF
  </a>
  <a href="<?php echo base_url('admin/gelombang/unduh_pengumuman/'.$gelombang->id_gelombang/'.$status_pendaftaran/'.$id_jenjang_pendidikan) ?>" class="btn btn-action btn-danger-action" target="_blank">
    <i class="fas fa-file-pdf"></i> Cetak Pengumuman
  </a>
  <a href="<?php echo base_url('pendaftaran') ?>" class="btn btn-action btn-primary-action" target="_blank">
    <i class="fas fa-eye"></i> Lihat Form Pendaftaran
  </a>
</div>

<!-- Check All Script -->
<script>
document.getElementById('checkAll')?.addEventListener('change', function() {
  document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
});
</script>
