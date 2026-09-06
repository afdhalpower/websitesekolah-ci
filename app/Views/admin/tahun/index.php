<?php include('tambah.php'); ?>

<div class="page-header-modern mb-4">
  <div>
    <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Tahun Ajaran</h1>
    <p class="page-subtitle">Kelola daftar tahun ajaran</p>
  </div>
</div>

<div class="card-modern">
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="5%" class="text-center">No</th>
            <th>Nama Tahun</th>
            <th>Periode</th>
            <th>Keterangan</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($tahun as $t): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td style="font-weight:500;"><?= esc($t->nama_tahun) ?></td>
            <td><span class="badge" style="background:rgba(34,197,94,0.1);color:var(--green);padding:4px 10px;border-radius:20px;font-size:var(--font-xs);"><?= esc($t->tahun_mulai) ?> - <?= esc($t->tahun_selesai) ?></span></td>
            <td style="font-size:var(--font-sm);color:var(--muted);"><?= esc($t->keterangan) ?></td>
            <td>
              <div class="d-flex gap-1">
                <a href="<?= base_url('admin/tahun/edit/'.$t->id_tahun) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/tahun/delete/'.$t->id_tahun) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
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
