<button type="button" class="btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
            <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
                <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-plus-circle" style="color:var(--green);"></i> Tambah Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <?php echo form_open(base_url('admin/tahun')); ?>
            <div class="modal-body" style="padding:1.5rem;">
                <div class="form-section">
                    <label class="form-label">Nama Tahun <span class="text-danger">*</span></label>
                    <input type="text" name="nama_tahun" class="form-control" value="<?= set_value('nama_tahun') ?>" required placeholder="Contoh: 2025/2026">
                </div>
                <div class="form-section mt-3">
                    <label class="form-label">Tahun Mulai <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_mulai" class="form-control" value="<?= set_value('tahun_mulai') ?>" required placeholder="2025" min="2000" max="2099">
                </div>
                <div class="form-section mt-3">
                    <label class="form-label">Tahun Selesai <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_selesai" class="form-control" value="<?= set_value('tahun_selesai') ?>" required placeholder="2026" min="2000" max="2099">
                </div>
                <div class="form-section mt-3">
                    <label class="form-label">Keterangan <span class="text-danger">*</span></label>
                    <textarea name="keterangan" class="form-control" rows="3" required placeholder="Deskripsi tahun ajaran"><?= set_value('keterangan') ?></textarea>
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
