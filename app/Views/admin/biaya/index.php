<?php include('tambah.php'); ?>
<?php if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning"><?php echo $this->session->flashdata('warning') ?></div>
<?php } ?>
<table class="table table-bordered table-sm" id="example3">
    <thead>
        <tr class="bg-secondary text-center">
            <th width="5%">No</th>
            <th width="20%">Nama Biaya</th>
            <th width="15%">Jenjang</th>
            <th width="15%">Nominal</th>
            <th width="10%">Periode</th>
            <th width="8%">Tahun</th>
            <th width="10%">Status</th>
            <th width="17%"></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($biaya as $b) { ?>
        <tr>
            <td class="text-center"><?php echo esc($no++) ?></td>
            <td><?php echo esc($b['nama_biaya']) ?></td>
            <td><?php echo esc($b['nama_jenjang']) ?></td>
            <td class="text-right">Rp <?php echo number_format($b['nominal'], 0, ',', '.') ?></td>
            <td class="text-center"><?php echo esc($b['periode']) ?></td>
            <td class="text-center"><?php echo esc($b['tahun_mulai']) ?><?php if ($b['tahun_selesai']) echo ' - ' . esc($b['tahun_selesai']) ?></td>
            <td class="text-center">
                <?php if ($b['status'] == 'Aktif') { ?>
                    <span class="badge badge-success">Aktif</span>
                <?php } else { ?>
                    <span class="badge badge-danger">Non Aktif</span>
                <?php } ?>
            </td>
            <td class="text-center">
                <a href="<?php echo base_url('admin/biaya/edit/' . $b['id_biaya']) ?>" class="btn btn-secondary btn-xs mb-1"><i class="fa fa-edit"></i></a>
                <a href="<?php echo base_url('admin/biaya/delete/' . $b['id_biaya']) ?>" class="btn btn-secondary btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
