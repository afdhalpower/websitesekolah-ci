<?php include('tambah.php'); ?>

<!-- Page Header -->
<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-video"></i> Video</h1>
    <p class="page-subtitle">Kelola video YouTube sekolah</p>
  </div>
  <button type="button" class="btn btn-primary-action" data-toggle="modal" data-target="#modal-tambah">
    <i class="fas fa-plus"></i> Tambah Baru
  </button>
</div>

<!-- Bulk Action Form -->
<div class="card-modern">
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="7%">Gambar</th>
            <th>Judul</th>
            <th width="25%">Video</th>
            <th width="8%">Status</th>
            <th width="6%">Urutan</th>
            <th width="6%">Hits</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($video as $v): ?>
          <tr>
            <td class="text-center"><?= esc($no) ?></td>
            <td>
              <?php if($v->gambar != ''): ?>
                <img src="<?= base_url('assets/upload/image/thumbs/'.$v->gambar) ?>" style="width:50px;height:40px;object-fit:cover;border-radius:6px;" alt="">
              <?php else: ?>
                <div style="width:50px;height:40px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:0.7rem;">
                  <i class="fas fa-image"></i>
                </div>
              <?php endif; ?>
            </td>
            <td>
              <a href="<?= base_url('admin/video/edit/'.$v->id_video) ?>" style="font-weight:500;color:var(--text);text-decoration:none;">
                <?= esc($v->judul) ?>
              </a>
              <div style="font-size:var(--font-xs);color:var(--muted);margin-top:2px;">
                <i class="fas fa-code"></i> <?= esc($v->video) ?>
                &nbsp;<i class="fas fa-map-pin"></i> <?= esc($v->posisi_video) ?>
              </div>
            </td>
            <td>
              <div class="embed-responsive embed-responsive-16by9" style="max-width:200px;">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= esc($v->video) ?>?rel=0" allowfullscreen></iframe>
              </div>
            </td>
            <td>
              <?php if($v->status_video=='Publish'): ?>
                <span class="status-badge status-success"><i class="fas fa-eye"></i> Publish</span>
              <?php else: ?>
                <span class="status-badge status-warning"><i class="fas fa-eye-slash"></i> Draft</span>
              <?php endif; ?>
            </td>
            <td class="text-center" style="font-size:var(--font-xs);"><?= esc($v->urutan) ?></td>
            <td class="text-center" style="font-size:var(--font-xs);"><?= esc($v->hits) ?></td>
            <td>
              <div class="d-flex gap-1">
                <a href="<?= base_url('admin/video/edit/'.$v->id_video) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/video/delete/'.$v->id_video) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php $no++; endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
