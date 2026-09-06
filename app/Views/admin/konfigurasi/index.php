<?php
$url_sekolah = base_url('admin/konfigurasi/sekolah');
$url_banner = base_url('admin/konfigurasi/banner');
$url_logo = base_url('admin/konfigurasi/logo');
$url_icon = base_url('admin/konfigurasi/icon');
$url_login = base_url('admin/konfigurasi/login');
$url_email = base_url('admin/konfigurasi/email');
$url_seo = base_url('admin/konfigurasi/seo');
$url_pendaftaran = base_url('admin/konfigurasi/pendaftaran');
?>

<div class="page-header-modern">
    <div>
        <h5 class="page-title">Konfigurasi Website</h5>
        <p class="page-subtitle">Pengaturan seluruh komponen website sekolah</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <a href="<?= $url_sekolah ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#2563eb,#3b82f6);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-school" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Informasi Sekolah</h6>
                    <small style="color:var(--gray);">Nama, alamat, yayasan, akreditasi, tanah & bangunan</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_banner ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#7c3aed,#8b5cf6);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-image" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Banner & About Us</h6>
                    <small style="color:var(--gray);">Banner website, tentang, ringkasan, link video</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_logo ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#059669,#10b981);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-palette" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Logo Website</h6>
                    <small style="color:var(--gray);">Upload dan ganti logo utama website</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_icon ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#ea580c,#f97316);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-icons" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Icon Website</h6>
                    <small style="color:var(--gray);">Favicon / icon browser website</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_login ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#dc2626,#ef4444);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-sign-in-alt" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Background Login</h6>
                    <small style="color:var(--gray);">Gambar latar halaman login admin</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_email ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#0891b2,#06b6d4);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-envelope" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Pengaturan Email</h6>
                    <small style="color:var(--gray);">Konfigurasi SMTP untuk pengiriman email</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_seo ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#ca8a04,#eab308);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-search" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">SEO & Meta</h6>
                    <small style="color:var(--gray);">Keywords, meta tag, Facebook Pixel, Google Analytics</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= $url_pendaftaran ?>" class="text-decoration-none">
            <div class="card-modern h-100">
                <div class="card-modern-body text-center py-4">
                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#7c3aed,#a855f7);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="fas fa-user-plus" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                    <h6 style="font-weight:600;color:var(--dark);margin-bottom:0.3rem;">Pendaftaran Online</h6>
                    <small style="color:var(--gray);">Aktifkan/deaktifkan fitur PPDB online</small>
                </div>
            </div>
        </a>
    </div>
</div>
