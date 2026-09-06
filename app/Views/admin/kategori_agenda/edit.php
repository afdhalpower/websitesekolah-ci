<div class="page-header-modern mb-4">
    <h4><i class="fa fa-edit"></i> Edit Kategori Agenda</h4>
    <a href="<?= base_url('admin/kategori_agenda') ?>" class="btn-secondary-action">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<?php echo form_open(base_url('admin/kategori_agenda/edit/'.$kategori_agenda['id_kategori_agenda'])); ?>
<?php echo csrf_field(); ?>

<div class="card-modern">
    <div class="form-section">
        <div class="form-grid">
            <div class="form-group">
                <label for="nama_kategori_agenda">Nama Kategori Agenda</label>
                <input type="text" name="nama_kategori_agenda" id="nama_kategori_agenda" class="form-control" placeholder="Nama kategori agenda" value="<?= esc($kategori_agenda['nama_kategori_agenda']) ?>" required>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Nomor urut" value="<?= esc($kategori_agenda['urutan']) ?>" required>
            </div>
        </div>
    </div>
    <div class="form-actions mt-3">
        <a href="<?= base_url('admin/kategori_agenda') ?>" class="btn-secondary-action">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn-success-action"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div>

<?php echo form_close(); ?>