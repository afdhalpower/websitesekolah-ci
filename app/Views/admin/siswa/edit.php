<?php
use App\Models\Agama_model;
use App\Models\Jenjang_model;
use App\Models\Pekerjaan_model;
use App\Models\Hubungan_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
$m_agama = new Agama_model();
$m_jenjang = new Jenjang_model();
$m_pekerjaan = new Pekerjaan_model();
$m_hubungan = new Hubungan_model();
$m_tahun = new Tahun_model();
$m_kelas = new Kelas_model();
echo form_open_multipart(base_url('admin/siswa/edit/'.$siswa->id_siswa));
echo csrf_field();
?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Edit Data Siswa</h5>
        <p class="page-subtitle"><?= esc($siswa->nama_siswa) ?></p>
    </div>
    <div>
        <a href="<?= base_url('admin/siswa') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<!-- FOTO & DATA DASAR -->
<div style="display:grid;grid-template-columns:200px 1fr;gap:1.5rem;margin-bottom:1.5rem;">
    <div class="card-modern">
        <div class="card-modern-header"><h6 style="margin:0;font-weight:600;">Foto Siswa</h6></div>
        <div class="card-modern-body" style="text-align:center;">
            <?php if($siswa->gambar=='') { ?>
                <div class="info-box-modern"><i class="fas fa-user-circle" style="font-size:3rem;color:var(--gray);"></i><br><small>Belum Ada foto</small></div>
            <?php } else { ?>
                <img src="<?= base_url('assets/upload/image/'.$siswa->gambar) ?>" style="max-width:100%;border-radius:12px;">
            <?php } ?>
        </div>
    </div>
    <div class="card-modern">
        <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-user" style="color:var(--green);margin-right:6px;"></i> Data Diri Siswa</h6></div>
        <div class="card-modern-body">
            <div class="form-grid">
                <div class="form-section">
                    <label class="form-label">Nama Lengkap <span style="color:var(--red);">*</span></label>
                    <input type="text" name="nama_siswa" class="form-control" value="<?= (isset($_POST['nama_siswa'])) ? set_value('nama_siswa') : esc($siswa->nama_siswa) ?>" required>
                </div>
                <div class="form-section">
                    <label class="form-label">Nama Panggilan</label>
                    <input type="text" name="nama_panggilan" class="form-control" value="<?= (isset($_POST['nama_panggilan'])) ? set_value('nama_panggilan') : esc($siswa->nama_panggilan) ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">NIS / NISN</label>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                        <input type="text" name="nis" class="form-control" placeholder="NIS" value="<?= (isset($_POST['nis'])) ? set_value('nis') : esc($siswa->nis) ?>">
                        <input type="text" name="nisn" class="form-control" placeholder="NISN" value="<?= (isset($_POST['nisn'])) ? set_value('nisn') : esc($siswa->nisn) ?>">
                    </div>
                </div>
                <div class="form-section">
                    <label class="form-label">Agama <span style="color:var(--red);">*</span></label>
                    <?php $agama = $m_agama->listing(); ?>
                    <select name="id_agama" class="form-control select2">
                        <?php foreach($agama as $a) { ?>
                            <option value="<?= esc($a->id_agama) ?>" <?php if((set_value('id_agama')==$a->id_agama)||($siswa->id_agama==$a->id_agama)) echo 'selected'; ?>><?= esc($a->nama_agama) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Status WNI/WNA</label>
                    <select name="status_wn" class="form-control">
                        <option value="WNI" <?= ($siswa->status_wn=='WNI') ? 'selected' : '' ?>>WNI</option>
                        <option value="WNA" <?= ($siswa->status_wn=='WNA') ? 'selected' : '' ?>>WNA</option>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Negara Asal (Jika WNA)</label>
                    <input type="text" name="negara_asal" class="form-control" value="<?= (isset($_POST['negara_asal'])) ? set_value('negara_asal') : esc($siswa->negara_asal) ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">Jenis Kelamin <span style="color:var(--red);">*</span></label>
                    <div style="display:flex;gap:16px;padding-top:6px;">
                        <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                            <input type="radio" name="jenis_kelamin" value="L" <?= ($siswa->jenis_kelamin=='L'||$siswa->jenis_kelamin=='Laki-laki'||set_value('jenis_kelamin')=='L') ? 'checked' : '' ?> required> Laki-laki
                        </label>
                        <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                            <input type="radio" name="jenis_kelamin" value="P" <?= ($siswa->jenis_kelamin=='P'||$siswa->jenis_kelamin=='Perempuan'||set_value('jenis_kelamin')=='P') ? 'checked' : '' ?> required> Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-section">
                    <label class="form-label">Status/Hubungan Anak <span style="color:var(--red);">*</span></label>
                    <?php $hubungan = $m_hubungan->listing(); ?>
                    <select name="id_hubungan" class="form-control select2">
                        <?php foreach($hubungan as $h) { ?>
                            <option value="<?= esc($h->id_hubungan) ?>" <?php if((set_value('id_hubungan')==$h->id_hubungan)||($siswa->id_hubungan==$h->id_hubungan)) echo 'selected'; ?>><?= esc($h->nama_hubungan) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Anak ke-</label>
                    <input type="number" name="anak_ke" class="form-control" value="<?= (isset($_POST['anak_ke'])) ? set_value('anak_ke') : esc($siswa->anak_ke) ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">Jumlah Saudara</label>
                    <input type="number" name="jumlah_saudara" class="form-control" value="<?= (isset($_POST['jumlah_saudara'])) ? set_value('jumlah_saudara') : esc($siswa->jumlah_saudara) ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">Tempat Lahir <span style="color:var(--red);">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= (isset($_POST['tempat_lahir'])) ? set_value('tempat_lahir') : esc($siswa->tempat_lahir) ?>" required>
                </div>
                <div class="form-section">
                    <label class="form-label">Tanggal Lahir <span style="color:var(--red);">*</span></label>
                    <input type="text" name="tanggal_lahir" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?= (isset($_POST['tanggal_lahir'])) ? set_value('tanggal_lahir') : esc($this->website->tanggal_id($siswa->tanggal_lahir)) ?>" required>
                </div>
                <div class="form-section">
                    <label class="form-label">Alamat <span style="color:var(--red);">*</span></label>
                    <textarea name="alamat" class="form-control" required><?= (isset($_POST['alamat'])) ? set_value('alamat') : esc($siswa->alamat) ?></textarea>
                </div>
                <div class="form-section">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="<?= (isset($_POST['kode_pos'])) ? set_value('kode_pos') : esc($siswa->kode_pos) ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">Telepon / Email</label>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                        <input type="text" name="telepon" class="form-control" placeholder="Telepon/HP" value="<?= (isset($_POST['telepon'])) ? set_value('telepon') : esc($siswa->telepon) ?>">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= (isset($_POST['email'])) ? set_value('email') : esc($siswa->email) ?>">
                    </div>
                </div>
                <div class="form-section">
                    <label class="form-label">Gambar/Foto</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DATA PENERIMAAN -->
<div class="card-modern mb-3">
    <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-graduation-cap" style="color:var(--blue);margin-right:6px;"></i> Data Penerimaan di Sekolah</h6></div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Jenis Masuk <span style="color:var(--red);">*</span></label>
                <div style="display:flex;gap:16px;padding-top:6px;">
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="jenis_siswa" value="Langsung" <?= ($siswa->jenis_siswa=='Langsung'||set_value('jenis_siswa')=='Langsung') ? 'checked' : '' ?> required> Langsung
                    </label>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="jenis_siswa" value="Pindahan" <?= ($siswa->jenis_siswa=='Pindahan'||set_value('jenis_siswa')=='Pindahan') ? 'checked' : '' ?> required> Pindahan
                    </label>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Status Siswa <span style="color:var(--red);">*</span></label>
                <div style="display:flex;gap:16px;padding-top:6px;flex-wrap:wrap;">
                    <?php foreach(['Aktif','Lulus','Pindah','Meninggal'] as $st) { ?>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="status_siswa" value="<?= $st ?>" <?= ($siswa->status_siswa==$st||set_value('status_siswa')==$st) ? 'checked' : '' ?> required> <?= $st ?>
                    </label>
                    <?php } ?>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Tahun Ajaran <span style="color:var(--red);">*</span></label>
                <?php $tahun = $m_tahun->listing(); ?>
                <select name="id_tahun" class="form-control select2" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    <?php foreach($tahun as $t) { ?>
                        <option value="<?= esc($t->id_tahun) ?>" <?php if((set_value('id_tahun')==$t->id_tahun)||($siswa->id_tahun==$t->id_tahun)) echo 'selected'; ?>><?= esc($t->tahun_mulai) ?>/<?= esc($t->tahun_selesai) ?> - <?= esc($t->nama_tahun) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Jenjang/Kelompok <span style="color:var(--red);">*</span></label>
                <?php $jenjang = $m_jenjang->listing(); ?>
                <select name="id_jenjang" class="form-control select2" required>
                    <option value="">Pilih Kelompok</option>
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>" <?php if((set_value('id_jenjang')==$j->id_jenjang)||($siswa->id_jenjang==$j->id_jenjang)) echo 'selected'; ?>><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Kelas <span style="color:var(--red);">*</span></label>
                <?php $kelas = $m_kelas->listing(); ?>
                <select name="id_kelas" class="form-control select2" required>
                    <option value="">Pilih Kelas</option>
                    <?php foreach($kelas as $k) { ?>
                        <option value="<?= esc($k->id_kelas) ?>" <?php if((set_value('id_kelas')==$k->id_kelas)||($siswa->id_kelas==$k->id_kelas)) echo 'selected'; ?>><?= esc($k->nama_jenjang) ?> - <?= esc($k->nama_kelas) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Masuk <span style="color:var(--red);">*</span></label>
                <input type="text" name="tanggal_masuk" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?= (isset($_POST['tanggal_masuk'])) ? set_value('tanggal_masuk') : esc($this->website->tanggal_id($siswa->tanggal_masuk)) ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Sekolah Asal</label>
                <input type="text" name="asal_sekolah" class="form-control" value="<?= (isset($_POST['asal_sekolah'])) ? set_value('asal_sekolah') : esc($siswa->asal_sekolah) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Alamat Sekolah Asal</label>
                <textarea name="alamat_sekolah_asal" class="form-control"><?= (isset($_POST['alamat_sekolah_asal'])) ? set_value('alamat_sekolah_asal') : esc($siswa->alamat_sekolah_asal) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Pindah</label>
                <input type="text" name="tanggal_pindah" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?= (isset($_POST['tanggal_pindah'])) ? set_value('tanggal_pindah') : esc($this->website->tanggal_id($siswa->tanggal_pindah)) ?>">
            </div>
        </div>
    </div>
</div>

<!-- KESEHATAN & INFO TAMBAHAN -->
<div class="card-modern mb-3">
    <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-heartbeat" style="color:var(--red);margin-right:6px;"></i> Data Kesehatan & Informasi Tambahan</h6></div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Golongan Darah</label>
                <select name="goldar_siswa" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach(['A','B','AB','O'] as $g) { ?>
                        <option value="<?= $g ?>" <?= ($siswa->goldar_siswa==$g||set_value('goldar_siswa')==$g) ? 'selected' : '' ?>><?= $g ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Tinggi & Berat Badan</label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                    <input type="number" name="tinggi" class="form-control" placeholder="Tinggi (cm)" value="<?= (isset($_POST['tinggi'])) ? set_value('tinggi') : esc($siswa->tinggi) ?>">
                    <input type="number" name="berat" class="form-control" placeholder="Berat (kg)" value="<?= (isset($_POST['berat'])) ? set_value('berat') : esc($siswa->berat) ?>">
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Penyakit</label>
                <textarea name="penyakit_siswa" class="form-control" placeholder="Penyakit yang pernah/sedang diderita"><?= (isset($_POST['penyakit_siswa'])) ? set_value('penyakit_siswa') : esc($siswa->penyakit_siswa) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Hobi</label>
                <textarea name="hobi_siswa" class="form-control" placeholder="Hobi siswa"><?= (isset($_POST['hobi_siswa'])) ? set_value('hobi_siswa') : esc($siswa->hobi_siswa) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Berkebutuhan Khusus?</label>
                <div style="display:flex;gap:16px;padding-top:6px;">
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="berkebutuhan_khusus" value="Tidak" <?= ($siswa->berkebutuhan_khusus=='Tidak'||set_value('berkebutuhan_khusus')=='Tidak') ? 'checked' : '' ?> required> Tidak
                    </label>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="berkebutuhan_khusus" value="Ya" <?= ($siswa->berkebutuhan_khusus=='Ya'||set_value('berkebutuhan_khusus')=='Ya') ? 'checked' : '' ?> required> Ya
                    </label>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Deskripsi Ringkas</label>
                <textarea name="isi" class="form-control" placeholder="Deskripsi tentang siswa"><?= (isset($_POST['isi'])) ? set_value('isi') : esc($siswa->isi) ?></textarea>
            </div>
        </div>
    </div>
</div>

<!-- DATA AYAH -->
<div class="card-modern mb-3">
    <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-male" style="color:var(--blue);margin-right:6px;"></i> Data Orang Tua - Ayah</h6></div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="<?= (isset($_POST['nama_ayah'])) ? set_value('nama_ayah') : esc($siswa->nama_ayah) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Agama Ayah</label>
                <?php $agama = $m_agama->listing(); ?>
                <select name="id_agama_ayah" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php foreach($agama as $a) { ?>
                        <option value="<?= esc($a->id_agama) ?>" <?php if((set_value('id_agama_ayah')==$a->id_agama)||($siswa->id_agama_ayah==$a->id_agama)) echo 'selected'; ?>><?= esc($a->nama_agama) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pekerjaan Ayah</label>
                <?php $pekerjaan = $m_pekerjaan->listing(); ?>
                <select name="id_pekerjaan_ayah" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php foreach($pekerjaan as $p) { ?>
                        <option value="<?= esc($p->id_pekerjaan) ?>" <?php if((set_value('id_pekerjaan_ayah')==$p->id_pekerjaan)||($siswa->id_pekerjaan_ayah==$p->id_pekerjaan)) echo 'selected'; ?>><?= esc($p->nama_pekerjaan) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pendidikan Ayah</label>
                <?php $jenjang = $m_jenjang->listing(); ?>
                <select name="id_jenjang_ayah" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>" <?php if((set_value('id_jenjang_ayah')==$j->id_jenjang)||($siswa->id_jenjang_ayah==$j->id_jenjang)) echo 'selected'; ?>><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Alamat Ayah</label>
                <textarea name="alamat_ayah" class="form-control"><?= (isset($_POST['alamat_ayah'])) ? set_value('alamat_ayah') : esc($siswa->alamat_ayah) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Telepon/HP Ayah</label>
                <input type="text" name="telepon_ayah" class="form-control" value="<?= (isset($_POST['telepon_ayah'])) ? set_value('telepon_ayah') : esc($siswa->telepon_ayah) ?>">
            </div>
        </div>
    </div>
</div>

<!-- DATA IBU -->
<div class="card-modern mb-3">
    <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-female" style="color:var(--amber);margin-right:6px;"></i> Data Orang Tua - Ibu</h6></div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="<?= (isset($_POST['nama_ibu'])) ? set_value('nama_ibu') : esc($siswa->nama_ibu) ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Agama Ibu</label>
                <?php $agama = $m_agama->listing(); ?>
                <select name="id_agama_ibu" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php foreach($agama as $a) { ?>
                        <option value="<?= esc($a->id_agama) ?>" <?php if((set_value('id_agama_ibu')==$a->id_agama)||($siswa->id_agama_ibu==$a->id_agama)) echo 'selected'; ?>><?= esc($a->nama_agama) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pekerjaan Ibu</label>
                <?php $pekerjaan = $m_pekerjaan->listing(); ?>
                <select name="id_pekerjaan_ibu" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php foreach($pekerjaan as $p) { ?>
                        <option value="<?= esc($p->id_pekerjaan) ?>" <?php if((set_value('id_pekerjaan_ibu')==$p->id_pekerjaan)||($siswa->id_pekerjaan_ibu==$p->id_pekerjaan)) echo 'selected'; ?>><?= esc($p->nama_pekerjaan) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pendidikan Ibu</label>
                <?php $jenjang = $m_jenjang->listing(); ?>
                <select name="id_jenjang_ibu" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>" <?php if((set_value('id_jenjang_ibu')==$j->id_jenjang)||($siswa->id_jenjang_ibu==$j->id_jenjang)) echo 'selected'; ?>><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Alamat Ibu</label>
                <textarea name="alamat_ibu" class="form-control"><?= (isset($_POST['alamat_ibu'])) ? set_value('alamat_ibu') : esc($siswa->alamat_ibu) ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Telepon/HP Ibu</label>
                <input type="text" name="telepon_ibu" class="form-control" value="<?= (isset($_POST['telepon_ibu'])) ? set_value('telepon_ibu') : esc($siswa->telepon_ibu) ?>">
            </div>
        </div>
    </div>
</div>

<!-- DATA WALI -->
<div class="card-modern mb-3">
    <div class="card-modern-header"><h6 style="margin:0;font-weight:600;"><i class="fas fa-user-shield" style="color:var(--green);margin-right:6px;"></i> Data Wali Murid</h6></div>
    <div class="card-modern-body">
        <div class="form-section mb-3">
            <label class="form-label">Identitas Wali Murid</label>
            <div style="display:flex;gap:16px;flex-wrap:wrap;">
                <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                    <input type="radio" name="identitas_wali" value="Ayah" onclick="document.getElementById('myDIV').style.display='none'" <?= (set_value('identitas_wali')=='Ayah') ? 'checked' : '' ?>> Sama dengan Ayah
                </label>
                <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                    <input type="radio" name="identitas_wali" value="Ibu" onclick="document.getElementById('myDIV').style.display='none'" <?= (set_value('identitas_wali')=='Ibu') ? 'checked' : '' ?>> Sama dengan Ibu
                </label>
                <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                    <input type="radio" name="identitas_wali" value="Berbeda" onclick="document.getElementById('myDIV').style.display='block'" <?= (set_value('identitas_wali')=='Berbeda') ? 'checked' : 'checked' ?>> Berbeda
                </label>
            </div>
        </div>
        <div id="myDIV">
            <div class="form-grid">
                <div class="form-section">
                    <label class="form-label">Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" value="<?= (isset($_POST['nama_wali'])) ? set_value('nama_wali') : esc($siswa->nama_wali) ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">Agama Wali</label>
                    <?php $agama = $m_agama->listing(); ?>
                    <select name="id_agama_wali" class="form-control select2">
                        <option value="">Pilih</option>
                        <?php foreach($agama as $a) { ?>
                            <option value="<?= esc($a->id_agama) ?>" <?php if((set_value('id_agama_wali')==$a->id_agama)||($siswa->id_agama_wali==$a->id_agama)) echo 'selected'; ?>><?= esc($a->nama_agama) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Pekerjaan Wali</label>
                    <?php $pekerjaan = $m_pekerjaan->listing(); ?>
                    <select name="id_pekerjaan_wali" class="form-control select2">
                        <option value="">Pilih</option>
                        <?php foreach($pekerjaan as $p) { ?>
                            <option value="<?= esc($p->id_pekerjaan) ?>" <?php if((set_value('id_pekerjaan_wali')==$p->id_pekerjaan)||($siswa->id_pekerjaan_wali==$p->id_pekerjaan)) echo 'selected'; ?>><?= esc($p->nama_pekerjaan) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Pendidikan Wali</label>
                    <?php $jenjang = $m_jenjang->listing(); ?>
                    <select name="id_jenjang_wali" class="form-control select2">
                        <option value="">Pilih</option>
                        <?php foreach($jenjang as $j) { ?>
                            <option value="<?= esc($j->id_jenjang) ?>" <?php if((set_value('id_jenjang_wali')==$j->id_jenjang)||($siswa->id_jenjang_wali==$j->id_jenjang)) echo 'selected'; ?>><?= esc($j->nama_jenjang) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Alamat Wali</label>
                    <textarea name="alamat_wali" class="form-control"><?= (isset($_POST['alamat_wali'])) ? set_value('alamat_wali') : esc($siswa->alamat_wali) ?></textarea>
                </div>
                <div class="form-section">
                    <label class="form-label">Telepon/HP Wali</label>
                    <input type="text" name="telepon_wali" class="form-control" value="<?= (isset($_POST['telepon_wali'])) ? set_value('telepon_wali') : esc($siswa->telepon_wali) ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/siswa') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="reset" class="btn-secondary-action"><i class="fas fa-undo"></i> Reset</button>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan Perubahan</button>
</div>

<?php echo form_close(); ?>

<script>
function Ayah(){document.getElementById("myDIV").style.display="none";}
function Ibu(){document.getElementById("myDIV").style.display="none";}
function Berbeda(){document.getElementById("myDIV").style.display="block";}
</script>
