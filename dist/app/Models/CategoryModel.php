<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Category;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Category::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['parent_id','cat_name','cat_slug','cat_img','cat_type','cat_status','cat_md'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
      'cat_type' => [
        'label' => 'Type',
        'rules' => 'required',
        'errors' => ['required' => 'Please select a type!'],
      ],
      'cat_name' => [
          'label' => 'Category',
          'rules' => 'required|is_unique[categories.cat_name]',
          'errors' => ['required' => 'Category Name is required','is_unique' => 'This category has already been taken'],
      ],
      'cat_img' => [
        'label' => 'Image',
        'rules' => 'uploaded[cat_img]|is_image[cat_img]|mime_in[cat_img,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[cat_img,2000]',
        'errors' => [
            'uploaded' => 'Veuillez choisir une photo',
            'is_image' => 'Le format de cet image est inconnu',
            'max_size' => 'La taille ne doit pas dépasser 200 KB',
        ]
      ]
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = true;
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

    public function getcatbyId($id)
    {
      if($id === null){
        return false;
      }
      return $this->where(['id'=> $id])->first();
    }

    public function getCategoryById(int $id): ?Category
    {
        return $this->find($id);
    }

    public function getCatz()
    {
      return $this->select('sub_categories.sub_cat_id, sub_categories.sub_cat_name, categories.id, categories.cat_name')->join('sub_categories', 'sub_categories.id_category=categories.id', 'left')->findAll();
    }

    public function getCatz_old()
    {
      return $this->select('sub_categories.sub_cat_id, GROUP_CONCAT(sub_categories.sub_cat_name) AS subcats , categories.id, categories.cat_name')->join('sub_categories', 'sub_categories.id_category=categories.id', 'left')->findAll();
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

    function getWhere($tabla,$arreglo){
      $query = $this->db->get_where($tabla, $arreglo);
      if($query->num_rows() > 0){
          return $query->result();
      }
      else{
          return null;
      }
  }
}
