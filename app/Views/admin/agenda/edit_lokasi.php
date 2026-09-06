<button type="button" class="btn btn-primary-action btn-sm" data-toggle="modal" data-target="#edit-lokasi-<?= esc($lokasi_agenda['id_lokasi_agenda']) ?>" title="Edit">
  <i class="fas fa-edit"></i>
</button>

<!-- Modal Edit -->
<div class="modal fade" id="edit-lokasi-<?= esc($lokasi_agenda['id_lokasi_agenda']) ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-edit" style="color:var(--amber);"></i> Edit Lokasi</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open(base_url('admin/agenda/lokasi/'.$agenda['id_agenda'])) ?>
      <input type="hidden" name="id_lokasi_agenda" value="<?= esc($lokasi_agenda['id_lokasi_agenda']) ?>">
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-section">
          <label class="form-label">Nama Desa <span class="text-danger">*</span></label>
          <select name="id_desa" class="form-select" required>
            <option value="">— Pilih Lokasi —</option>
            <?php foreach($desa as $d): ?>
            <option value="<?= esc($d['id_desa']) ?>" <?= ($d['id_desa'] == $lokasi_agenda['id_desa']) ? 'selected' : '' ?>>
              <?= esc($d['nama_desa']) ?>
            </option>
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
