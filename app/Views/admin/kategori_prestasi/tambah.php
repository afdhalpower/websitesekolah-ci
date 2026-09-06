<button type="button" class="btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
            <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
                <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-plus-circle" style="color:var(--green);"></i> Tambah Kategori Prestasi</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <?php echo form_open(base_url('admin/kategori_prestasi')); ?>
            <div class="modal-body" style="padding:1.5rem;">
                <div class="form-section">
                    <label class="form-label">Nama Kategori Prestasi <span class="text-danger">*</span></label>
                    <input type="text" name="nama_kategori_prestasi" class="form-control" value="<?= set_value('nama_kategori_prestasi') ?>" required placeholder="Masukkan nama">
                </div>
                <div class="form-section mt-3">
                    <label class="form-label">Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="urutan" class="form-control" value="<?= set_value('urutan') ?>" required placeholder="0">
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--border);padding:0.75rem 1.5rem;">
                <button type="button" class="btn-secondary-action" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
