<?php include('tambah.php'); ?>

<!-- Page Header -->
<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-running"></i> Ekstrakurikuler</h1>
    <p class="page-subtitle">Kelola kegiatan ekstrakurikuler sekolah</p>
  </div>
  <button type="button" class="btn btn-primary-action" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Baru
  </button>
</div>

<!-- Bulk Action Form -->
<?= form_open(base_url('admin/ekstrakurikuler/proses')) ?>
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
            <th width="7%">Gambar</th>
            <th>Judul Ekstrakurikuler</th>
            <th width="15%">Kategori</th>
            <th width="8%">Status</th>
            <th width="6%">Hits</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($ekstrakurikuler as $ek): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="id_ekstrakurikuler[]" value="<?= esc($ek->id_ekstrakurikuler) ?>"
                     class="row-check" onchange="updateCount()">
            </td>
            <td class="text-center"><?= esc($no) ?></td>
            <td>
              <?php if($ek->gambar != ''): ?>
                <img src="<?= base_url('assets/upload/image/thumbs/'.$ek->gambar) ?>" style="width:50px;height:40px;object-fit:cover;border-radius:6px;" alt="">
              <?php else: ?>
                <div style="width:50px;height:40px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.7rem;">
                  <i class="fas fa-image"></i>
                </div>
              <?php endif; ?>
            </td>
            <td>
              <a href="<?= base_url('admin/ekstrakurikuler/edit/'.$ek->id_ekstrakurikuler) ?>" style="font-weight:500;color:var(--text);text-decoration:none;">
                <?= esc($ek->judul_ekstrakurikuler) ?>
              </a>
              <div style="font-size:var(--font-xs);color:var(--muted);margin-top:2px;">
                <i class="fas fa-user"></i> <?= esc($ek->nama_penanggung_jawab) ?>
              </div>
            </td>
            <td>
              <span class="status-badge status-info" style="font-size:var(--font-xs);">
                <?= esc($ek->nama_kategori_ekstrakurikuler) ?>
              </span>
            </td>
            <td>
              <?php if($ek->status_ekstrakurikuler=='Publish'): ?>
                <span class="status-badge status-success"><i class="fas fa-eye"></i> Publish</span>
              <?php else: ?>
                <span class="status-badge status-warning"><i class="fas fa-eye-slash"></i> Draft</span>
              <?php endif; ?>
            </td>
            <td class="text-center" style="font-size:var(--font-xs);"><?= esc($ek->hits) ?></td>
            <td>
              <div class="d-flex gap-1">
                <a href="<?= base_url('admin/ekstrakurikuler/edit/'.$ek->id_ekstrakurikuler) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/ekstrakurikuler/delete/'.$ek->id_ekstrakurikuler) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
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
