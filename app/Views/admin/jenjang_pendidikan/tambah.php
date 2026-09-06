<?php echo form_open_multipart(base_url('admin/jenjang_pendidikan/tambah')); ?>
<?php echo csrf_field(); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Tambah Jenjang Pendidikan</h5>
        <p class="page-subtitle">Isi data jenjang pendidikan baru</p>
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
                <input type="text" name="judul_jenjang_pendidikan" class="form-control" value="<?= set_value('judul_jenjang_pendidikan') ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Upload Gambar</label>
                <div class="upload-zone" onclick="this.querySelector('input[type=file]').click();" style="cursor:pointer;text-align:center;padding:15px;">
                    <input type="file" name="gambar" style="display:none;" onchange="this.closest('.upload-zone').querySelector('.upload-text').textContent=this.files[0]?.name||'Pilih file...';">
                    <i class="fas fa-cloud-upload-alt" style="font-size:1.5rem;color:var(--gray);"></i>
                    <p class="upload-text" style="margin:4px 0 0;color:var(--gray);font-size:0.8rem;">Pilih gambar</p>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Jenjang Pendidikan</label>
                <select name="id_jenjang" class="form-control">
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>"><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Jenis Konten</label>
                <select name="jenis_jenjang_pendidikan" class="form-control">
                    <option value="Jenjang">Jenjang Pendidikan</option>
                    <option value="Yayasan">Informasi Yayasan</option>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Status Publikasi</label>
                <select name="status_jenjang_pendidikan" class="form-control">
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Icon (Font Awesome)</label>
                <input type="text" name="icon" class="form-control" value="<?= set_value('icon') ?>" placeholder="fas fa-graduation-cap">
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Publish</label>
                <input type="text" name="tanggal_publish" class="form-control tanggal" value="<?= date('d-m-Y') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Jam Publish</label>
                <input type="text" name="jam" class="form-control jam" value="<?= date('H:i:s') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Urutan</label>
                <input type="number" name="urutan" class="form-control" value="0">
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
                <textarea name="ringkasan" class="form-control" rows="3"><?= set_value('ringkasan') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Isi Jenjang Pendidikan <span style="color:var(--red);">*</span></label>
                <div style="margin-bottom:6px;">
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-media"><i class="fas fa-plus-circle"></i> Media</button>
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-galeri"><i class="fas fa-image"></i> Galeri</button>
                    <button type="button" class="btn-secondary-action" style="font-size:0.75rem;padding:4px 10px;" data-toggle="modal" data-target="#modal-download"><i class="fas fa-download"></i> File</button>
                </div>
                <textarea name="isi" class="form-control konten" rows="6"><?= set_value('isi') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Keywords (SEO)</label>
                <textarea name="keywords" class="form-control" rows="2"><?= set_value('keywords') ?></textarea>
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
