<div class="page-header-modern mb-4">
    <h4><i class="fa fa-edit"></i> Edit Kelas</h4>
    <a href="<?= base_url('admin/kelas') ?>" class="btn-secondary-action">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<?php echo form_open(base_url('admin/kelas/edit/'.$kelas->id_kelas)); ?>
<?php echo csrf_field(); ?>

<div class="card-modern">
    <div class="form-section">
        <div class="form-grid">
            <div class="form-group">
                <label for="id_jenjang">Jenjang</label>
                <select name="id_jenjang" id="id_jenjang" class="form-control select2" required>
                    <option value="">Pilih Jenjang</option>
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>" <?= ($kelas->id_jenjang == $j->id_jenjang) ? 'selected' : '' ?>><?= esc($j->nama_jenjang) ?> - <?= esc($j->keterangan) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status_kelas">Status</label>
                <select name="status_kelas" id="status_kelas" class="form-control select2" required>
                    <option value="Aktif" <?= ($kelas->status_kelas == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                    <option value="Non Aktif" <?= ($kelas->status_kelas == 'Non Aktif') ? 'selected' : '' ?>>Non Aktif</option>
                </select>
            </div>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Nama kelas" value="<?= esc($kelas->nama_kelas) ?>" required>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Urutan" value="<?= esc($kelas->urutan) ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan Lengkap</label>
            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan Lengkap" rows="3"><?= esc($kelas->keterangan) ?></textarea>
        </div>
    </div>
    <div class="form-actions mt-3">
        <a href="<?= base_url('admin/kelas') ?>" class="btn-secondary-action">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn-success-action"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div>

<?php echo form_close(); ?>