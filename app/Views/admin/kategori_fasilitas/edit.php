<div class="page-header-modern mb-4">
    <h4><i class="fa fa-edit"></i> Edit Kategori Fasilitas</h4>
    <a href="<?= base_url('admin/kategori_fasilitas') ?>" class="btn-secondary-action">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<?php echo form_open(base_url('admin/kategori_fasilitas/edit/'.$kategori_fasilitas->id_kategori_fasilitas)); ?>
<?php echo csrf_field(); ?>

<div class="card-modern">
    <div class="form-section">
        <div class="form-grid">
            <div class="form-group">
                <label for="nama_kategori_fasilitas">Nama Kategori Fasilitas</label>
                <input type="text" name="nama_kategori_fasilitas" id="nama_kategori_fasilitas" class="form-control" placeholder="Nama kategori fasilitas" value="<?= esc($kategori_fasilitas->nama_kategori_fasilitas) ?>" required>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Nomor urut" value="<?= esc($kategori_fasilitas->urutan) ?>" required>
            </div>
        </div>
    </div>
    <div class="form-actions mt-3">
        <a href="<?= base_url('admin/kategori_fasilitas') ?>" class="btn-secondary-action">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn-success-action"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div>

<?php echo form_close(); ?>