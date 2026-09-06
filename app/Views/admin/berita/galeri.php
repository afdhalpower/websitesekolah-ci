<div class="modal fade" id="modal-galeri">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-images" style="color:var(--blue);"></i> Galeri Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding:1.5rem;">
        <!-- Info Box -->
        <div class="info-box-modern" style="background:rgba(59,130,246,0.06);border:1px solid rgba(59,130,246,0.15);margin-bottom:1rem;">
          <div class="info-box-icon"><i class="fas fa-info-circle" style="color:var(--blue);"></i></div>
          <div class="info-box-content">
            Kelola galeri di <a href="<?= base_url('admin/galeri') ?>" style="color:var(--blue);font-weight:500;">Kelola Galeri</a>. Copy link gambar di bawah untuk digunakan.
          </div>
        </div>

        <!-- Galeri Table -->
        <table class="table-modern" id="galeriListing" style="width:100%;">
          <thead>
            <tr>
              <th width="10%">Gambar</th>
              <th width="70%">Link Gambar</th>
              <th width="20%">Salin</th>
            </tr>
          </thead>
          <tbody id="listGaleri"></tbody>
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
$(document).ready(function(){
  listGaleri();

  var table = $('#galeriListing').dataTable({
    paging: false,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    order: [[ 0, "desc" ]]
  });

  function listGaleri(){
    $.ajax({
      type: "get",
      url: '<?= base_url("admin/galeri/show") ?>',
      async: false,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      success: function(data){
        var html = '';
        for(var i = 0; i < data.length; i++){
          var imgUrl = '<?= base_url("assets/upload/image/") ?>' + data[i].gambar;
          html += '<tr id="'+data[i].id_galeri+'">'+
                  '<td class="text-center"><img src="<?= base_url("assets/upload/image/thumbs/") ?>/'+data[i].gambar+'" class="berita-thumb"></td>'+
                  '<td><small style="font-weight:500;">'+data[i].judul_galeri+'</small><br>'+
                  '<input readonly class="form-control form-control-sm" value="'+imgUrl+'" style="font-size:var(--font-xs);margin-top:0.25rem;"></td>'+
                  '<td class="text-center">'+
                  '<button class="btn btn-primary-action btn-sm btn-copy" data-url="'+imgUrl+'">'+
                  '<i class="fas fa-copy"></i> Salin</button></td>'+
                  '</tr>';
        }
        $('#listGaleri').html(html);
      }
    });
  }

  $(document).on('click', '.btn-copy', function () {
    var url = $(this).data('url');
    navigator.clipboard.writeText(url).then(() => {
      Swal.fire({ icon: 'success', title: 'Tersalin!', text: 'URL berhasil disalin!', timer: 2000, showConfirmButton: false });
    });
  });
});
</script>
