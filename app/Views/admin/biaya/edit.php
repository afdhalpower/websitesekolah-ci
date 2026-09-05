<?php echo form_open(base_url('admin/biaya/edit/' . $biaya->id_biaya)); ?>
<?php echo csrf_field(); ?>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-edit"></i> Edit Biaya</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-4">Jenjang</label>
            <div class="col-8">
                <select name="id_jenjang" class="form-control select2" required>
                    <?php foreach ($jenjang as $j) { ?>
                        <option value="<?php echo esc($j->id_jenjang) ?>"
                            <?php if ($j->id_jenjang == $biaya->id_jenjang) echo 'selected' ?>>
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
                       value="<?php echo esc($biaya->nama_biaya) ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Nominal (Rp)</label>
            <div class="col-8">
                <input type="number" name="nominal" class="form-control" required min="0"
                       value="<?php echo esc($biaya->nominal) ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Periode</label>
            <div class="col-8">
                <select name="periode" class="form-control" required>
                    <option value="Bulanan" <?php if ($biaya->periode == 'Bulanan') echo 'selected' ?>>Bulanan</option>
                    <option value="Tahunan" <?php if ($biaya->periode == 'Tahunan') echo 'selected' ?>>Tahunan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Tahun Mulai</label>
            <div class="col-8">
                <input type="number" name="tahun_mulai" class="form-control" required
                       value="<?php echo esc($biaya->tahun_mulai) ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Tahun Selesai</label>
            <div class="col-8">
                <input type="number" name="tahun_selesai" class="form-control"
                       value="<?php echo esc($biaya->tahun_selesai ?? '') ?>"
                       placeholder="Kosongkan jika masih aktif">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Status</label>
            <div class="col-8">
                <select name="status" class="form-control">
                    <option value="Aktif" <?php if ($biaya->status == 'Aktif') echo 'selected' ?>>Aktif</option>
                    <option value="Non Aktif" <?php if ($biaya->status == 'Non Aktif') echo 'selected' ?>>Non Aktif</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo base_url('admin/biaya') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div>
<?php echo form_close(); ?>
