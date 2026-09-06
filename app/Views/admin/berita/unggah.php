<?php
use App\Libraries\Website;
$this->website = new Website();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Upload Media') ?></title>
  <link rel="icon" href="<?= esc($this->website->icon()) ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/admin-sidebar-modern.css">
  <script src="<?= base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <style>
    body { font-family: 'Inter', sans-serif; background: #f5f6fa; margin: 0; padding: 2rem; }
  </style>
</head>
<body>
  <div style="max-width:900px;margin:0 auto;">
    <!-- Header -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
      <h1 style="font-size:1.5rem;font-weight:700;color:var(--dark,#1e293b);">
        <i class="fas fa-cloud-upload-alt" style="color:var(--green,#22c55e);"></i> Upload Media
      </h1>
      <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary-action">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

    <!-- Upload Zone -->
    <div class="card-modern" style="margin-bottom:1.5rem;">
      <div class="card-modern-body" style="padding:1.5rem;">
        <form action="<?= base_url('admin/media/unggah') ?>" class="upload-zone" id="mediaDropzone">
          <div class="upload-zone-icon"><i class="fas fa-cloud-upload-alt"></i></div>
          <div class="upload-zone-text">Seret & lepas file di sini atau klik untuk mengunggah</div>
          <div class="upload-zone-hint">File: .jpg, .jpeg, .png, .gif, .zip, .rar, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .mp4, .avi, .mkv</div>
        </form>
      </div>
    </div>

    <!-- Media Table -->
    <div class="card-modern">
      <div class="card-modern-header">
        <h5 class="card-modern-title"><i class="fas fa-folder-open"></i> Daftar Media</h5>
      </div>
      <div class="card-modern-body" style="padding:0;">
        <table class="table-modern" id="mediaTable" style="width:100%;">
          <thead>
            <tr>
              <th width="15%">Preview</th>
              <th width="65%">URL</th>
              <th width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/dropzone/min/dropzone.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>

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
      ajax: "<?= base_url('admin/media/show') ?>",
      columns: [
        {
          data: "gambar",
          render: function (data, type, row) {
            if (['jpg','jpeg','png','gif'].includes(row.file_ext)) {
              return '<img src="<?= base_url('assets/upload/file/') ?>' + data + '" class="berita-thumb">';
            } else {
              return '<span style="font-size:var(--font-xs);">' + row.file_ext.toUpperCase() + ' (' + row.file_size + ' MB)</span>';
            }
          }
        },
        {
          data: "gambar",
          render: function (data) {
            return '<input type="text" class="form-control form-control-sm" value="<?= base_url('assets/upload/file/') ?>' + data + '" readonly style="font-size:var(--font-xs);">';
          }
        },
        {
          data: "gambar",
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
</body>
</html>
