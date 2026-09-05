<?php
namespace App\Models;

use CodeIgniter\Model;

class Biaya_model extends Model
{
    protected $table = 'biaya';
    protected $primaryKey = 'id_biaya';
    protected $allowedFields = ['id_jenjang', 'nama_biaya', 'nominal', 'periode', 'tahun_mulai', 'tahun_selesai', 'status'];

    public function listing()
    {
        $builder = $this->db->table('biaya');
        $builder->select('biaya.*, jenjang.nama_jenjang');
        $builder->join('jenjang', 'jenjang.id_jenjang = biaya.id_jenjang', 'LEFT');
        $builder->orderBy('biaya.id_biaya', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function detail($id_biaya)
    {
        $builder = $this->db->table('biaya');
        $builder->select('biaya.*, jenjang.nama_jenjang');
        $builder->join('jenjang', 'jenjang.id_jenjang = biaya.id_jenjang', 'LEFT');
        $builder->where('biaya.id_biaya', $id_biaya);
        return $builder->get()->getRow();
    }

    public function cari_aktif($id_jenjang, $periode = 'Bulanan')
    {
        $builder = $this->db->table('biaya');
        $builder->where('id_jenjang', $id_jenjang);
        $builder->where('periode', $periode);
        $builder->where('status', 'Aktif');
        return $builder->get()->getRow();
    }

    public function listing_aktif()
    {
        $builder = $this->db->table('biaya');
        $builder->select('biaya.*, jenjang.nama_jenjang');
        $builder->join('jenjang', 'jenjang.id_jenjang = biaya.id_jenjang', 'LEFT');
        $builder->where('biaya.status', 'Aktif');
        $builder->orderBy('jenjang.nama_jenjang', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function total()
    {
        $builder = $this->db->table('biaya');
        return $builder->countAllResults();
    }
}
