<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-money"></i> Detail Tagihan</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-sm">
            <tr>
                <th width="20%">Nama Siswa</th>
                <td><?php echo esc($tagihan->nama_siswa) ?> (NIS: <?php echo esc($tagihan->nis) ?>)</td>
            </tr>
            <tr>
                <th>Kelas / Jenjang</th>
                <td><?php echo esc($tagihan->nama_kelas) ?> — <?php echo esc($tagihan->nama_jenjang) ?></td>
            </tr>
            <tr>
                <th>Biaya</th>
                <td><?php echo esc($tagihan->nama_biaya) ?></td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>
                    <?php
                    $nama_bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    echo $nama_bulan[$tagihan->bulan] . ' ' . esc($tagihan->tahun);
                    ?>
                </td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td><strong>Rp <?php echo number_format($tagihan->nominal_tagihan, 0, ',', '.') ?></strong></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php if ($tagihan->status == 'Lunas') { ?>
                        <span class="badge badge-success">Lunas</span>
                        — Dibayar: <?php echo esc($tagihan->tanggal_bayar) ?>
                        — Oleh: <?php echo esc($tagihan->admin_verifikasi) ?>
                    <?php } else { ?>
                        <span class="badge badge-danger">Belum Bayar</span>
                    <?php } ?>
                </td>
            </tr>
            <?php if ($tagihan->bukti_bayar) { ?>
            <tr>
                <th>Bukti Bayar</th>
                <td>
                    <a href="<?php echo base_url('assets/upload/bukti_bayar/' . $tagihan->bukti_bayar) ?>" target="_blank">
                        <i class="fa fa-file-image"></i> Lihat Bukti
                    </a>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <th>Keterangan</th>
                <td><?php echo esc($tagihan->keterangan ?? '-') ?></td>
            </tr>
        </table>
    </div>
</div>

<?php if ($tagihan->status == 'Belum') { ?>
<?php echo form_open_multipart(base_url('admin/tagihan/bayar/' . $tagihan->id_tagihan)); ?>
<?php echo csrf_field(); ?>
<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-check"></i> Verifikasi Pembayaran</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-3">Metode Bayar</label>
            <div class="col-5">
                <select name="metode_bayar" class="form-control" required>
                    <option value="">Pilih Metode</option>
                    <option value="Cash">Cash (Tunai)</option>
                    <option value="Transfer">Transfer Bank</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3">Bukti Bayar</label>
            <div class="col-5">
                <input type="file" name="bukti_bayar" class="form-control"
                       accept=".jpg,.jpeg,.png,.gif,.webp,.pdf">
                <small class="text-muted">Format: JPG, PNG, GIF, WebP, PDF (maks 5MB)</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3">Keterangan</label>
            <div class="col-5">
                <textarea name="keterangan" class="form-control" rows="2"></textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo base_url('admin/tagihan') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-success float-right"><i class="fa fa-check"></i> Verifikasi Bayar</button>
    </div>
</div>
<?php echo form_close(); ?>
<?php } else { ?>
<a href="<?php echo base_url('admin/tagihan') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar Tagihan</a>
<?php } ?>

<!-- Log -->
<?php if (count($logs) > 0) { ?>
<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-history"></i> Riwayat</h3>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Aksi</th>
                    <th>Admin</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log) { ?>
                <tr>
                    <td><?php echo esc($log['tanggal']) ?></td>
                    <td><?php echo esc($log['aksi']) ?></td>
                    <td><?php echo esc($log['admin']) ?></td>
                    <td><?php echo esc($log['keterangan']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>
