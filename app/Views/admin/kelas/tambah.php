<button type="button" class="btn-primary-action mb-3" data-toggle="modal" data-target="#modal-tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<?php echo form_open(base_url('admin/kelas')); ?>
<?php echo csrf_field(); ?>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-section">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="id_jenjang">Jenjang</label>
                            <select name="id_jenjang" id="id_jenjang" class="form-control select2" required>
                                <option value="">Pilih Jenjang</option>
                                <?php foreach($jenjang as $j) { ?>
                                    <option value="<?= esc($j->id_jenjang) ?>"><?= esc($j->nama_jenjang) ?> - <?= esc($j->keterangan) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_kelas">Status</label>
                            <select name="status_kelas" id="status_kelas" class="form-control select2" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Nama kelas" value="<?= set_value('nama_kelas') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Urutan" value="<?= set_value('urutan') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Lengkap</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan Lengkap" rows="3"><?= set_value('keterangan') ?></textarea>
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