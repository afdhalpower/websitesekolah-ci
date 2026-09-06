<?php $uri = service('uri'); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Data Siswa</h5>
        <p class="page-subtitle">Manajemen data siswa sekolah</p>
    </div>
    <div>
        <a href="<?= base_url('admin/siswa/import') ?>" class="btn-secondary-action"><i class="fas fa-file-excel"></i> Import</a>
        <a href="<?= base_url('admin/siswa/tambah') ?>" class="btn-success-action"><i class="fas fa-plus"></i> Tambah Siswa</a>
    </div>
</div>

<?php echo form_open(base_url('admin/siswa'), 'method="get"'); ?>
<div style="display:flex;gap:8px;margin-bottom:1rem;flex-wrap:wrap;align-items:center;">
    <input type="text" name="keywords" class="form-control" placeholder="Cari nama, NIS, NISN..." value="<?= isset($_GET['keywords']) ? esc($_GET['keywords']) : '' ?>" style="max-width:350px;">
    <button type="submit" class="btn-primary-action"><i class="fas fa-search"></i></button>
    <?php if(isset($pagination)) { echo '<div style="margin-left:auto;">'.str_replace('index.php/','',$pagination).'</div>'; } ?>
</div>
<?php echo form_close(); ?>

<?php echo form_open(base_url('admin/siswa/proses'), array('id' => 'form-hapus-data')); ?>
<input type="hidden" name="pengalihan" value="<?= str_replace('index.php/','',CURRENT_URL()) ?>">

<div style="display:flex;gap:6px;margin-bottom:0.75rem;flex-wrap:wrap;align-items:center;">
    <button type="submit" class="btn-danger-action" name="submit" value="delete" title="Hapus Terpilih"><i class="fas fa-trash"></i></button>
    <select name="status_siswa" class="form-control" style="max-width:150px;font-size:0.85rem;">
        <option value="Aktif">Aktif</option>
        <option value="Lulus">Lulus</option>
        <option value="Meninggal">Meninggal</option>
        <option value="Pindah">Pindah</option>
    </select>
    <button type="submit" class="btn-primary-action" name="submit" value="update"><i class="fas fa-save"></i> Update Status</button>
    <?php if(isset($_GET['page']) || isset($_GET['keywords'])) { ?>
        <a href="<?= base_url('admin/siswa') ?>" class="btn-secondary-action"><i class="fas fa-arrow-circle-left"></i> Reset</a>
    <?php } ?>
</div>

<div class="card-modern">
    <div class="card-modern-body" style="padding:0;">
        <div class="table-responsive">
            <table class="table-modern" id="example3">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;"><input type="checkbox" class="checkbox-toggle" id="checkAll"></th>
                        <th width="10%">NIS/NISN</th>
                        <th width="20%">Nama</th>
                        <th width="15%">Alamat</th>
                        <th width="10%">Tgl Masuk</th>
                        <th width="5%">L/P</th>
                        <th width="10%">Wali</th>
                        <th width="8%">Status</th>
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($siswa as $s) { ?>
                    <tr>
                        <td style="text-align:center;">
                            <input type="checkbox" name="id_siswa[]" value="<?= esc($s->id_siswa) ?>" id="check<?= $i ?>">
                            <?= $i ?>
                        </td>
                        <td>
                            <span class="status-badge" style="background:rgba(59,130,246,0.1);color:#2563eb;font-size:0.7rem;"><?= esc($s->nis) ?></span>
                            <span class="status-badge" style="background:rgba(34,197,94,0.1);color:#16a34a;font-size:0.7rem;"><?= esc($s->nisn) ?></span>
                        </td>
                        <td>
                            <strong><?= esc($s->nama_siswa) ?></strong>
                            <br><small style="color:var(--gray);">
                                <?= esc($s->tempat_lahir) ?>, <?= esc($this->website->tanggal_id($s->tanggal_lahir)) ?>
                                <?php
                                $diff = abs(strtotime(date('Y-m-d')) - strtotime($s->tanggal_lahir));
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                ?>
                                &bull; <?= $years ?> thn <?= $months ?> bln
                            </small>
                        </td>
                        <td><small><?= esc($s->alamat) ?></small></td>
                        <td style="text-align:center;"><small><?= esc($this->website->tanggal_id($s->tanggal_masuk)) ?></small></td>
                        <td style="text-align:center;"><?= esc($s->jenis_kelamin) ?></td>
                        <td><small><?= esc($s->nama_wali) ?></small></td>
                        <td style="text-align:center;">
                            <?php
                            $statusColors = ['Aktif'=>'rgba(34,197,94,0.1);#16a34a','Lulus'=>'rgba(59,130,246,0.1);#2563eb','Meninggal'=>'rgba(107,114,128,0.1);#374151','Pindah'=>'rgba(234,179,8,0.1);#ca8a04'];
                            $icons = ['Aktif'=>'fa-check-circle','Lulus'=>'fa-certificate','Meninggal'=>'fa-times-circle','Pindah'=>'fa-plane'];
                            $color = $statusColors[$s->status_siswa] ?? 'rgba(107,114,128,0.1);#6b7280';
                            $parts = explode(';', $color);
                            ?>
                            <span class="status-badge" style="background:<?= $parts[0] ?>;color:<?= $parts[1] ?>;"><i class="fas <?= $icons[$s->status_siswa] ?? 'fa-circle' ?>"></i> <?= esc($s->status_siswa) ?></span>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/siswa/detail/'.$s->id_siswa) ?>" class="btn-primary-action" style="padding:3px 7px;font-size:0.7rem;" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="<?= base_url('admin/siswa/cetak/'.$s->id_siswa) ?>" class="btn-secondary-action" style="padding:3px 7px;font-size:0.7rem;" target="_blank" title="Cetak"><i class="fas fa-print"></i></a>
                            <a href="<?= base_url('admin/siswa/edit/'.$s->id_siswa) ?>" class="btn-success-action" style="padding:3px 7px;font-size:0.7rem;" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('admin/siswa/delete/'.$s->id_siswa) ?>" class="btn-danger-action" style="padding:3px 7px;font-size:0.7rem;" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<script>
$(document).ready(function(){
    $("#checkAll").click(function(){ $("input[name='id_siswa[]']").prop("checked", this.checked); });
});
</script>
