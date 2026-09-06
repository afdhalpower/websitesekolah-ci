<!-- Page Header -->
<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Agenda & Even</h1>
    <p class="page-subtitle">Kelola agenda, even, dan kegiatan sekolah</p>
  </div>
  <a href="<?= base_url('admin/agenda/tambah') ?>" class="btn btn-primary-action">
    <i class="fas fa-plus"></i> Tambah Agenda
  </a>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
  <div class="col-md-4">
    <div class="stat-card stat-card-blue">
      <div class="stat-card-icon"><i class="fas fa-calendar-alt"></i></div>
      <div class="stat-card-value"><?= esc($stats['total'] ?? 0) ?></div>
      <div class="stat-card-label">Total Agenda</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card stat-card-green">
      <div class="stat-card-icon"><i class="fas fa-eye"></i></div>
      <div class="stat-card-value"><?= esc($stats['publish'] ?? 0) ?></div>
      <div class="stat-card-label">Published</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card stat-card-amber">
      <div class="stat-card-icon"><i class="fas fa-eye-slash"></i></div>
      <div class="stat-card-value"><?= esc($stats['draft'] ?? 0) ?></div>
      <div class="stat-card-label">Draft</div>
    </div>
  </div>
</div>

<!-- Search Bar -->
<div class="card-modern mb-3">
  <div class="card-modern-body" style="padding: 1rem 1.25rem;">
    <form action="<?= base_url('admin/agenda/cari') ?>" method="get" class="filter-bar">
      <div class="input-group" style="max-width: 400px;">
        <input type="text" name="keywords" class="form-control" placeholder="Cari agenda..."
               value="<?= isset($_GET['keywords']) ? esc($_GET['keywords']) : '' ?>">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary-action">
            <i class="fas fa-search"></i> Cari
          </button>
        </span>
      </div>
      <?php if(isset($_GET['keywords'])): ?>
        <a href="<?= base_url('admin/agenda') ?>" class="btn btn-secondary-action">
          <i class="fas fa-times"></i> Reset
        </a>
      <?php endif; ?>
    </form>
  </div>
</div>

<!-- Bulk Action Form -->
<?= form_open(base_url('admin/agenda/proses')) ?>

<!-- Bulk Action Bar -->
<div class="bulk-action-bar mb-3">
  <div class="d-flex align-items-center gap-2">
    <button type="button" class="btn btn-secondary-action btn-sm" onclick="toggleAll(this)">
      <i class="far fa-square"></i> Semua
    </button>
    <span class="text-muted" style="font-size: var(--font-xs);" id="selected-count">0 dipilih</span>
  </div>
  <div class="d-flex align-items-center gap-2">
    <button type="submit" name="hapus" class="btn btn-danger-action btn-sm" onClick="check();">
      <i class="fas fa-trash"></i> Hapus
    </button>
    <button type="submit" name="draft" class="btn btn-secondary-action btn-sm" onClick="check();">
      <i class="fas fa-eye-slash"></i> Draft
    </button>
    <button type="submit" name="publish" class="btn btn-success-action btn-sm" onClick="check();">
      <i class="fas fa-eye"></i> Publish
    </button>
    <select name="id_kategori_agenda" class="form-select form-select-sm" style="max-width: 180px; font-size: var(--font-xs);">
      <?php foreach($kategori_agenda as $ka): ?>
      <option value="<?= esc($ka['id_kategori_agenda']) ?>"><?= esc($ka['nama_kategori_agenda']) ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="update" class="btn btn-info-action btn-sm">
      <i class="fas fa-sync"></i> Update
    </button>
  </div>
</div>

