<!-- Page Header -->
<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-images"></i> Galeri Gambar</h1>
    <p class="page-subtitle">Kelola gambar galeri, slider homepage, dan header halaman</p>
  </div>
  <a href="<?= base_url('admin/galeri/tambah') ?>" class="btn btn-primary-action">
    <i class="fas fa-plus"></i> Tambah Gambar
  </a>
</div>

<!-- Stat Cards -->
<?php if(!isset($_GET['keywords'])): ?>
<div class="row mb-4">
  <div class="col-md-4">
    <div class="stat-card stat-card-blue">
      <div class="stat-card-icon"><i class="fas fa-images"></i></div>
      <div class="stat-card-value"><?= esc($stats['total'] ?? 0) ?></div>
      <div class="stat-card-label">Total Gambar</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card stat-card-green">
      <div class="stat-card-icon"><i class="fas fa-photo-video"></i></div>
      <div class="stat-card-value"><?= esc($stats['galeri'] ?? 0) ?></div>
      <div class="stat-card-label">Galeri</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card stat-card-purple">
      <div class="stat-card-icon"><i class="fas fa-clone"></i></div>
      <div class="stat-card-value"><?= esc($stats['slider'] ?? 0) ?></div>
      <div class="stat-card-label">Slider Homepage</div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Search Bar -->
<div class="card-modern mb-3">
  <div class="card-modern-body" style="padding: 1rem 1.25rem;">
    <form action="<?= base_url('admin/galeri') ?>" method="get" class="filter-bar">
      <div class="input-group" style="max-width: 400px;">
        <input type="text" name="keywords" class="form-control" placeholder="Cari gambar..."
               value="<?= isset($_GET['keywords']) ? esc($_GET['keywords']) : '' ?>">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary-action">
            <i class="fas fa-search"></i> Cari
          </button>
        </span>
      </div>
      <?php if(isset($_GET['keywords'])): ?>
        <a href="<?= base_url('admin/galeri') ?>" class="btn btn-secondary-action">
          <i class="fas fa-times"></i> Reset
        </a>
      <?php endif; ?>
    </form>
  </div>
</div>

<!-- Bulk Action Form -->
<?= form_open(base_url('admin/galeri/proses')) ?>
<input type="hidden" name="pengalihan" value="<?= str_replace('index.php','',CURRENT_URL()) ?>">

<!-- Bulk Action Bar -->
<div class="bulk-action-bar mb-3">
  <div class="d-flex align-items-center gap-2">
    <button type="button" class="btn btn-secondary-action btn-sm" onclick="toggleAll(this)">
      <i class="far fa-square"></i> Semua
    </button>
    <span class="text-muted" style="font-size: var(--font-xs);" id="selected-count">0 dipilih</span>
  </div>
  <div class="d-flex align-items-center gap-2">
    <button type="submit" name="submit" value="Delete" class="btn btn-danger-action btn-sm">
      <i class="fas fa-trash"></i> Hapus
    </button>
    <button type="submit" name="submit" value="Draft" class="btn btn-secondary-action btn-sm">
      <i class="fas fa-eye-slash"></i> Sembunyikan
    </button>
    <button type="submit" name="submit" value="Publish" class="btn btn-success-action btn-sm">
      <i class="fas fa-eye"></i> Aktifkan
    </button>
    <select name="id_kategori_galeri" class="form-select form-select-sm" style="max-width: 180px; font-size: var(--font-xs);">
      <?php foreach($kategori_galeri as $kg): ?>
      <option value="<?= esc($kg->id_kategori_galeri) ?>"><?= esc($kg->nama_kategori_galeri) ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="submit" value="Update" class="btn btn-info-action btn-sm">
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
            <th width="8%">Gambar</th>
            <th>Judul & Link</th>
            <th width="15%">Kategori & Jenis</th>
            <th width="10%">Status</th>
            <th width="8%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($galeri as $g): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="id_galeri[]" value="<?= esc($g->id_galeri) ?>"
                     class="row-check" onchange="updateCount()">
            </td>
            <td>
              <?php if($g->gambar != ''): ?>
                <img src="<?= base_url('assets/upload/image/thumbs/'.$g->gambar) ?>" class="berita-thumb" alt="">
              <?php else: ?>
                <div style="width:60px;height:45px;background:var(--bg);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.7rem;">
                  <i class="fas fa-image"></i>
                </div>
              <?php endif; ?>
            </td>
            <td>
              <span style="font-weight:500;"><?= esc($g->judul_galeri) ?></span>
              <div class="berita-meta mt-1">
                <?php if($g->website): ?>
                  <i class="fas fa-link"></i> <?= esc($g->website) ?>
                <?php endif; ?>
                <br>
                <span style="color:var(--muted);font-size:0.7rem;">
                  <i class="fas fa-tasks"></i> <?= esc($g->status_text) ?>
                  <i class="fas fa-newspaper" style="margin-left:0.5rem;"></i> <?= esc($g->text_website) ?>
                </span>
              </div>
              <input type="text" class="form-control form-control-sm mt-1" readonly
                     value="<?= base_url('assets/upload/image/'.$g->gambar) ?>"
                     style="font-size:var(--font-xs);max-width:300px;">
            </td>
            <td>
              <div style="font-size:var(--font-xs);line-height:1.8;">
                <span class="status-badge status-info"><?= esc($g->nama_kategori_galeri) ?></span>
                <br>
                <span style="color:var(--muted);"><?= esc($g->jenis_galeri) ?></span>
              </div>
            </td>
            <td>
              <span style="font-size:var(--font-xs);color:var(--muted);">
                <i class="fas fa-user"></i> <?= esc($g->nama) ?>
              </span>
            </td>
            <td>
              <div class="d-flex gap-1">
                <a href="<?= base_url('admin/galeri/edit/'.$g->id_galeri) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/galeri/delete/'.$g->id_galeri) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php if(isset($pagination) && $pagination): ?>
    <div class="pagination-row">
      <?= str_replace('index.php/','',$pagination) ?>
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
