<button type="button" class="btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<?php echo form_open(base_url('admin/kategori_jurusan')); ?>
<?php echo csrf_field(); ?>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-section">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama_kategori_jurusan">Nama Kategori Jurusan</label>
                            <input type="text" name="nama_kategori_jurusan" id="nama_kategori_jurusan" class="form-control" placeholder="Nama kategori jurusan" value="<?= set_value('nama_kategori_jurusan') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Nomor urut" value="<?= set_value('urutan') ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-action" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn-success-action"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>