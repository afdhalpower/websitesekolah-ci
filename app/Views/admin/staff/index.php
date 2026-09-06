<?php include('tambah.php'); ?>

<!-- Page Header -->
<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-users"></i> Staff & Tim</h1>
    <p class="page-subtitle">Kelola data staff dan tim sekolah</p>
  </div>
  <button type="button" class="btn btn-primary-action" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Baru
  </button>
</div>

<!-- Bulk Action Form -->
<?= form_open(base_url('admin/staff/proses')) ?>
<input type="hidden" name="pengalihan" value="<?= str_replace('index.php','',CURRENT_URL()) ?>">

<div class="card-modern">
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="3%" class="text-center">
              <input type="checkbox" id="check-all" onclick="toggleAll(this)">
            </th>
            <th width="5%">No</th>
            <th width="6%">Foto</th>
            <th width="18%">Nama</th>
            <th width="20%">Informasi</th>
            <th width="18%">Kontak</th>
            <th width="5%">L/P</th>
            <th width="8%">Status</th>
            <th width="12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($staff as $s): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="id_staff[]" value="<?= esc($s->id_staff) ?>"
                     class="row-check" onchange="updateCount()">
            </td>
            <td class="text-center"><?= esc($no) ?></td>
            <td>
              <?php if($s->gambar != ''): ?>
                <img src="<?= base_url('assets/upload/staff/thumbs/'.$s->gambar) ?>" style="width:45px;height:45px;object-fit:cover;border-radius:50%;" alt="">
              <?php else: ?>
                <div style="width:45px;height:45px;background:var(--bg);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.7rem;">
                  <i class="fas fa-user"></i>
                </div>
              <?php endif; ?>
            </td>
            <td>
              <a href="<?= base_url('admin/staff/edit/'.$s->id_staff) ?>" style="font-weight:500;color:var(--text);text-decoration:none;">
                <?= esc($s->nama) ?>
              </a>
              <div style="font-size:var(--font-xs);color:var(--muted);margin-top:2px;">
                <i class="fas fa-sitemap"></i> <?= esc($s->nama_kategori_staff) ?>
                &nbsp;<i class="fas fa-sort-numeric-up"></i> #<?= esc($s->urutan) ?>
              </div>
            </td>
            <td>
              <div style="font-size:var(--font-xs);line-height:1.8;">
                <i class="fas fa-couch"></i> <?= esc($s->jabatan) ?>
                <br><i class="fas fa-calendar-check"></i> <?= esc($s->tempat_lahir) ?>, <?= esc($this->website->tanggal_id($s->tanggal_lahir)) ?>
                <br><i class="fas fa-tasks"></i> <?= esc($s->keahlian) ?>
              </div>
            </td>
            <td>
              <div style="font-size:var(--font-xs);line-height:1.8;">
                <i class="fas fa-phone"></i> <?= esc($s->telepon) ?>
                <br><i class="fas fa-envelope"></i> <?= esc($s->email) ?>
                <br><i class="fas fa-map-marker-alt"></i> <?= esc($s->alamat) ?>
              </div>
            </td>
            <td class="text-center">
              <?php if($s->jenis_kelamin=='P'): ?>
                <span class="status-badge status-info"><i class="fas fa-venus"></i> P</span>
              <?php else: ?>
                <span class="status-badge status-success"><i class="fas fa-mars"></i> L</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if($s->status_staff=='Publish'): ?>
                <span class="status-badge status-success"><i class="fas fa-eye"></i> Publish</span>
              <?php else: ?>
                <span class="status-badge status-warning"><i class="fas fa-eye-slash"></i> Draft</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="d-flex gap-1">
                <a href="<?= base_url('admin/user?id_staff='.$s->id_staff) ?>" class="btn btn-secondary-action btn-sm" title="Akses Akun">
                  <i class="fas fa-lock"></i>
                </a>
                <a href="<?= base_url('admin/staff/edit/'.$s->id_staff) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/staff/delete/'.$s->id_staff) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php $no++; endforeach; ?>
        </tbody>
      </table>
    </div>

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
