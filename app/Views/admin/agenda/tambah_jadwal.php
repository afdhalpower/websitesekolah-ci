<script>
$('.waktu').timepicker({
    timeFormat: 'h:mm',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
</script>

<div class="modal fade" id="modal-tambah-jadwal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-plus-circle" style="color:var(--green);"></i> Tambah Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open(base_url('admin/agenda/jadwal/'.$agenda['id_agenda'])) ?>
      <div class="modal-body" style="padding:1.5rem;">
        <div class="form-grid">
          <div class="form-section">
            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
            <input type="text" name="tanggal_mulai" class="form-control tanggal" required>
          </div>
          <div class="form-section">
            <label class="form-label">Jam Mulai</label>
            <input type="text" name="jam_mulai" class="form-control waktu">
          </div>
        </div>
        <div class="form-grid mt-3">
          <div class="form-section">
            <label class="form-label">Tanggal Selesai</label>
            <input type="text" name="tanggal_selesai" class="form-control tanggal">
          </div>
          <div class="form-section">
            <label class="form-label">Jam Selesai</label>
            <input type="text" name="jam_selesai" class="form-control waktu">
          </div>
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Lokasi / Tempat <span class="text-danger">*</span></label>
          <input type="text" name="nama_tempat" class="form-control" required placeholder="Contoh: Aula Sekolah">
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Pembicara</label>
          <input type="text" name="pembicara" class="form-control" placeholder="Nama pembicara">
        </div>
        <div class="form-section mt-3">
          <label class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" rows="2" placeholder="Deskripsi jadwal"></textarea>
        </div>
      </div>
      <div class="modal-footer" style="border-top:1px solid var(--border);padding:0.75rem 1.5rem;">
        <button type="button" class="btn btn-secondary-action" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
        <button type="submit" name="simpan" class="btn btn-success-action"><i class="fas fa-save"></i> Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
