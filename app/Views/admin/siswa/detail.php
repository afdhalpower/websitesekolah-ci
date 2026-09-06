<div class="page-header-modern">
    <div>
        <h5 class="page-title">Detail Siswa</h5>
        <p class="page-subtitle"><?= esc($siswa->nama_siswa) ?></p>
    </div>
    <div>
        <a href="<?= base_url('admin/siswa/edit/'.$siswa->id_siswa) ?>" class="btn-success-action"><i class="fas fa-edit"></i> Edit</a>
        <a href="<?= base_url('admin/siswa/cetak/'.$siswa->id_siswa) ?>" class="btn-secondary-action" target="_blank"><i class="fas fa-print"></i> Cetak</a>
        <a href="<?= base_url('admin/siswa/unduh/'.$siswa->id_siswa) ?>" class="btn-danger-action" target="_blank"><i class="fas fa-file-pdf"></i> Unduh</a>
        <a href="<?= base_url('admin/siswa') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:250px 1fr;gap:1.5rem;">
    <div class="card-modern">
        <div class="card-modern-header"><h6 style="margin:0;font-weight:600;">Foto Siswa</h6></div>
        <div class="card-modern-body" style="text-align:center;">
            <?php if($siswa->gambar=='') { ?>
                <div class="info-box-modern"><i class="fas fa-user-circle" style="font-size:4rem;color:var(--gray);"></i><br><small>Belum Ada foto</small></div>
            <?php } else { ?>
                <img src="<?= base_url('assets/upload/image/'.$siswa->gambar) ?>" style="max-width:100%;border-radius:12px;">
            <?php } ?>
            <hr>
            <strong style="font-size:1.1rem;"><?= esc($siswa->nama_siswa) ?></strong>
            <br><small style="color:var(--gray);"><?= esc($siswa->nis) ?> / <?= esc($siswa->nisn) ?></small>
            <br>
            <?php
            $statusColors = ['Aktif'=>'rgba(34,197,94,0.1);#16a34a','Lulus'=>'rgba(59,130,246,0.1);#2563eb','Meninggal'=>'rgba(107,114,128,0.1);#374151','Pindah'=>'rgba(234,179,8,0.1);#ca8a04'];
            $parts = explode(';', $statusColors[$siswa->status_siswa] ?? 'rgba(107,114,128,0.1);#6b7280');
            ?>
            <span class="status-badge" style="background:<?= $parts[0] ?>;color:<?= $parts[1] ?>;"><?= esc($siswa->status_siswa) ?></span>
        </div>
    </div>

    <div class="card-modern">
        <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-user" style="color:var(--green);margin-right:6px;"></i> Data Diri Siswa</h6></div>
        <div class="card-modern-body">
            <table class="table-modern">
                <tbody>
                    <tr><td style="width:25%;font-weight:600;">Nama Lengkap</td><td><?= esc($siswa->nama_siswa) ?></td></tr>
                    <tr><td style="font-weight:600;">Nama Panggilan</td><td><?= esc($siswa->nama_panggilan) ?></td></tr>
                    <tr><td style="font-weight:600;">Jenis Kelamin</td><td><?= esc($siswa->jenis_kelamin) ?></td></tr>
                    <tr><td style="font-weight:600;">Tempat, Tanggal Lahir</td><td><?= esc($siswa->tempat_lahir) ?>, <?= esc($this->website->tanggal_id($siswa->tanggal_lahir)) ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
