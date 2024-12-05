<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 983290;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'book_code', 
                                    'book_stock', 
                                    'book_title', 
                                    'synopsis', 
                                    'category', 
                                    'writer', 
                                    'publisher', 
                                    'publication_year', 
                                    'book_cover', 
                                    'book_cover_img_alt'
                                  ];
    // Dates
    protected $useTimestamps = true;
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

    public function getBuku($kode = null)
    {
        if ($kode == null) {
            return $this->findAll();
        }

        return $this->where(["kode_buku" => $kode]);
    }

    public function saveUpdate($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->update($data, ["kode_buku" => $data['kode_buku']]);
    }

    public function delBuku($kode)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(["kode_buku" => $kode]);
    }

    public function stokUp($kode, $stok)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('buku');
        $builder->set("stok_buku", $stok);
        $builder->where('kode_buku', $kode);
        return $builder->update();
    }

    public function stokDown($kode, $stok)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('buku');
        $builder->set("stok_buku", $stok);
        $builder->where('kode_buku', $kode);
        return $builder->update(); 
    }
}
