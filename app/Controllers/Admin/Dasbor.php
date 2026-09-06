<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Dasbor extends BaseController
{
	public function index()
	{
		// Stats untuk dashboard
		$db = \Config\Database::connect();
		
		$stats = [
			'siswa'     => $db->table('siswa')->where('status_siswa', 'Aktif')->countAllResults(false),
			'berita'    => $db->table('berita')->countAllResults(false),
			'galeri'    => $db->table('galeri')->countAllResults(false),
			'staff'     => $db->table('staff')->countAllResults(false),
			'tagihan'   => $db->table('tagihan')->countAllResults(false),
			'agenda'    => $db->table('agenda')->countAllResults(false),
			'video'     => $db->table('video')->countAllResults(false),
			'client'    => $db->table('client')->countAllResults(false),
			'ekskul'    => $db->table('ekstrakurikuler')->countAllResults(false),
			'fasilitas' => $db->table('fasilitas')->countAllResults(false),
		];

		// Tagihan belum dibayar
		$stats['tagihan_pending'] = $db->table('tagihan')
			->where('status', 'Belum Bayar')
			->countAllResults(false);

		// Siswa per jenjang
		$siswa_per_jenjang = $db->table('siswa')
			->select('j.nama_jenjang, COUNT(*) as jumlah')
			->join('kelas k', 'k.id_kelas = siswa.id_kelas', 'left')
			->join('jenjang j', 'j.id_jenjang = k.id_jenjang', 'left')
			->where('siswa.status_siswa', 'Aktif')
			->groupBy('j.nama_jenjang')
			->get()->getResult();

		$data = [
			'title'              => 'Dasbor Administrator',
			'content'            => 'admin/dasbor/index',
			'stats'              => $stats,
			'siswa_per_jenjang'  => $siswa_per_jenjang,
		];
		return view('admin/layout/wrapper', $data);
	}

	public function panduan()
	{
		$m_download = new \App\Models\Download_model();
		$download   = $m_download->jenis_download('Panduan');

		$data = [
			'title'     => 'Manual dan User Guide',
			'download'  => $download,
			'content'   => 'admin/dasbor/panduan'
		];
		return view('admin/layout/wrapper', $data);
	}
}
