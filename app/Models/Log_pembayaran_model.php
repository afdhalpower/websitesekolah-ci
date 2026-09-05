<?php
namespace App\Models;

use CodeIgniter\Model;

class Log_pembayaran_model extends Model
{
    protected $table = 'log_pembayaran';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_tagihan', 'aksi', 'keterangan', 'admin'];

    public function by_tagihan($id_tagihan)
    {
        $builder = $this->db->table('log_pembayaran');
        $builder->where('id_tagihan', $id_tagihan);
        $builder->orderBy('tanggal', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function tambah($id_tagihan, $aksi, $keterangan = '', $admin = '')
    {
        $data = [
            'id_tagihan'   => $id_tagihan,
            'aksi'         => $aksi,
            'keterangan'   => $keterangan,
            'admin'        => $admin,
        ];
        $this->insert($data);
    }
}
