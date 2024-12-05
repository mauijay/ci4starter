<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sub_categories';
    protected $primaryKey       = 'sub_cat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'id_category',
      'sub_cat_name',
      'sub_cat_slug',
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

    public function getCatz()
    {
      return $this->select('sub_categories.sub_cat_id, sub_categories.sub_cat_name, sub_categories.id_category, categories.cat_id, categories.cat_name')->join('categories', 'sub_categories.id_category=categories.cat_id', 'left')->findAll();
    }

    

    public function get_category() 
    {
      $this->select('group_name,GROUP_CONCAT(location_name) AS locations');
      $this->group_by('group_name');
      $this->join->categories();
      
      $query = $this->get();
      if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
              $data[] = $row;
          }
          return $data;
      }
      return false;
  }
}
