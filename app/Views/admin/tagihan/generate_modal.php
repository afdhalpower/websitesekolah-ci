<!-- Button Generate + Link Rekap -->
<div class="mb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-generate">
        <i class="fa fa-cogs"></i> Generate Tagihan
    </button>
    <a href="<?php echo base_url('admin/tagihan/rekap') ?>" class="btn btn-info">
        <i class="fa fa-file-invoice-dollar"></i> Rekap Per Siswa
    </a>
</div>

<?php echo form_open(base_url('admin/tagihan/generate')); ?>
<?php echo csrf_field(); ?>
<div class="modal fade" id="modal-generate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Generate Tagihan Bulanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <select name="id_tahun" class="form-control select2" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php foreach ($tahun as $t) { ?>
                            <option value="<?php echo esc($t->id_tahun) ?>">
                                <?php echo esc($t->nama_tahun) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control" required>
                        <option value="">Pilih Bulan</option>
                        <?php
                        $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ($i == (int)date('m')) ? 'selected' : '';
                            echo "<option value='{$i}' {$selected}>{$nama_bulan[$i-1]}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required
                           value="<?php echo date('Y') ?>" min="2020" max="2050">
                </div>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Tagihan akan digenerate untuk semua siswa aktif. Siswa yang sudah memiliki tagihan bulan ini akan dilewati.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-cogs"></i> Generate</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
