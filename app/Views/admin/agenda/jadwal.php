<!-- Page Header -->
<div class="mb-3 d-flex justify-content-between align-items-center">
  <div>
    <a href="<?= base_url('admin/agenda') ?>" class="btn btn-secondary-action">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
    <span style="margin-left:0.5rem;font-size:var(--font-sm);color:var(--muted);">
      Agenda: <strong><?= esc($agenda['nama_agenda']) ?></strong>
    </span>
  </div>
  <button type="button" class="btn btn-primary-action" data-toggle="modal" data-target="#modal-tambah-jadwal">
    <i class="fas fa-plus"></i> Tambah Jadwal
  </button>
</div>

<!-- Include Modal Tambah -->
<?php include('tambah_jadwal.php') ?>

<!-- Table -->
<?= form_open(base_url('admin/agenda/proses_jadwal')) ?>
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-calendar-check"></i> Daftar Jadwal (<?= count($jadwal) ?>)</h5>
  </div>
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="5%" class="text-center">No</th>
            <th width="15%">Tanggal</th>
            <th width="15%">Lokasi</th>
            <th>Keterangan</th>
            <th width="15%">Pembicara</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($jadwal as $j): ?>
          <tr>
            <td class="text-center"><?= esc($no) ?></td>
            <td><span style="font-weight:500;"><?= date('d-m-Y', strtotime($j->tanggal_mulai)) ?></span></td>
            <td><?= esc($j->nama_tempat) ?></td>
            <td><?= esc($j->keterangan) ?></td>
            <td><span class="status-badge status-info"><?= esc($j->pembicara) ?></span></td>
            <td>
              <div class="d-flex gap-1">
                <a href="<?= base_url('admin/agenda/edit_jadwal/'.$j->id_jadwal) ?>" class="btn btn-primary-action btn-sm" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/agenda/delete_jadwal/'.$agenda['id_agenda'].'/'.$j->id_jadwal) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
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
<?= form_close() ?>
