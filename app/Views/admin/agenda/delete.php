<button class="btn btn-danger-action btn-sm" data-toggle="modal" data-target="#modal-hapus-<?= esc($i) ?>" title="Hapus">
  <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="modal-hapus-<?= esc($i) ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius:var(--radius-lg);overflow:hidden;">
      <div class="modal-header" style="background:var(--card);border-bottom:1px solid var(--border);padding:1rem 1.5rem;">
        <h5 class="modal-title" style="font-size:1rem;font-weight:600;"><i class="fas fa-exclamation-triangle" style="color:var(--red);"></i> Konfirmasi Hapus</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body" style="padding:1.5rem;">
        <p style="font-size:var(--font-sm);color:var(--text);margin:0;">Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
      </div>
      <div class="modal-footer" style="border-top:1px solid var(--border);padding:0.75rem 1.5rem;">
        <button type="button" class="btn btn-secondary-action" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
        <a href="<?= base_url('admin/agenda/delete/'.$agenda['id_agenda']) ?>" class="btn btn-danger-action"><i class="fas fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>
