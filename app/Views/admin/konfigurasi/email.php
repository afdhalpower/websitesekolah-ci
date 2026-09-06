<?php echo form_open(base_url('admin/konfigurasi/email')); ?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Pengaturan Email (SMTP)</h5>
        <p class="page-subtitle">Konfigurasi server email untuk pengiriman notifikasi</p>
    </div>
</div>

<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-envelope" style="color:var(--blue);margin-right:6px;"></i> Konfigurasi SMTP</h6>
    </div>
    <div class="card-modern-body">
        <input type="hidden" name="id_konfigurasi" value="<?= esc($site->id_konfigurasi) ?>">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Protocol</label>
                <input type="text" name="protocol" placeholder="smtp" value="<?= esc($site->protocol) ?>" class="form-control">
            </div>
            <div class="form-section">
                <label class="form-label">Host</label>
                <input type="text" name="smtp_host" placeholder="smtp.gmail.com" value="<?= esc($site->smtp_host) ?>" class="form-control">
            </div>
            <div class="form-section">
                <label class="form-label">Port</label>
                <input type="text" name="smtp_port" placeholder="587" value="<?= esc($site->smtp_port) ?>" class="form-control">
            </div>
            <div class="form-section">
                <label class="form-label">Timeout</label>
                <input type="text" name="smtp_timeout" placeholder="30" value="<?= esc($site->smtp_timeout) ?>" class="form-control">
            </div>
            <div class="form-section">
                <label class="form-label">User / Email</label>
                <input type="text" name="smtp_user" placeholder="email@domain.com" value="<?= esc($site->smtp_user) ?>" class="form-control">
            </div>
            <div class="form-section">
                <label class="form-label">Password</label>
                <input type="password" name="smtp_pass" placeholder="Password" value="<?= esc($site->smtp_pass) ?>" class="form-control">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/konfigurasi') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="reset" class="btn-secondary-action"><i class="fas fa-undo"></i> Reset</button>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan Konfigurasi</button>
</div>

<?php echo form_close(); ?>
