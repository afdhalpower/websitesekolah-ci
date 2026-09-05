<?php
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Tagihan_model;
use App\Models\Biaya_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
use App\Models\Log_pembayaran_model;

class Tagihan extends BaseController
{
    public function index()
    {
        $m_tagihan = new Tagihan_model();
        $m_kelas   = new Kelas_model();
        $m_tahun   = new Tahun_model();

        $filters = [
            'status'   => $this->request->getGet('status'),
            'id_kelas' => $this->request->getGet('id_kelas'),
            'bulan'    => $this->request->getGet('bulan'),
            'tahun'    => $this->request->getGet('tahun'),
        ];
        $tagihan = $m_tagihan->listing($filters);
        $kelas   = $m_kelas->listing();
        $tahun   = $m_tahun->listing();

        $data = [
            'title'   => 'Tagihan Pendidikan',
            'tagihan' => $tagihan,
            'kelas'   => $kelas,
            'tahun'   => $tahun,
            'filters' => $filters,
            'content' => 'admin/tagihan/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function bayar($id_tagihan)
    {
        $m_tagihan = new Tagihan_model();
        $m_log     = new Log_pembayaran_model();
        $tagihan   = $m_tagihan->detail($id_tagihan);
        $logs      = $m_log->by_tagihan($id_tagihan);

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'metode_bayar' => 'required|in_list[Cash,Transfer]',
        ])) {
            $admin = $this->session->get('username');
            $bukti = null;

            if (!empty($_FILES['bukti_bayar']['name'])) {
                $file = $this->request->getFile('bukti_bayar');
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'];
                if (!$file->isValid() || !$file->isAllowedType($allowedExt)) {
                    $this->session->setFlashdata('warning', 'Tipe file bukti bayar tidak diizinkan');
                    return redirect()->back();
                }
                if ($file->getSizeByUnit('mb') > 5) {
                    $this->session->setFlashdata('warning', 'Ukuran file maksimal 5MB');
                    return redirect()->back();
                }
                $nama_baru = $file->getRandomName();
                $file->move(WRITEPATH . '../assets/upload/bukti_bayar/', $nama_baru);
                $bukti = $nama_baru;
            }

            $data_bayar = [
                'metode_bayar'     => $this->request->getPost('metode_bayar'),
                'keterangan'       => $this->request->getPost('keterangan'),
                'admin_verifikasi' => $admin,
                'bukti_bayar'      => $bukti,
            ];
            $m_tagihan->bayar($id_tagihan, $data_bayar);
            $m_log->tambah($id_tagihan, 'Verifikasi', 'Pembayaran diterima via ' . $this->request->getPost('metode_bayar'), $admin);

            $this->session->setFlashdata('sukses', 'Pembayaran berhasil diverifikasi');
            return redirect()->to(base_url('admin/tagihan'));
        } else {
            $data = [
                'title'   => 'Bayar Tagihan: ' . $tagihan->nama_siswa,
                'tagihan' => $tagihan,
                'logs'    => $logs,
                'content' => 'admin/tagihan/bayar',
            ];
            echo view('admin/layout/wrapper', $data);
        }
    }

    public function rekap()
    {
        $m_tagihan  = new Tagihan_model();
        $id_siswa   = $this->request->getGet('id_siswa');
        $tagihan    = [];
        $summary    = null;

        $builder = $this->db->table('siswa');
        $builder->select('siswa.*, kelas.nama_kelas, jenjang.nama_jenjang');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'LEFT');
        $builder->join('jenjang', 'jenjang.id_jenjang = siswa.id_jenjang', 'LEFT');
        $builder->orderBy('siswa.nama_siswa', 'ASC');
        $siswa_list = $builder->get()->getResultArray();

        if ($id_siswa) {
            $tagihan = $m_tagihan->rekap_siswa($id_siswa);
            $summary = $m_tagihan->summary_siswa($id_siswa);
        }

        $data = [
            'title'      => 'Rekap Pembayaran Siswa',
            'siswa_list' => $siswa_list,
            'tagihan'    => $tagihan,
            'summary'    => $summary,
            'id_siswa'   => $id_siswa,
            'content'    => 'admin/tagihan/rekap',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function generate()
    {
        $m_tagihan = new Tagihan_model();

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id_tahun' => 'required',
            'bulan'    => 'required|in_list[1,2,3,4,5,6,7,8,9,10,11,12]',
            'tahun'    => 'required|exact_length[4]|is_numeric',
        ])) {
            $result = $m_tagihan->generate(
                $this->request->getPost('id_tahun'),
                $this->request->getPost('bulan'),
                $this->request->getPost('tahun')
            );

            $this->session->setFlashdata('sukses', "Generate selesai: {$result['generated']} tagihan dibuat, {$result['skipped']} dilewati");
            return redirect()->to(base_url('admin/tagihan'));
        } else {
            return redirect()->to(base_url('admin/tagihan'));
        }
    }
}
