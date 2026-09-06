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
echo form_open_multipart(base_url('admin/siswa/tambah'));
echo csrf_field();
?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Tambah Siswa Baru</h5>
        <p class="page-subtitle">Lengkapi semua data siswa baru</p>
    </div>
</div>

<!-- DATA DASAR SISWA -->
<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-user" style="color:var(--green);margin-right:6px;"></i> Data Diri Siswa</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Lengkap <span style="color:var(--red);">*</span></label>
                <input type="text" name="nama_siswa" class="form-control" placeholder="Nama lengkap siswa" value="<?= set_value('nama_siswa') ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Nama Panggilan</label>
                <input type="text" name="nama_panggilan" class="form-control" placeholder="Nama panggilan" value="<?= set_value('nama_panggilan') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa" value="<?= set_value('nis') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" placeholder="Nomor Induk Siswa Nasional" value="<?= set_value('nisn') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Agama <span style="color:var(--red);">*</span></label>
                <?php $agama = $m_agama->listing(); ?>
                <select name="id_agama" class="form-control select2">
                    <?php foreach($agama as $a) { ?>
                        <option value="<?= esc($a->id_agama) ?>"><?= esc($a->nama_agama) ?></option>
                    <?php } ?>
                </select>
                <small><a href="<?= base_url('admin/agama') ?>" target="_blank">Kelola?</a></small>
            </div>
            <div class="form-section">
                <label class="form-label">Status WNI/WNA</label>
                <select name="status_wn" class="form-control">
                    <option value="WNI">WNI</option>
                    <option value="WNA" <?= set_value('status_wn')=='WNA' ? 'selected' : '' ?>>WNA</option>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Negara Asal (Jika WNA)</label>
                <input type="text" name="negara_asal" class="form-control" value="<?= set_value('negara_asal') ?>" placeholder="Negara asal">
            </div>
            <div class="form-section">
                <label class="form-label">Jenis Kelamin <span style="color:var(--red);">*</span></label>
                <div style="display:flex;gap:16px;padding-top:6px;">
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="jenis_kelamin" value="L" <?= set_value('jenis_kelamin')=='L' ? 'checked' : '' ?> required> Laki-laki
                    </label>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="jenis_kelamin" value="P" <?= set_value('jenis_kelamin')=='P' ? 'checked' : '' ?> required> Perempuan
                    </label>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Status/Hubungan Anak dengan Wali</label>
                <?php $hubungan = $m_hubungan->listing(); ?>
                <select name="id_hubungan" class="form-control select2">
                    <?php foreach($hubungan as $h) { ?>
                        <option value="<?= esc($h->id_hubungan) ?>"><?= esc($h->nama_hubungan) ?></option>
                    <?php } ?>
                </select>
                <small><a href="<?= base_url('admin/hubungan') ?>" target="_blank">Kelola?</a></small>
            </div>
            <div class="form-section">
                <label class="form-label">Anak ke-</label>
                <input type="number" name="anak_ke" class="form-control" placeholder="Anak nomor ke?" value="<?= set_value('anak_ke') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Jumlah Saudara</label>
                <input type="number" name="jumlah_saudara" class="form-control" placeholder="Jumlah saudara" value="<?= set_value('jumlah_saudara') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Tempat Lahir <span style="color:var(--red);">*</span></label>
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="<?= set_value('tempat_lahir') ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Lahir <span style="color:var(--red);">*</span></label>
                <input type="text" name="tanggal_lahir" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?= set_value('tanggal_lahir') ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Alamat <span style="color:var(--red);">*</span></label>
                <textarea name="alamat" placeholder="Alamat lengkap" class="form-control" required><?= set_value('alamat') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Kode Pos</label>
                <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" value="<?= set_value('kode_pos') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Telepon/HP</label>
                <input type="text" name="telepon" class="form-control" placeholder="Telepon/HP" value="<?= set_value('telepon') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email (Username)" value="<?= set_value('email') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Gambar/Foto</label>
                <input type="file" name="gambar" class="form-control">
            </div>
        </div>
    </div>
</div>

