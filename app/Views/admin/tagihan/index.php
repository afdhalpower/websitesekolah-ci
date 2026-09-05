<?php include('generate_modal.php'); ?>
<?php if ($this->session->flashdata('sukses')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('sukses') ?></div>
<?php } ?>
<?php if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning"><?php echo $this->session->flashdata('warning') ?></div>
<?php } ?>

<!-- Filter -->
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-filter"></i> Filter</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo base_url('admin/tagihan') ?>">
            <div class="row">
                <div class="col-md-2">
                    <select name="status" class="form-control form-control-sm">
                        <option value="">Semua Status</option>
                        <option value="Belum" <?php if (($filters['status'] ?? '') == 'Belum') echo 'selected' ?>>Belum Bayar</option>
                        <option value="Lunas" <?php if (($filters['status'] ?? '') == 'Lunas') echo 'selected' ?>>Lunas</option>
                        <option value="Dibatalkan" <?php if (($filters['status'] ?? '') == 'Dibatalkan') echo 'selected' ?>>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="id_kelas" class="form-control form-control-sm">
                        <option value="">Semua Kelas</option>
                        <?php foreach ($kelas as $k) { ?>
                            <option value="<?php echo esc($k->id_kelas) ?>" <?php if (($filters['id_kelas'] ?? '') == $k->id_kelas) echo 'selected' ?>>
                                <?php echo esc($k->nama_kelas) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="bulan" class="form-control form-control-sm">
                        <option value="">Semua Bulan</option>
                        <?php
                        $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        for ($i = 1; $i <= 12; $i++) {
                        ?>
                            <option value="<?php echo $i ?>" <?php if (($filters['bulan'] ?? '') == $i) echo 'selected' ?>><?php echo $nama_bulan[$i-1] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun" class="form-control form-control-sm">
                        <option value="">Semua Tahun</option>
                        <?php for ($y = date('Y'); $y >= 2020; $y--) { ?>
                            <option value="<?php echo $y ?>" <?php if (($filters['tahun'] ?? '') == $y) echo 'selected' ?>><?php echo $y ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Filter</button>
                    <a href="<?php echo base_url('admin/tagihan') ?>" class="btn btn-default btn-sm">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<table class="table table-bordered table-sm" id="example3">
    <thead>
        <tr class="bg-secondary text-center">
            <th width="5%">No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Biaya</th>
            <th>Bulan/Tahun</th>
            <th>Nominal</th>
            <th>Status</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($tagihan as $t) { ?>
        <tr>
            <td class="text-center"><?php echo esc($no++) ?></td>
            <td><?php echo esc($t['nama_siswa']) ?></td>
            <td><?php echo esc($t['nama_kelas']) ?></td>
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
                <?php } elseif ($t['status'] == 'Dibatalkan') { ?>
                    <span class="badge badge-secondary">Dibatalkan</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Belum</span>
                <?php } ?>
            </td>
            <td class="text-center">
                <?php if ($t['status'] == 'Belum') { ?>
                    <a href="<?php echo base_url('admin/tagihan/bayar/' . $t['id_tagihan']) ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-money"></i> Bayar
                    </a>
                <?php } else { ?>
                    <a href="<?php echo base_url('admin/tagihan/bayar/' . $t['id_tagihan']) ?>" class="btn btn-secondary btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
