<?php
namespace App\Models;

use CodeIgniter\Model;

class Tagihan_model extends Model
{
    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    protected $allowedFields = ['id_siswa', 'id_biaya', 'bulan', 'tahun', 'nominal_tagihan', 'status', 'tanggal_bayar', 'bukti_bayar', 'metode_bayar', 'keterangan', 'admin_verifikasi'];

    public function listing($filters = [])
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.nama_siswa, siswa.nis, kelas.nama_kelas, biaya.nama_biaya');
        $builder->join('siswa', 'siswa.id_siswa = tagihan.id_siswa', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'LEFT');
        $builder->join('biaya', 'biaya.id_biaya = tagihan.id_biaya', 'LEFT');

        if (!empty($filters['status'])) {
            $builder->where('tagihan.status', $filters['status']);
        }
        if (!empty($filters['id_kelas'])) {
            $builder->where('siswa.id_kelas', $filters['id_kelas']);
        }
        if (!empty($filters['bulan'])) {
            $builder->where('tagihan.bulan', $filters['bulan']);
        }
        if (!empty($filters['tahun'])) {
            $builder->where('tagihan.tahun', $filters['tahun']);
        }

        $builder->orderBy('tagihan.tahun', 'DESC');
        $builder->orderBy('tagihan.bulan', 'DESC');
        $builder->orderBy('siswa.nama_siswa', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function detail($id_tagihan)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, siswa.nama_siswa, siswa.nis, siswa.telepon_wali, kelas.nama_kelas, biaya.nama_biaya, jenjang.nama_jenjang');
        $builder->join('siswa', 'siswa.id_siswa = tagihan.id_siswa', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'LEFT');
        $builder->join('biaya', 'biaya.id_biaya = tagihan.id_biaya', 'LEFT');
        $builder->join('jenjang', 'jenjang.id_jenjang = siswa.id_jenjang', 'LEFT');
        $builder->where('tagihan.id_tagihan', $id_tagihan);
        return $builder->get()->getRow();
    }

    public function rekap_siswa($id_siswa)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('tagihan.*, biaya.nama_biaya');
        $builder->join('biaya', 'biaya.id_biaya = tagihan.id_biaya', 'LEFT');
        $builder->where('tagihan.id_siswa', $id_siswa);
        $builder->orderBy('tagihan.tahun', 'DESC');
        $builder->orderBy('tagihan.bulan', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function summary_siswa($id_siswa)
    {
        $builder = $this->db->table('tagihan');
        $builder->select('
            COUNT(*) as total_tagihan,
            SUM(CASE WHEN status = "Lunas" THEN nominal_tagihan ELSE 0 END) as total_dibayar,
            SUM(CASE WHEN status = "Belum" THEN nominal_tagihan ELSE 0 END) as total_sisa,
            SUM(nominal_tagihan) as grand_total
        ');
        $builder->where('id_siswa', $id_siswa);
        return $builder->get()->getRow();
    }

    public function cek_duplikat($id_siswa, $bulan, $tahun)
    {
        $builder = $this->db->table('tagihan');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('bulan', $bulan);
        $builder->where('tahun', $tahun);
        return $builder->countAllResults() > 0;
    }

    public function generate($id_tahun, $bulan, $tahun)
    {
        $m_biaya = new Biaya_model();

        $builder = $this->db->table('siswa');
        $builder->select('siswa.*');
        $builder->where('id_tahun', $id_tahun);
        $builder->where('status_siswa', 'Aktif');
        $siswa_list = $builder->get()->getResultArray();

        $generated = 0;
        $skipped = 0;

        foreach ($siswa_list as $siswa) {
            if ($this->cek_duplikat($siswa['id_siswa'], $bulan, $tahun)) {
                $skipped++;
                continue;
            }

            $biaya = $m_biaya->cari_aktif($siswa['id_jenjang'], 'Bulanan');
            if (!$biaya) {
                $skipped++;
                continue;
            }

            $data = [
                'id_siswa'        => $siswa['id_siswa'],
                'id_biaya'        => $biaya->id_biaya,
                'bulan'           => $bulan,
                'tahun'           => $tahun,
                'nominal_tagihan' => $biaya->nominal,
                'status'          => 'Belum',
            ];
            $this->insert($data);
            $generated++;
        }

        return ['generated' => $generated, 'skipped' => $skipped];
    }

    public function bayar($id_tagihan, $data_bayar)
    {
        $data = [
            'status'           => 'Lunas',
            'tanggal_bayar'    => $data_bayar['tanggal_bayar'] ?? date('Y-m-d H:i:s'),
            'bukti_bayar'      => $data_bayar['bukti_bayar'] ?? null,
            'metode_bayar'     => $data_bayar['metode_bayar'],
            'keterangan'       => $data_bayar['keterangan'] ?? null,
            'admin_verifikasi' => $data_bayar['admin_verifikasi'],
        ];
        $this->update($id_tagihan, $data);
    }
}
