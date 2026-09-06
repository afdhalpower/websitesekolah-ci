<div class="page-header-modern">
    <div>
        <h5 class="page-title">Jenjang Pendidikan</h5>
        <p class="page-subtitle"><?= esc($title) ?></p>
    </div>
    <div>
        <a href="<?= base_url('admin/jenjang_pendidikan/tambah') ?>" class="btn-success-action">
            <i class="fas fa-plus"></i> Tambah Baru
        </a>
    </div>
</div>

<?php echo form_open(base_url('admin/jenjang_pendidikan'), 'method="get"'); ?>
<div style="display:flex;gap:8px;margin-bottom:1rem;flex-wrap:wrap;align-items:center;">
    <input type="text" name="keywords" class="form-control" placeholder="Cari jenjang pendidikan..." value="<?= isset($_GET['keywords']) ? esc($_GET['keywords']) : '' ?>" style="max-width:300px;">
    <button type="submit" class="btn-primary-action"><i class="fas fa-search"></i> Cari</button>
    <?php if(isset($pagination)) { echo '<div style="margin-left:auto;">'.str_replace('index.php/','',$pagination).'</div>'; } ?>
</div>
<?php echo form_close(); ?>

<?php echo form_open(base_url('admin/jenjang_pendidikan/proses')); ?>
<input type="hidden" name="pengalihan" value="<?= str_replace('index.php','',CURRENT_URL()) ?>">

<div style="display:flex;gap:6px;margin-bottom:0.75rem;flex-wrap:wrap;">
    <button type="submit" name="submit" value="Delete" class="btn-danger-action" title="Hapus Terpilih"><i class="fas fa-trash"></i></button>
    <button type="submit" name="submit" value="Draft" class="btn-secondary-action" title="Draft"><i class="fas fa-eye-slash"></i> Draft</button>
    <button type="submit" name="submit" value="Publish" class="btn-success-action" title="Publish"><i class="fas fa-eye"></i> Publish</button>
</div>

<div class="card-modern">
    <div class="card-modern-body" style="padding:0;">
        <div class="table-responsive">
            <table class="table-modern" id="example3">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;">
                            <input type="checkbox" class="checkbox-toggle" id="checkAll">
                        </th>
                        <th width="8%">Gambar</th>
                        <th width="35%">Nama Jenjang</th>
                        <th width="25%">Jenjang - Jenis - Penulis</th>
                        <th width="10%">Status</th>
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($jenjang_pendidikan as $jp) { ?>
                    <tr>
                        <td style="text-align:center;">
                            <input type="checkbox" name="id_jenjang_pendidikan[]" value="<?= esc($jp->id_jenjang_pendidikan) ?>" id="check_<?= $no ?>">
                            <?= $no ?>
                        </td>
                        <td>
                            <?php if($jp->gambar=="") { echo '<span style="color:var(--gray);">-</span>'; }else{ ?>
                                <img src="<?= base_url('assets/upload/image/thumbs/'.$jp->gambar) ?>" style="width:40px;height:40px;border-radius:8px;object-fit:cover;">
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/jenjang_pendidikan/edit/'.$jp->id_jenjang_pendidikan) ?>" style="font-weight:600;color:var(--dark);text-decoration:none;">
                                <?= esc($jp->judul_jenjang_pendidikan) ?>
                            </a>
                            <br><small style="color:var(--gray);">
                                <i class="fas fa-calendar-check"></i> <?= esc($this->website->tanggal_bulan_menit($jp->tanggal_publish)) ?>
                                &bull; <i class="fas fa-eye"></i> <?= esc($jp->hits) ?>
                                &bull; <i class="fas fa-sort-numeric-up"></i> <?= esc($jp->urutan) ?>
                            </small>
                        </td>
                        <td>
                            <small>
                                <a href="<?= base_url('admin/jenjang_pendidikan/jenjang/'.$jp->id_jenjang) ?>" style="color:var(--blue);"><?= esc($jp->nama_jenjang) ?></a>
                                <br><a href="<?= base_url('admin/jenjang_pendidikan/jenis_jenjang_pendidikan/'.$jp->jenis_jenjang_pendidikan) ?>" style="color:var(--amber);"><?= esc($jp->jenis_jenjang_pendidikan) ?></a>
                                <br><a href="<?= base_url('admin/jenjang_pendidikan/author/'.$jp->id_user) ?>" style="color:var(--gray);"><?= esc($jp->nama) ?></a>
                            </small>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/jenjang_pendidikan/status_jenjang_pendidikan/'.$jp->status_jenjang_pendidikan) ?>">
                                <?php if($jp->status_jenjang_pendidikan=='Publish') { ?>
                                    <span class="status-badge" style="background:rgba(34,197,94,0.1);color:#16a34a;"><i class="fas fa-check-circle"></i> Publish</span>
                                <?php }else{ ?>
                                    <span class="status-badge" style="background:rgba(107,114,128,0.1);color:#6b7280;"><i class="fas fa-eye-slash"></i> Draft</span>
                                <?php } ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url('jenjang_pendidikan/read/'.$jp->slug_jenjang_pendidikan) ?>" class="btn-secondary-action" style="padding:4px 8px;font-size:0.75rem;" target="_blank" title="Lihat"><i class="fas fa-eye"></i></a>
                            <a href="<?= base_url('admin/jenjang_pendidikan/edit/'.$jp->id_jenjang_pendidikan) ?>" class="btn-primary-action" style="padding:4px 8px;font-size:0.75rem;" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('admin/jenjang_pendidikan/delete/'.$jp->id_jenjang_pendidikan) ?>" class="btn-danger-action" style="padding:4px 8px;font-size:0.75rem;" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<script>
$(document).ready(function(){
    $("#checkAll").click(function(){ $("input[name='id_jenjang_pendidikan[]']").prop("checked", this.checked); });
});
</script>