<!-- DATA PENERIMAAN -->
<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-graduation-cap" style="color:var(--blue);margin-right:6px;"></i> Data Penerimaan di Sekolah</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Jenis Masuk <span style="color:var(--red);">*</span></label>
                <div style="display:flex;gap:16px;padding-top:6px;">
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="jenis_siswa" value="Langsung" <?= set_value('jenis_siswa')=='Langsung' ? 'checked' : 'checked' ?> required> Langsung
                    </label>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="jenis_siswa" value="Pindahan" <?= set_value('jenis_siswa')=='Pindahan' ? 'checked' : '' ?> required> Pindahan
                    </label>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Status Siswa <span style="color:var(--red);">*</span></label>
                <div style="display:flex;gap:16px;padding-top:6px;flex-wrap:wrap;">
                    <?php foreach(['Aktif','Lulus','Pindah','Meninggal'] as $st) { ?>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="status_siswa" value="<?= $st ?>" <?= ($st=='Aktif') ? 'checked' : (set_value('status_siswa')==$st ? 'checked' : '') ?> required> <?= $st ?>
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
                        <option value="<?= esc($t->id_tahun) ?>"><?= esc($t->tahun_mulai) ?>/<?= esc($t->tahun_selesai) ?> - <?= esc($t->nama_tahun) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Jenjang/Kelompok <span style="color:var(--red);">*</span></label>
                <?php $jenjang = $m_jenjang->listing(); ?>
                <select name="id_jenjang" class="form-control select2" required>
                    <option value="">Pilih Kelompok</option>
                    <?php foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>"><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
                <small><a href="<?= base_url('admin/jenjang') ?>" target="_blank">Kelola?</a></small>
            </div>
            <div class="form-section">
                <label class="form-label">Kelas <span style="color:var(--red);">*</span></label>
                <?php $kelas = $m_kelas->listing(); ?>
                <select name="id_kelas" class="form-control select2" required>
                    <option value="">Pilih Kelas</option>
                    <?php foreach($kelas as $k) { ?>
                        <option value="<?= esc($k->id_kelas) ?>"><?= esc($k->nama_jenjang) ?> - <?= esc($k->nama_kelas) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Masuk <span style="color:var(--red);">*</span></label>
                <input type="text" name="tanggal_masuk" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?= set_value('tanggal_masuk') ?>" required>
            </div>
            <div class="form-section">
                <label class="form-label">Sekolah Asal</label>
                <input type="text" name="asal_sekolah" class="form-control" placeholder="Nama sekolah asal" value="<?= set_value('asal_sekolah') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Alamat Sekolah Asal</label>
                <textarea name="alamat_sekolah_asal" class="form-control" placeholder="Alamat sekolah asal"><?= set_value('alamat_sekolah_asal') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Tanggal Pindah</label>
                <input type="text" name="tanggal_pindah" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?= set_value('tanggal_pindah') ?>">
            </div>
        </div>
    </div>
</div>

<!-- DATA KESEHATAN -->
<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-heartbeat" style="color:var(--red);margin-right:6px;"></i> Data Kesehatan & Informasi Tambahan</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Golongan Darah</label>
                <select name="goldar_siswa" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach(['A','B','AB','O'] as $g) { ?>
                        <option value="<?= $g ?>" <?= set_value('goldar_siswa')==$g ? 'selected' : '' ?>><?= $g ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number" name="tinggi" class="form-control" placeholder="cm" value="<?= set_value('tinggi') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number" name="berat" class="form-control" placeholder="kg" value="<?= set_value('berat') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Penyakit</label>
                <textarea name="penyakit_siswa" class="form-control" placeholder="Penyakit yang pernah/sedang diderita"><?= set_value('penyakit_siswa') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Hobi</label>
                <textarea name="hobi_siswa" class="form-control" placeholder="Hobi siswa"><?= set_value('hobi_siswa') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Berkebutuhan Khusus?</label>
                <div style="display:flex;gap:16px;padding-top:6px;">
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="berkebutuhan_khusus" value="Tidak" <?= set_value('berkebutuhan_khusus')=='Tidak' ? 'checked' : 'checked' ?> required> Tidak
                    </label>
                    <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                        <input type="radio" name="berkebutuhan_khusus" value="Ya" <?= set_value('berkebutuhan_khusus')=='Ya' ? 'checked' : '' ?> required> Ya
                    </label>
                </div>
            </div>
            <div class="form-section">
                <label class="form-label">Deskripsi Ringkas</label>
                <textarea name="isi" class="form-control" placeholder="Deskripsi tentang siswa"><?= set_value('isi') ?></textarea>
            </div>
        </div>
    </div>
</div>

<!-- DATA AYAH -->
<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-male" style="color:var(--blue);margin-right:6px;"></i> Data Orang Tua - Ayah</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?= set_value('nama_ayah') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Agama Ayah</label>
                <select name="id_agama_ayah" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php $agama = $m_agama->listing(); foreach($agama as $a) { ?>
                        <option value="<?= esc($a->id_agama) ?>"><?= esc($a->nama_agama) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pekerjaan Ayah</label>
                <select name="id_pekerjaan_ayah" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php $pekerjaan = $m_pekerjaan->listing(); foreach($pekerjaan as $p) { ?>
                        <option value="<?= esc($p->id_pekerjaan) ?>"><?= esc($p->nama_pekerjaan) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pendidikan Ayah</label>
                <select name="id_jenjang_ayah" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php $jenjang = $m_jenjang->listing(); foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>"><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Alamat Ayah</label>
                <textarea name="alamat_ayah" class="form-control" placeholder="Alamat Ayah"><?= set_value('alamat_ayah') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Telepon/HP Ayah</label>
                <input type="text" name="telepon_ayah" class="form-control" placeholder="Telepon/HP Ayah" value="<?= set_value('telepon_ayah') ?>">
            </div>
        </div>
    </div>
</div>

<!-- DATA IBU -->
<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-female" style="color:var(--amber);margin-right:6px;"></i> Data Orang Tua - Ibu</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-grid">
            <div class="form-section">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?= set_value('nama_ibu') ?>">
            </div>
            <div class="form-section">
                <label class="form-label">Agama Ibu</label>
                <select name="id_agama_ibu" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php $agama = $m_agama->listing(); foreach($agama as $a) { ?>
                        <option value="<?= esc($a->id_agama) ?>"><?= esc($a->nama_agama) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pekerjaan Ibu</label>
                <select name="id_pekerjaan_ibu" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php $pekerjaan = $m_pekerjaan->listing(); foreach($pekerjaan as $p) { ?>
                        <option value="<?= esc($p->id_pekerjaan) ?>"><?= esc($p->nama_pekerjaan) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Pendidikan Ibu</label>
                <select name="id_jenjang_ibu" class="form-control select2">
                    <option value="">Pilih</option>
                    <?php $jenjang = $m_jenjang->listing(); foreach($jenjang as $j) { ?>
                        <option value="<?= esc($j->id_jenjang) ?>"><?= esc($j->nama_jenjang) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-section">
                <label class="form-label">Alamat Ibu</label>
                <textarea name="alamat_ibu" class="form-control" placeholder="Alamat Ibu"><?= set_value('alamat_ibu') ?></textarea>
            </div>
            <div class="form-section">
                <label class="form-label">Telepon/HP Ibu</label>
                <input type="text" name="telepon_ibu" class="form-control" placeholder="Telepon/HP Ibu" value="<?= set_value('telepon_ibu') ?>">
            </div>
        </div>
    </div>
</div>

<!-- DATA WALI -->
<div class="card-modern mb-3">
    <div class="card-modern-header">
        <h6 style="margin:0;font-weight:600;"><i class="fas fa-user-shield" style="color:var(--green);margin-right:6px;"></i> Data Wali Murid</h6>
    </div>
    <div class="card-modern-body">
        <div class="form-section mb-3">
            <label class="form-label">Identitas Wali Murid</label>
            <div style="display:flex;gap:16px;flex-wrap:wrap;">
                <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                    <input type="radio" name="identitas_wali" value="Ayah" onclick="document.getElementById('myDIV').style.display='none'" <?= set_value('identitas_wali')=='Ayah' ? 'checked' : '' ?>> Sama dengan Ayah
                </label>
                <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                    <input type="radio" name="identitas_wali" value="Ibu" onclick="document.getElementById('myDIV').style.display='none'" <?= set_value('identitas_wali')=='Ibu' ? 'checked' : '' ?>> Sama dengan Ibu
                </label>
                <label style="display:flex;align-items:center;gap:4px;font-size:0.85rem;cursor:pointer;">
                    <input type="radio" name="identitas_wali" value="Berbeda" onclick="document.getElementById('myDIV').style.display='block'" <?= set_value('identitas_wali')=='Berbeda' ? 'checked' : 'checked' ?>> Berbeda
                </label>
            </div>
        </div>
        <div id="myDIV">
            <div class="form-grid">
                <div class="form-section">
                    <label class="form-label">Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" placeholder="Nama Wali" value="<?= set_value('nama_wali') ?>">
                </div>
                <div class="form-section">
                    <label class="form-label">Agama Wali</label>
                    <select name="id_agama_wali" class="form-control select2">
                        <option value="">Pilih</option>
                        <?php $agama = $m_agama->listing(); foreach($agama as $a) { ?>
                            <option value="<?= esc($a->id_agama) ?>"><?= esc($a->nama_agama) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Pekerjaan Wali</label>
                    <select name="id_pekerjaan_wali" class="form-control select2">
                        <option value="">Pilih</option>
                        <?php $pekerjaan = $m_pekerjaan->listing(); foreach($pekerjaan as $p) { ?>
                            <option value="<?= esc($p->id_pekerjaan) ?>"><?= esc($p->nama_pekerjaan) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Pendidikan Wali</label>
                    <select name="id_jenjang_wali" class="form-control select2">
                        <option value="">Pilih</option>
                        <?php $jenjang = $m_jenjang->listing(); foreach($jenjang as $j) { ?>
                            <option value="<?= esc($j->id_jenjang) ?>"><?= esc($j->nama_jenjang) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-section">
                    <label class="form-label">Alamat Wali</label>
                    <textarea name="alamat_wali" class="form-control" placeholder="Alamat Wali"><?= set_value('alamat_wali') ?></textarea>
                </div>
                <div class="form-section">
                    <label class="form-label">Telepon/HP Wali</label>
                    <input type="text" name="telepon_wali" class="form-control" placeholder="Telepon/HP Wali" value="<?= set_value('telepon_wali') ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="<?= base_url('admin/siswa') ?>" class="btn-secondary-action"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button type="reset" class="btn-secondary-action"><i class="fas fa-undo"></i> Reset</button>
    <button type="submit" class="btn-success-action"><i class="fas fa-save"></i> Simpan</button>
</div>

<?php echo form_close(); ?>
