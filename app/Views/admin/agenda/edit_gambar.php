<button type="button" class="btn btn-primary-action btn-sm" data-toggle="modal" data-target="#edit-<?= esc($gambar_agenda['id_gambar_agenda']) ?>" title="Edit">
  <i class="fas fa-edit"></i>
</button>
<a href="<?= base_url('admin/agenda/delete_gambar/'.$gambar_agenda['id_gambar_agenda'].'/'.$agenda['id_agenda']) ?>" class="btn btn-danger-action btn-sm delete-link" title="Hapus">
  <i class="fas fa-trash"></i>
</a>

<!-- Modal Edit -->
<div class="modal fade" id="edit-<?= esc($gambar_agenda['id_gambar_agenda']) ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-edit" style="color:var(--amber);"></i> Edit Gambar</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open_multipart(base_url('admin/agenda/gambar/'.$agenda['id_agenda'])) ?>
      <input type="hidden" name="id_gambar_agenda" value="<?= esc($gambar_agenda['id_gambar_agenda']) ?>">
      <div class="modal-body" style="padding:1.5rem;">
        <?php if(!empty($gambar_agenda['gambar'])): ?>
        <div class="mb-3">
          <img src="<?= base_url('assets/upload/image/thumbs/'.$gambar_agenda['gambar']) ?>" style="width:120px;height:90px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);" alt="">
        </div>
        <?php endif; ?>
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Ganti Gambar</label>
            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
            <small style="font-size:var(--font-xs);color:var(--muted);">Kosongkan jika tidak ingin mengganti</small>
          </div>
          <div class="form-section">
            <label class="form-label">Nama Gambar</label>
            <input type="text" name="nama_gambar_agenda" class="form-control" value="<?= esc($gambar_agenda['nama_gambar_agenda']) ?>">
          </div>
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="2"><?= esc($gambar_agenda['keterangan']) ?></textarea>
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Urutan</label>
          <input type="number" name="urutan" class="form-control" value="<?= esc($gambar_agenda['urutan']) ?>" min="1">
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
