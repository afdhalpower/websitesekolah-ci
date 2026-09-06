<div class="modal fade" id="modal-media">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-cloud-upload-alt" style="color:var(--green);"></i> Unggah & Kelola Media</h5>
        <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding:1.5rem;">
        <!-- Upload Area -->
        <form action="<?= base_url('admin/media/unggah') ?>" class="upload-zone" id="mediaDropzone">
          <div class="upload-zone-icon"><i class="fas fa-cloud-upload-alt"></i></div>
          <div class="upload-zone-text">Seret & lepas file di sini atau klik untuk mengunggah</div>
          <div class="upload-zone-hint">File: .jpg, .jpeg, .png, .gif, .zip, .rar, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .mp4, .avi, .mkv</div>
        </form>

        <!-- Media Table -->
        <table class="table-modern mt-3" id="mediaTable" style="width:100%;">
          <thead>
            <tr>
              <th width="10%">Preview</th>
              <th width="70%">URL</th>
              <th width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="modal-footer" style="border-top:1px solid var(--border);padding:0.75rem 1.5rem;">
        <button type="button" class="btn btn-secondary-action" data-dismiss="modal">
          <i class="fas fa-times"></i> Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<script>
Dropzone.options.mediaDropzone = {
  paramName: "file",
  maxFilesize: 24,
  acceptedFiles: ".jpg,.jpeg,.png,.gif,.zip,.rar,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.mp4,.avi,.mkv",
  success: function () {
    $('#mediaTable').DataTable().ajax.reload();
  }
};

$(document).ready(function () {
  var table = $('#mediaTable').DataTable({
    autoWidth: false,
    ajax: "<?= base_url('admin/media/show') ?>",
    columns: [
      {
        data: "gambar",
        width: "10%",
        render: function (data, type, row) {
          if (['jpg', 'jpeg', 'png', 'gif'].includes(row.file_ext)) {
            return '<img src="<?= base_url('assets/upload/file/') ?>' + data + '" class="berita-thumb">';
          } else {
            return '<span style="font-size:var(--font-xs);">' + row.file_ext.toUpperCase() + ' (' + row.file_size + ' MB)</span>';
          }
        }
      },
      {
        data: "gambar",
        width: "70%",
        render: function (data) {
          return '<input type="text" class="form-control form-control-sm" value="<?= base_url('assets/upload/file/') ?>' + data + '" readonly style="font-size:var(--font-xs);">';
        }
      },
      {
        data: "gambar",
        width: "20%",
        render: function (data) {
          return '<button class="btn btn-primary-action btn-sm btn-copy" data-url="<?= base_url('assets/upload/file/') ?>' + data + '"><i class="fas fa-copy"></i> Salin</button>';
        }
      }
    ]
  });

  $(document).on('click', '.btn-copy', function () {
    var url = $(this).data('url');
    navigator.clipboard.writeText(url).then(() => {
      Swal.fire({ icon: 'success', title: 'Tersalin!', text: 'URL berhasil disalin!', timer: 2000, showConfirmButton: false });
    });
  });
});
</script>
