<?php
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Biaya_model;
use App\Models\Jenjang_model;

class Biaya extends BaseController
{
    public function index()
    {
        $m_biaya   = new Biaya_model();
        $m_jenjang = new Jenjang_model();
        $biaya     = $m_biaya->listing();
        $jenjang   = $m_jenjang->listing();
        $total     = $m_biaya->total();

        // Stats
        $builder      = $this->db->table('biaya');
        $all          = $builder->get()->getResultArray();
        $total_biaya  = count($all);
        $aktif        = count(array_filter($all, fn($b) => $b['status'] === 'Aktif'));
        $non_aktif    = $total_biaya - $aktif;
        $bulanan      = count(array_filter($all, fn($b) => $b['periode'] === 'Bulanan'));
        $tahunan      = count(array_filter($all, fn($b) => $b['periode'] === 'Tahunan'));

        $data = [
            'title'       => 'Master Biaya Pendidikan',
            'biaya'       => $biaya,
            'jenjang'     => $jenjang,
            'content'     => 'admin/biaya/index',
            'total_biaya' => $total_biaya,
            'aktif'       => $aktif,
            'non_aktif'   => $non_aktif,
            'bulanan'     => $bulanan,
            'tahunan'     => $tahunan,
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function tambah()
    {
        $m_jenjang = new Jenjang_model();
        $jenjang   = $m_jenjang->listing();

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id_jenjang'  => 'required',
            'nama_biaya'  => 'required|min_length[3]',
            'nominal'     => 'required|numeric|greater_than[0]',
            'periode'     => 'required|in_list[Bulanan,Tahunan]',
            'tahun_mulai' => 'required|exact_length[4]|is_numeric',
        ])) {
            $m_biaya = new Biaya_model();
            $data = [
                'id_jenjang'    => $this->request->getPost('id_jenjang'),
                'nama_biaya'    => $this->request->getPost('nama_biaya'),
                'nominal'       => $this->request->getPost('nominal'),
                'periode'       => $this->request->getPost('periode'),
                'tahun_mulai'   => $this->request->getPost('tahun_mulai'),
                'tahun_selesai' => $this->request->getPost('tahun_selesai') ?: null,
                'status'        => $this->request->getPost('status') ?? 'Aktif',
            ];
            $m_biaya->insert($data);
            $this->session->setFlashdata('sukses', 'Data biaya telah ditambah');
            return redirect()->to(base_url('admin/biaya'));
        }

        $data = [
            'title'   => 'Tambah Biaya Pendidikan',
            'jenjang' => $jenjang,
            'content' => 'admin/biaya/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function edit($id_biaya)
    {
        $m_biaya   = new Biaya_model();
        $m_jenjang = new Jenjang_model();
        $biaya     = $m_biaya->detail($id_biaya);
        $jenjang   = $m_jenjang->listing();

        if ($this->request->getMethod() === 'POST' && $this->validate([
            'nama_biaya'  => 'required|min_length[3]',
            'nominal'     => 'required|numeric|greater_than[0]',
            'periode'     => 'required|in_list[Bulanan,Tahunan]',
            'tahun_mulai' => 'required|exact_length[4]|is_numeric',
        ])) {
            $data = [
                'id_jenjang'    => $this->request->getPost('id_jenjang'),
                'nama_biaya'    => $this->request->getPost('nama_biaya'),
                'nominal'       => $this->request->getPost('nominal'),
                'periode'       => $this->request->getPost('periode'),
                'tahun_mulai'   => $this->request->getPost('tahun_mulai'),
                'tahun_selesai' => $this->request->getPost('tahun_selesai') ?: null,
                'status'        => $this->request->getPost('status'),
            ];
            $m_biaya->update($id_biaya, $data);
            $this->session->setFlashdata('sukses', 'Data biaya telah diedit');
            return redirect()->to(base_url('admin/biaya'));
        }

        $data = [
            'title'   => 'Edit Biaya: ' . $biaya->nama_biaya,
            'biaya'   => $biaya,
            'jenjang' => $jenjang,
            'content' => 'admin/biaya/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function delete($id_biaya)
    {
        $m_biaya = new Biaya_model();
        $m_biaya->delete($id_biaya);
        $this->session->setFlashdata('sukses', 'Data biaya telah dihapus');
        return redirect()->to(base_url('admin/biaya'));
    }
}
