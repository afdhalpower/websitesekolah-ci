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
  <button type="button" class="btn btn-primary-action" data-toggle="modal" data-target="#modal-tambah-lokasi">
    <i class="fas fa-plus"></i> Tambah Lokasi
  </button>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah-lokasi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-plus-circle" style="color:var(--green);"></i> Tambah Lokasi</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open(base_url('admin/agenda/lokasi/'.$agenda['id_agenda'])) ?>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="info-box-modern" style="background:rgba(59,130,246,0.06);border:1px solid rgba(59,130,246,0.15);margin-bottom:1rem;">
          <div class="info-box-icon"><i class="fas fa-info-circle" style="color:var(--blue);"></i></div>
          <div class="info-box-content">Pilih lokasi desa untuk agenda ini.</div>
        </div>
        <div class="form-section">
          <label class="form-label">Nama Desa <span class="text-danger">*</span></label>
          <select name="id_desa" class="form-select" required>
            <option value="">— Pilih Lokasi —</option>
            <?php foreach($desa as $d): ?>
            <option value="<?= esc($d['id_desa']) ?>"><?= esc($d['nama_desa']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer" style="border-top:1px solid var(--border);padding:0.75rem 1.5rem;">
        <button type="button" class="btn btn-secondary-action" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
        <button type="submit" name="simpan" class="btn btn-success-action"><i class="fas fa-save"></i> Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-map-marker-alt"></i> Daftar Lokasi (<?= count($lokasi_agenda) ?>)</h5>
  </div>
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="5%" class="text-center">#</th>
            <th width="30%">Agenda</th>
            <th>Desa / Lokasi</th>
            <th width="12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; foreach($lokasi_agenda as $l): ?>
          <tr>
            <td class="text-center"><?= esc($i) ?></td>
            <td><span style="font-weight:500;"><?= esc($agenda['nama_agenda']) ?></span></td>
            <td>
              <span class="status-badge status-info"><i class="fas fa-map-marker-alt"></i> <?= esc($l['nama_desa']) ?></span>
            </td>
            <td>
              <div class="d-flex gap-1">
                <?php include('edit_lokasi.php') ?>
                <a href="<?= base_url('admin/agenda/delete_lokasi/'.$l['id_lokasi_agenda'].'/'.$agenda['id_agenda']) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php $i++; endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
