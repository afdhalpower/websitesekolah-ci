<!-- Back -->
<div class="mb-3">
  <a href="<?= base_url('admin/tagihan') ?>" class="btn btn-action btn-secondary-action">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tagihan
  </a>
</div>

<!-- Verified Banner -->
<?php if ($tagihan->status === 'Lunas'): ?>
<div class="verified-banner">
  <i class="fas fa-check-circle"></i>
  <div class="verified-banner-text">
    <strong>Pembayaran Terverifikasi</strong>
    <div style="font-size:var(--font-sm);color:var(--gray);">
      Dibayar <?= esc($tagihan->tanggal_bayar) ?> oleh <?= esc($tagihan->admin_verifikasi) ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Detail Card -->
<div class="card-modern mb-4">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-file-invoice"></i> Detail Tagihan</h5>
    <span class="status-badge <?= $tagihan->status === 'Lunas' ? 'status-success' : 'status-danger' ?>">
      <?= esc($tagihan->status) ?>
    </span>
  </div>
  <div class="card-modern-body">
    <div class="info-grid">
      <div class="info-item">
        <span class="info-label">Nama Siswa</span>
        <span class="info-value"><strong><?= esc($tagihan->nama_siswa) ?></strong> (NIS: <?= esc($tagihan->nis) ?>)</span>
      </div>
      <div class="info-item">
        <span class="info-label">Kelas / Jenjang</span>
        <span class="info-value"><?= esc($tagihan->nama_kelas) ?> — <?= esc($tagihan->nama_jenjang) ?></span>
      </div>
      <div class="info-item">
        <span class="info-label">Biaya</span>
        <span class="info-value"><?= esc($tagihan->nama_biaya) ?></span>
      </div>
      <div class="info-item">
        <span class="info-label">Periode</span>
        <span class="info-value">
          <?php
          $nama_bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
          echo $nama_bulan[$tagihan->bulan] . ' ' . esc($tagihan->tahun);
          ?>
        </span>
      </div>
      <div class="info-item">
        <span class="info-label">Nominal</span>
        <span class="info-value">
          <span class="amount-display">Rp <?= number_format($tagihan->nominal_tagihan, 0, ',', '.') ?></span>
        </span>
      </div>
      <?php if ($tagihan->bukti_bayar): ?>
      <div class="info-item">
        <span class="info-label">Bukti Bayar</span>
        <span class="info-value">
          <a href="<?= base_url('assets/upload/bukti_bayar/' . $tagihan->bukti_bayar) ?>" target="_blank"
             class="btn btn-action btn-primary-action" style="display:inline-flex;gap:0.4rem;">
            <i class="fas fa-file-image"></i> Lihat Bukti
          </a>
        </span>
      </div>
      <?php endif; ?>
      <?php if ($tagihan->keterangan): ?>
      <div class="info-item">
        <span class="info-label">Keterangan</span>
        <span class="info-value"><?= esc($tagihan->keterangan) ?></span>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Payment Form (only if not paid) -->
<?php if ($tagihan->status === 'Belum'): ?>
<?php echo form_open_multipart(base_url('admin/tagihan/bayar/' . $tagihan->id_tagihan)); ?>
<?php echo csrf_field(); ?>
<div class="form-card mb-4">
  <div class="form-card-header">
    <i class="fas fa-check-circle" style="color:var(--green);"></i>
    <h5 class="form-card-title">Verifikasi Pembayaran</h5>
  </div>
  <div class="form-card-body">
    <div class="form-grid">
      <label>Metode Bayar <span style="color:var(--red)">*</span></label>
      <div>
        <select name="metode_bayar" class="form-select" required>
          <option value="">— Pilih Metode —</option>
          <option value="Cash">Cash (Tunai)</option>
          <option value="Transfer">Transfer Bank</option>
        </select>
      </div>

      <label>Bukti Bayar</label>
      <div>
        <input type="file" name="bukti_bayar" class="form-control"
               accept=".jpg,.jpeg,.png,.gif,.webp,.pdf">
        <div style="font-size:var(--font-xs);color:var(--gray);margin-top:0.35rem;">
          Format: JPG, PNG, GIF, WebP, PDF (maks 5MB)
        </div>
      </div>

      <label>Keterangan</label>
      <div>
        <textarea name="keterangan" class="form-control" rows="2"
                  placeholder="Catatan opsional..."></textarea>
      </div>
    </div>
  </div>
  <div class="form-card-footer">
    <a href="<?= base_url('admin/tagihan') ?>" class="btn btn-action btn-secondary-action">
      <i class="fas fa-arrow-left"></i> Batal
    </a>
    <button type="submit" class="btn btn-action btn-success-action">
      <i class="fas fa-check"></i> Verifikasi Bayar
    </button>
  </div>
</div>
<?php echo form_close(); ?>
<?php endif; ?>

<!-- Payment Log -->
<?php if (count($logs) > 0): ?>
<div class="card-modern">
  <div class="card-modern-header">
    <h5 class="card-modern-title"><i class="fas fa-history"></i> Riwayat Pembayaran</h5>
  </div>
  <div class="card-modern-body">
    <div class="payment-timeline">
      <?php foreach ($logs as $log): ?>
      <div class="timeline-item <?= ($log['aksi'] === 'Verifikasi') ? '' : 'warning' ?>">
        <div class="timeline-time"><?= esc($log['tanggal']) ?></div>
        <div class="timeline-action"><?= esc($log['aksi']) ?> — <?= esc($log['admin']) ?></div>
        <div class="timeline-detail"><?= esc($log['keterangan']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>
