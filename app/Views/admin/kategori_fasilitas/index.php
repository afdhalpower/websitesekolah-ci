<?php include('tambah.php'); ?>

<div class="page-header-modern mb-4">
    <h4><i class="fa fa-tags"></i> Kategori Fasilitas</h4>
</div>

<div class="card-modern">
    <div class="table-responsive">
        <table class="table-modern" id="example3">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th width="10%">Urutan</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($kategori_fasilitas as $row) { ?>
                <tr>
                    <td class="text-center"><?= esc($no) ?></td>
                    <td><?= esc($row->nama_kategori_fasilitas) ?></td>
                    <td class="text-center"><?= esc($row->urutan) ?></td>
                    <td>
                        <a href="<?= base_url('admin/kategori_fasilitas/edit/'.$row->id_kategori_fasilitas) ?>" class="btn-secondary-action"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/kategori_fasilitas/delete/'.$row->id_kategori_fasilitas) ?>" class="btn-danger-action delete-link"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>