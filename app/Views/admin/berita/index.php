<!-- Page Header -->
<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-newspaper"></i> Berita & Artikel</h1>
    <p class="page-subtitle">Kelola berita, profil, dan layanan sekolah</p>
  </div>
  <a href="<?= base_url('admin/berita/tambah') ?>" class="btn btn-primary-action">
    <i class="fas fa-plus"></i> Tulis Berita Baru
  </a>
</div>

<!-- Stat Cards -->
<?php if(!isset($_GET['keywords'])): ?>
<div class="row mb-4">
  <div class="col-md-4">
    <div class="stat-card stat-card-blue">
      <div class="stat-card-icon"><i class="fas fa-newspaper"></i></div>
      <div class="stat-card-value"><?= esc($stats['total'] ?? 0) ?></div>
      <div class="stat-card-label">Total Berita</div>
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
<?php endif; ?>

<div class="row">
  <!-- Main Content -->
  <div class="col-lg-9">
    <!-- Search & Filter Bar -->
    <div class="card-modern mb-3">
      <div class="card-modern-body" style="padding: 1rem 1.25rem;">
        <form action="<?= base_url('admin/berita') ?>" method="get" class="filter-bar">
          <div class="input-group" style="max-width: 400px;">
            <input type="text" name="keywords" class="form-control" placeholder="Cari berita..."
                   value="<?= isset($_GET['keywords']) ? esc($_GET['keywords']) : '' ?>">
            <span class="input-group-append">
              <button type="submit" class="btn btn-primary-action">
                <i class="fas fa-search"></i> Cari
              </button>
            </span>
          </div>
          <?php if(isset($_GET['keywords'])): ?>
            <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary-action">
              <i class="fas fa-times"></i> Reset
            </a>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <!-- Bulk Action Form -->
    <?= form_open(base_url('admin/berita/proses')) ?>
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
        <button type="submit" name="submit" value="Delete" class="btn btn-danger-action btn-sm" title="Hapus">
          <i class="fas fa-trash"></i> Hapus
        </button>
        <button type="submit" name="submit" value="Draft" class="btn btn-secondary-action btn-sm" title="Draft">
          <i class="fas fa-eye-slash"></i> Draft
        </button>
        <button type="submit" name="submit" value="Publish" class="btn btn-success-action btn-sm" title="Publish">
          <i class="fas fa-eye"></i> Publish
        </button>
        <select name="jenis_berita" class="form-select form-select-sm" style="max-width: 150px; font-size: var(--font-xs);">
          <option value="Berita">Berita</option>
          <option value="Profil">Profil</option>
          <option value="Layanan">Layanan</option>
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
                <th width="7%">Gambar</th>
                <th>Judul Berita</th>
                <th width="20%">Kategori & Jenis</th>
                <th width="8%">Status</th>
                <th width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($berita as $b): ?>
              <tr>
                <td class="text-center">
                  <input type="checkbox" name="id_berita[]" value="<?= esc($b->id_berita) ?>"
                         class="row-check" onchange="updateCount()">
                </td>
                <td>
                  <?php if($b->gambar != ''): ?>
                    <img src="<?= base_url('assets/upload/image/thumbs/'.$b->gambar) ?>" class="berita-thumb" alt="">
                  <?php else: ?>
                    <div style="width:60px;height:45px;background:var(--bg);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.7rem;">
                      <i class="fas fa-image"></i>
                    </div>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?= base_url('admin/berita/edit/'.$b->id_berita) ?>" style="font-weight:500;color:var(--text);text-decoration:none;">
                    <?= esc($b->judul_berita) ?>
                  </a>
                  <div class="berita-meta mt-1">
                    <i class="fas fa-calendar-check"></i> <?= esc($this->website->tanggal_bulan_menit($b->tanggal_publish)) ?>
                    <i class="fas fa-eye" style="margin-left:0.5rem;"></i> <?= esc($b->hits) ?>
                    <i class="fas fa-sort-numeric-up" style="margin-left:0.5rem;"></i> <?= esc($b->urutan) ?>
                  </div>
                </td>
                <td>
                  <div style="font-size:var(--font-xs);line-height:1.8;">
                    <a href="<?= base_url('admin/berita/kategori/'.$b->id_kategori) ?>" class="status-badge status-info" style="text-decoration:none;">
                      <?= esc($b->nama_kategori) ?>
                    </a>
                    <br>
                    <a href="<?= base_url('admin/berita/jenis_berita/'.$b->jenis_berita) ?>" style="color:var(--muted);text-decoration:none;">
                      <?= esc($b->jenis_berita) ?>
                    </a>
                    <br>
                    <a href="<?= base_url('admin/berita/author/'.$b->id_user) ?>" style="color:var(--muted);text-decoration:none;">
                      <i class="fas fa-user"></i> <?= esc($b->nama) ?>
                    </a>
                  </div>
                </td>
                <td>
                  <?php if($b->status_berita == 'Publish'): ?>
                    <a href="<?= base_url('admin/berita/status_berita/Publish') ?>" class="status-badge status-success" style="text-decoration:none;">
                      <i class="fas fa-eye"></i> Publish
                    </a>
                  <?php else: ?>
                    <a href="<?= base_url('admin/berita/status_berita/Draft') ?>" class="status-badge status-warning" style="text-decoration:none;">
                      <i class="fas fa-eye-slash"></i> Draft
                    </a>
                  <?php endif; ?>
                </td>
                <td>
                  <div class="d-flex gap-1">
                    <a href="<?= base_url('berita/read/'.$b->slug_berita) ?>" class="btn btn-info-action btn-sm" target="_blank" title="Lihat">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?= base_url('admin/berita/edit/'.$b->id_berita) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?= base_url('admin/berita/delete/'.$b->id_berita) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
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
  </div>

  <!-- Sidebar: Kategori -->
  <div class="col-lg-3">
    <div class="card-modern">
      <div class="card-modern-header">
        <h5 class="card-modern-title"><i class="fas fa-tags"></i> Kategori</h5>
      </div>
      <div class="card-modern-body">
        <?php if(!empty($kategori)): ?>
        <ul class="kategori-list">
          <?php foreach($kategori as $k): ?>
          <li>
            <a href="<?= base_url('admin/berita/kategori/'.$k->id_kategori) ?>">
              <span><?= esc($k->nama_kategori) ?></span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p style="font-size:var(--font-xs);color:var(--muted);margin:0;">Belum ada kategori</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Kategori Management -->
    <div class="card-modern mt-3">
      <div class="card-modern-header">
        <h5 class="card-modern-title"><i class="fas fa-cog"></i> Kelola</h5>
      </div>
      <div class="card-modern-body">
        <a href="<?= base_url('admin/kategori') ?>" class="btn btn-secondary-action btn-sm w-100 mb-2" style="justify-content:center;">
          <i class="fas fa-list"></i> Kelola Kategori
        </a>
        <a href="<?= base_url('admin/berita/tambah') ?>" class="btn btn-primary-action btn-sm w-100" style="justify-content:center;">
          <i class="fas fa-plus"></i> Tulis Baru
        </a>
      </div>
    </div>
  </div>
</div>

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
