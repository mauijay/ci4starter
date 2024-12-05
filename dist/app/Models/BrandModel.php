<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'brands';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['brand_logo', 'brand_logo_alt', 'brand_name', 'brand_slug', 'brand_desc'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
      
      'brand_name' => 
        [ 
          'label' => 'Brand Name',
          'rules' => 'required|string|min_length[4]|max_length[255]',
          'errors' => [
            'required' => 'Please fill out the Brand Name field'
          ]
        ]      
    ];
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


        
    public function insert_data($data) 
    {
      if($this->insert($data))
      {
          return $this->insertID();
      }
      else
      {
          return false;
      }
    }

    public function getBrandNames()
    {
      return $this
        ->select('brand_name, brand_slug')
        ->findAll();
    }


}
