<div class="row">
	<div class="col-md-6">
		<?php echo form_open(base_url('admin/prestasi'), ' method="get"') ?>
		<div class="input-group">
          <input type="text" name="keywords" class="form-control" placeholder="Keywords..." value="<?php if(isset($_GET['keywords'])) { echo esc($_GET['keywords']); } ?>" required>
          <span class="input-group-append">
            <button type="submit" name="submit" value="Cari" class="btn btn-secondary btn-flat">
            	<i class="fa fa-search"></i> Cari
            </button>
            <a href="<?php echo base_url('admin/prestasi/tambah') ?>" class="btn btn-info">
				<i class="fa fa-plus"></i> Tambah Baru
			</a>
          </span>
        </div>
        <?php echo form_close() ?>
	</div>
	<div class="col-md-6">
			<?php if(isset($pagination)) { echo str_replace('index.php/','',$pagination); } ?>
	</div>
</div>
<hr>

<?php echo form_open(base_url('admin/prestasi/proses')) ?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php','',CURRENT_URL()) ?>">
<div class="mailbox-controls">
<div class="input-group">
	<button type="submit" name="submit" value="Delete" class="btn btn-secondary" title="Hapus Berita">
		<i class="fa fa-trash"></i>
	</button>
	<button type="submit" name="submit" value="Draft" class="btn btn-dark" title="Jangan Publikasikan">
		<i class="fa fa-eye-slash"></i>
	</button>
	<button type="submit" name="submit" value="Publish" class="btn btn-info" title="Publikasikan">
		<i class="fa fa-eye"></i>
	</button>
	<select name="id_kategori_prestasi" class="form-control">
		<?php foreach($kategori_prestasi as $kategori_prestasi) { ?>
		<option value="<?php echo esc($kategori_prestasi->id_kategori_prestasi) ?>">
			<?php echo esc($kategori_prestasi->nama_kategori_prestasi) ?>
		</option>
		<?php } ?>
	</select>
	<span class="input-group-append">
		<button type="submit" name="submit" value="Update" class="btn btn-warning">
			<i class="fa fa-search"></i> Update
		</button>
	</span>
</div>

<div class="table-responsive mailbox-messages mt-1">		

<table class="tabelku table-sm" id="example2">
	<thead>
		<tr class="text-left bg-light">
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle">
					<i class="far fa-square"></i>
        		</button>
			</th>
			<th width="5%">Gambar</th>
			<th width="35%">Judul</th>
			<th width="15%">Kategori &amp; Jenis</th>
			<th width="15%">Status</th>
			<th width="15%">Author</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($prestasi as $prestasi) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
					<input type="checkbox" name="id_prestasi[]" value="<?php echo esc($prestasi->id_prestasi) ?>" id="check_<?php echo esc($no) ?>">
					<label for="check_<?php echo esc($no) ?>"></label>
				</div>
				<?php echo esc($no) ?>
			</td>
			<td>
				<?php if($prestasi->gambar=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$prestasi->gambar) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><?php echo esc($prestasi->judul_prestasi) ?>
				<small>
					<br><i class="fa fa-graduation-cap"></i> <?php echo esc($prestasi->nama_penerima) ?>
					<br><i class="fa fa-calendar"></i> <?php echo esc($prestasi->tahun_prestasi) ?> (<?php echo esc($this->website->tanggal_bulan($prestasi->tanggal_prestasi)) ?>)
				
				</small>
			</td>
			<td><small><i class="fa fa-tags"></i> <?php echo esc($prestasi->nama_kategori_prestasi) ?>
				<br><i class="fa fa-home"></i> <?php echo esc($prestasi->jenjang_prestasi) ?></small></td>
			<td>
				<?php if($prestasi->status_prestasi=='Publish') { ?>
					<span class="badge bg-info">
						<i class="fa fa-eye"></i> <?php echo esc($prestasi->status_prestasi) ?>
					</span>
				<?php }else{ ?>
					<span class="badge bg-secondary">
						<i class="fa fa-eye-slash"></i> Not Published
					</span>
				<?php } ?>
			</td>
			<td><?php echo esc($prestasi->nama) ?></td>
			<td>
				
				<a href="<?php echo base_url('admin/prestasi/edit/'.$prestasi->id_prestasi) ?>" class="btn btn-secondary btn-xs mb-1"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/prestasi/delete/'.$prestasi->id_prestasi) ?>" class="btn btn-secondary btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>