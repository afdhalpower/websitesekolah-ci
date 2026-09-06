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
  <button type="button" class="btn btn-primary-action" data-toggle="modal" data-target="#modal-tambah-gambar">
    <i class="fas fa-plus"></i> Tambah Gambar
  </button>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah-gambar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-plus-circle" style="color:var(--green);"></i> Tambah Gambar</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open_multipart(base_url('admin/agenda/gambar/'.$agenda['id_agenda'])) ?>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Gambar <span class="text-danger">*</span></label>
            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp" required>
          </div>
          <div class="form-section">
            <label class="form-label">Nama Gambar</label>
            <input type="text" name="nama_gambar_agenda" class="form-control" placeholder="Nama gambar">
          </div>
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="2" placeholder="Deskripsi singkat gambar"></textarea>
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Urutan</label>
          <input type="number" name="urutan" class="form-control" value="<?= count($gambar_agenda)+1 ?>" min="1">
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
    <h5 class="card-modern-title"><i class="fas fa-images"></i> Daftar Gambar (<?= count($gambar_agenda)+1 ?>)</h5>
  </div>
  <div class="card-modern-body" style="padding:0;">
    <div class="table-responsive">
      <table class="table-modern" id="example3">
        <thead>
          <tr>
            <th width="5%" class="text-center">#</th>
            <th width="10%">Gambar</th>
            <th width="20%">Nama</th>
            <th>Keterangan</th>
            <th width="8%">Urutan</th>
            <th width="12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Gambar utama -->
          <tr style="background:rgba(22,99,8,0.04);">
            <td class="text-center"><strong>1</strong></td>
            <td>
              <?php if($agenda['gambar'] != ''): ?>
                <img src="<?= base_url('assets/upload/image/thumbs/'.$agenda['gambar']) ?>" class="berita-thumb" alt="">
              <?php else: ?>
                <span style="font-size:var(--font-xs);color:var(--muted);">Tidak ada</span>
              <?php endif; ?>
            </td>
            <td><strong><?= esc($agenda['nama_agenda']) ?></strong></td>
            <td><span class="status-badge status-success">Gambar Utama</span></td>
            <td class="text-center">1</td>
            <td></td>
          </tr>
          <!-- Gambar tambahan -->
          <?php $i=2; foreach($gambar_agenda as $g): ?>
          <tr>
            <td class="text-center"><?= esc($i) ?></td>
            <td>
              <?php if($g['gambar'] != ''): ?>
                <img src="<?= base_url('assets/upload/image/thumbs/'.$g['gambar']) ?>" class="berita-thumb" alt="">
              <?php else: ?>
                <span style="font-size:var(--font-xs);color:var(--muted);">Tidak ada</span>
              <?php endif; ?>
            </td>
            <td><?= esc($g['nama_gambar_agenda']) ?></td>
            <td><?= esc($g['keterangan']) ?></td>
            <td class="text-center"><?= esc($g['urutan']) ?></td>
            <td>
              <?php include('edit_gambar.php') ?>
            </td>
          </tr>
          <?php $i++; endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
