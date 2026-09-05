<!-- Pilih Siswa -->
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-search"></i> Pilih Siswa</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo base_url('admin/tagihan/rekap') ?>">
            <div class="row">
                <div class="col-md-8">
                    <select name="id_siswa" class="form-control select2" required>
                        <option value="">— Pilih Siswa —</option>
                        <?php foreach ($siswa_list as $s) { ?>
                            <option value="<?php echo esc($s['id_siswa']) ?>"
                                <?php if (($id_siswa ?? '') == $s['id_siswa']) echo 'selected' ?>>
                                <?php echo esc($s['nama_siswa']) ?> — <?php echo esc($s['nama_kelas']) ?> (<?php echo esc($s['nama_jenjang']) ?>)
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Lihat Rekap</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($tagihan) { ?>
<!-- Summary -->
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa fa-file-invoice"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Tagihan</span>
                <span class="info-box-number">Rp <?php echo number_format($summary->grand_total ?? 0, 0, ',', '.') ?></span>
                <span class="info-box-number"><small><?php echo esc($summary->total_tagihan ?? 0) ?> tagihan</small></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fa fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sudah Dibayar</span>
                <span class="info-box-number">Rp <?php echo number_format($summary->total_dibayar ?? 0, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fa fa-exclamation-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Belum Dibayar</span>
                <span class="info-box-number">Rp <?php echo number_format($summary->total_sisa ?? 0, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Rekap -->
<table class="table table-bordered table-sm" id="example3">
    <thead>
        <tr class="bg-secondary text-center">
            <th width="5%">No</th>
            <th>Biaya</th>
            <th>Periode</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Tanggal Bayar</th>
            <th>Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($tagihan as $t) { ?>
        <tr>
            <td class="text-center"><?php echo esc($no++) ?></td>
            <td><?php echo esc($t['nama_biaya']) ?></td>
            <td class="text-center">
                <?php
                $nama_bulan = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                echo $nama_bulan[$t['bulan']] . ' ' . esc($t['tahun']);
                ?>
            </td>
            <td class="text-right">Rp <?php echo number_format($t['nominal_tagihan'], 0, ',', '.') ?></td>
            <td class="text-center">
                <?php if ($t['status'] == 'Lunas') { ?>
                    <span class="badge badge-success">Lunas</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Belum</span>
                <?php } ?>
            </td>
            <td class="text-center"><?php echo esc($t['tanggal_bayar'] ?? '-') ?></td>
            <td><?php echo esc($t['admin_verifikasi'] ?? '-') ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>
