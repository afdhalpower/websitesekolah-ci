<?php echo form_open_multipart(base_url('admin/jenjang_pendidikan/edit/'.$jenjang_pendidikan->id_jenjang_pendidikan)); ?>
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Edit: <?= esc($jenjang_pendidikan->judul_jenjang_pendidikan) ?></h5>
        <p class="page-subtitle">Edit data jenjang pendidikan</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-graduation-cap" style="color:var(--green);margin-right:6px;"></i> Data Jenjang Pendidikan</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Jenjang Pendidikan <span style="color:var(--red);">*</span></label>
                <input type="text" name="judul_jenjang_pendidikan" class="form-control" value="<?= esc($jenjang_pendidikan->judul_jenjang_pendidikan) ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Upload Gambar</label>
                <div class="upload-zone" onclick="this.querySelector('input[type=file]').click();" style="cursor:pointer;text-align:center;padding:15px;">
                    <input type="file" name="gambar" style="display:none;" onchange="this.closest('.upload-zone').querySelector('.upload-text').textContent=this.files[0]?.name||'Pilih file...';">
                    <i class="fas fa-cloud-upload-alt" style="font-size:1.5rem;color:var(--gray);"></i>
                    <p class="upload-text" style="margin:4px 0 0;color:var(--gray);font-size:0.8rem;">Ganti gambar</p>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Jenjang Pendidikan</label>
                <select name="id_jenjang" class="form-control">
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>" <?= $jenjang_pendidikan->id_jenjang==$j->id_jenjang ? 'selected' : '' ?>><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Jenis Konten</label>
                <select name="jenis_jenjang_pendidikan" class="form-control">
                    <option value="Jenjang" <?= $jenjang_pendidikan->jenis_jenjang_pendidikan=="Jenjang" ? 'selected' : '' ?>>Jenjang Pendidikan</option>
                    <option value="Yayasan" <?= $jenjang_pendidikan->jenis_jenjang_pendidikan=="Yayasan" ? 'selected' : '' ?>>Informasi Yayasan</option>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Status Publikasi</label>
                <select name="status_jenjang_pendidikan" class="form-control">
                    <option value="Publish" <?= $jenjang_pendidikan->status_jenjang_pendidikan=="Publish" ? 'selected' : '' ?>>Publish</option>
                    <option value="Draft" <?= $jenjang_pendidikan->status_jenjang_pendidikan=="Draft" ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Icon</label>
                <input type="text" name="icon" class="form-control" value="<?= esc($jenjang_pendidikan->icon) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Publish</label>
                <input type="text" name="tanggal_publish" class="form-control tanggal" value="<?= esc($this->website->tanggal_id($jenjang_pendidikan->tanggal_publish)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Jam Publish</label>
                <input type="text" name="jam" class="form-control jam" value="<?= date('H:i:s',strtotime($jenjang_pendidikan->tanggal_publish)) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Urutan</label>
                <input type="number" name="urutan" class="form-control" value="<?= esc($jenjang_pendidikan->urutan) ?>">
            </div>
        </div>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-file-alt" style="color:var(--blue);margin-right:6px;"></i> Konten & SEO</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Ringkasan</label>
                <textarea name="ringkasan" class="form-control" rows="3"><?= esc($jenjang_pendidikan->ringkasan) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Isi Jenjang Pendidikan</label>
                <div style="margin-bottom:6px;">
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-media"><i class="fas fa-plus-circle"></i> Media</button>
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-galeri"><i class="fas fa-image"></i> Galeri</button>
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-download"><i class="fas fa-download"></i> File</button>
                </div>
                <textarea name="isi" class="form-control konten" rows="6"><?= esc($jenjang_pendidikan->isi) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Keywords (SEO)</label>
                <textarea name="keywords" class="form-control" rows="2"><?= esc($jenjang_pendidikan->keywords) ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/jenjang_pendidikan') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="reset" class="btn-secondary-action"><i class="fas fa-undo"></i> Reset</button>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close();
include('media.php');
include('galeri.php');
include('download.php');
?>