<!-- Table -->
<div class="card-modern">
  <div class="card-modern-body" style="padding: 0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="3%" class="text-center">
              <input type="checkbox" id="check-all" onclick="toggleAll(this)">
            </th>
            <th width="6%">Gambar</th>
            <th>Nama Agenda</th>
            <th width="15%">Venue</th>
            <th width="15%">Pendaftaran</th>
            <th width="10%">Status</th>
            <th width="12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; foreach($agenda as $a): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="id_agenda[]" value="<?= esc($a['id_agenda']) ?>"
                     class="row-check" onchange="updateCount()">
            </td>
            <td>
              <?php if($a['gambar'] != ''): ?>
                <img src="<?= base_url('assets/upload/image/thumbs/'.$a['gambar']) ?>" class="berita-thumb" alt="">
              <?php else: ?>
                <div style="width:60px;height:45px;background:var(--bg);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.7rem;">
                  <i class="fas fa-calendar"></i>
                </div>
              <?php endif; ?>
            </td>
            <td>
              <a href="<?= base_url('agenda/detail/'.$a['slug_agenda']) ?>" target="_blank" style="font-weight:500;color:var(--text);text-decoration:none;">
                <?= esc($a['nama_agenda']) ?> <i class="fas fa-external-link-alt" style="font-size:0.6rem;color:var(--muted);"></i>
              </a>
              <div class="berita-meta mt-1">
                <i class="fas fa-code"></i> <?= esc($a['kode_agenda']) ?>
                <i class="fas fa-sort-numeric-up" style="margin-left:0.5rem;"></i> <?= esc($a['urutan']) ?>
                <br>
                <a href="<?= base_url('admin/agenda/kategori/'.$a['id_kategori_agenda']) ?>" class="status-badge status-info" style="text-decoration:none;">
                  <?= esc($a['nama_kategori_agenda']) ?>
                </a>
              </div>
            </td>
            <td>
              <span style="font-size:var(--font-xs);font-weight:500;"><?= esc($a['nama_tempat']) ?></span>
              <div class="berita-meta mt-1">
                <i class="fas fa-map"></i> <?= esc($a['link_google_map']) ?>
                <br>
                <span style="color:var(--muted);"><?= strip_tags($a['alamat']) ?></span>
              </div>
            </td>
            <td>
              <span style="font-weight:600;color:var(--green);">Rp <?= number_format($a['harga'],0,',','.') ?></span>
              <div class="berita-meta mt-1">
                <i class="fas fa-shopping-cart" style="color:var(--amber);"></i> Rp <?= number_format($a['harga_diskon'],0,',','.') ?>
                <br>
                <i class="fas fa-calendar-check"></i> <?= esc($this->website->tanggal_id($a['tanggal_buka'])) ?> - <?= esc($this->website->tanggal_id($a['tanggal_tutup'])) ?>
                <br>
                <i class="fas fa-calendar-times"></i> <?= esc($this->website->tanggal_id($a['tanggal_mulai'])) ?> - <?= esc($this->website->tanggal_id($a['tanggal_selesai'])) ?>
              </div>
            </td>
            <td class="text-center">
              <?php if($a['status_agenda'] == 'Publish'): ?>
                <a href="<?= base_url('admin/agenda/status_agenda/Publish') ?>" class="status-badge status-success" style="text-decoration:none;">
                  <i class="fas fa-eye"></i> Publish
                </a>
              <?php else: ?>
                <a href="<?= base_url('admin/agenda/status_agenda/Draft') ?>" class="status-badge status-warning" style="text-decoration:none;">
                  <i class="fas fa-eye-slash"></i> Draft
                </a>
              <?php endif; ?>
              <br>
              <?php if($a['status_pendaftaran'] == 'Buka'): ?>
                <span class="status-badge status-info" style="margin-top:0.25rem;">
                  <i class="fas fa-check-circle"></i> Buka
                </span>
              <?php else: ?>
                <span class="status-badge status-danger" style="margin-top:0.25rem;">
                  <i class="fas fa-times-circle"></i> Tutup
                </span>
              <?php endif; ?>
            </td>
            <td>
              <div class="d-flex gap-1 flex-wrap">
                <a href="<?= base_url('admin/agenda/gambar/'.$a['id_agenda']) ?>" class="btn btn-success-action btn-sm" title="Gambar">
                  <i class="fas fa-image"></i>
                </a>
                <a href="<?= base_url('admin/agenda/jadwal/'.$a['id_agenda']) ?>" class="btn btn-info-action btn-sm" title="Jadwal">
                  <i class="fas fa-calendar-check"></i>
                </a>
                <a href="<?= base_url('admin/agenda/edit/'.$a['id_agenda']) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/agenda/delete/'.$a['id_agenda']) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php $i++; endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php if(isset($pagin) && $pagin): ?>
    <div class="pagination-row">
      <?= esc($pagin) ?>
    </div>
    <?php endif; ?>
  </div>
</div>

<?= form_close() ?>

<script>
function toggleAll(el) {
  const checks = document.querySelectorAll('.row-check');
  const checked = el.type === 'checkbox' ? el.checked : !document.getElementById('check-all').checked;
  checks.forEach(c => c.checked = checked);
  document.getElementById('check-all').checked = checked;
  updateCount();
}
function updateCount() {
  const count = document.querySelectorAll('.row-check:checked').length;
  document.getElementById('selected-count').textContent = count + ' dipilih';
}
</script>
