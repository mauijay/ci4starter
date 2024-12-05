<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'loans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 37129;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['loan_code', 'book_code', 'userid', 'borrow_date', 'return_date', 'loan_status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function updateStts($data, $kode)
    {
        $this->set('peminjaman_status', $data);
        $this->where('kode_peminjaman', $kode);
        return $this->update();
    }

    public function getPeminjamanByUid($uid)
    {
        $this->where('userid', $uid);
        return $this->findAll();
    }

    public function getBukuDikembalikanUser($uid, $s)
    {
        $this->where(['userid' => $uid, 'peminjaman_status' => $s]);
        return $this->findAll();
    }

    public function getByStatus($stts)
    {
        $this->where('peminjaman_status', $stts);
        return $this->findAll();
    }

    public function getByKode($kode)
    {
        $this->where('kode_peminjaman', $kode);
        return $this->first();
    }

    public function monthStat()
    {
        $this->select(['MONTH(tanggal_pinjam) AS bulan', 'COUNT(tanggal_pinjam) AS jml']);
        $this->where('tanggal_pinjam >= NOW() - INTERVAL 1 YEAR');
        $this->groupBy('MONTH(tanggal_pinjam)');
        $q = $this->get();

        return $q->getResultArray();
    }
}
