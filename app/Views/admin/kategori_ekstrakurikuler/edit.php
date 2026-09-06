<div class="page-header-modern mb-4">
    <h4><i class="fa fa-edit"></i> Edit Kategori Ekstrakurikuler</h4>
    <a href="<?= base_url('admin/kategori_ekstrakurikuler') ?>" class="btn-secondary-action">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<?php echo form_open(base_url('admin/kategori_ekstrakurikuler/edit/'.$kategori_ekstrakurikuler->id_kategori_ekstrakurikuler)); ?>
<?php echo csrf_field(); ?>

<div class="card-modern">
    <div class="form-section">
        <div class="form-grid">
            <div class="form-group">
                <label for="nama_kategori_ekstrakurikuler">Nama Kategori Ekstrakurikuler</label>
                <input type="text" name="nama_kategori_ekstrakurikuler" id="nama_kategori_ekstrakurikuler" class="form-control" placeholder="Nama kategori ekstrakurikuler" value="<?= esc($kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler) ?>" required>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Nomor urut" value="<?= esc($kategori_ekstrakurikuler->urutan) ?>" required>
            </div>
        </div>
    </div>
    <div class="form-actions mt-3">
        <a href="<?= base_url('admin/kategori_ekstrakurikuler') ?>" class="btn-secondary-action">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn-success-action"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div>

<?php echo form_close(); ?>