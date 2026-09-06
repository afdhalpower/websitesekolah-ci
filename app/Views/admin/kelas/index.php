<?php include('tambah.php'); ?>

<div class="page-header-modern mb-4">
    <h4><i class="fa fa-tags"></i> Kelas</h4>
</div>

<div class="card-modern">
    <div class="table-responsive">
        <table class="table-modern" id="example3">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Kelas</th>
                    <th>Keterangan</th>
                    <th width="10%">Status</th>
                    <th width="8%">Urutan</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($kelas as $row) { 
                    $kelasnya = $m_kelas->jenjang($row->id_jenjang);
                ?>
                <tr class="bg-light" id="jenjang<?= esc($row->id_jenjang) ?>">
                    <td colspan="6"><strong><i class="fa fa-graduation-cap"></i> <?= esc($row->nama_jenjang) ?> (<?= esc($row->keterangan_jenjang) ?>)</strong></td>
                </tr>

                <?php if($kelasnya) { $i=1; foreach($kelasnya as $item) { ?>
                <tr>
                    <td class="text-center"><?= esc($i) ?></td>
                    <td><?= esc($item->nama_kelas) ?></td>
                    <td><?= esc($item->keterangan) ?></td>
                    <td>
                        <?php if($item->status_kelas == 'Aktif') { ?>
                            <span class="badge badge-success"><?= esc($item->status_kelas) ?></span>
                        <?php } else { ?>
                            <span class="badge badge-secondary"><?= esc($item->status_kelas) ?></span>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?= esc($item->urutan) ?></td>
                    <td>
                        <a href="<?= base_url('admin/kelas/edit/'.$item->id_kelas) ?>" class="btn-secondary-action"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/kelas/delete/'.$item->id_kelas) ?>" class="btn-danger-action delete-link"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $i++; }} $no++; } ?>
            </tbody>
        </table>
    </div>
</div>