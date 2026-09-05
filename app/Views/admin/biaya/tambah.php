<p>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
        <i class="fa fa-plus"></i> Tambah Baru
    </button>
</p>
<?php echo form_open(base_url('admin/biaya')); ?>
<?php echo csrf_field(); ?>
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Biaya Pendidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-4">Jenjang</label>
                    <div class="col-8">
                        <select name="id_jenjang" class="form-control select2" required>
                            <option value="">Pilih Jenjang</option>
                            <?php foreach ($jenjang as $j) { ?>
                                <option value="<?php echo esc($j->id_jenjang) ?>">
                                    <?php echo esc($j->nama_jenjang) ?> - <?php echo esc($j->keterangan) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Nama Biaya</label>
                    <div class="col-8">
                        <input type="text" name="nama_biaya" class="form-control" required
                               placeholder="Contoh: SPP Bulanan PAUD">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Nominal (Rp)</label>
                    <div class="col-8">
                        <input type="number" name="nominal" class="form-control" required min="0"
                               placeholder="500000">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Periode</label>
                    <div class="col-8">
                        <select name="periode" class="form-control" required>
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Tahun Mulai</label>
                    <div class="col-8">
                        <input type="number" name="tahun_mulai" class="form-control" required
                               value="<?php echo date('Y') ?>" min="2020" max="2050">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Tahun Selesai</label>
                    <div class="col-8">
                        <input type="number" name="tahun_selesai" class="form-control"
                               placeholder="Kosongkan jika masih aktif" min="2020" max="2050">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">Status</label>
                    <div class="col-8">
                        <select name="status" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
