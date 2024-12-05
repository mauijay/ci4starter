<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingPageTemplateModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'landing_page_templates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['t_name', 't_body'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //
    public function findTemplates()
    {
      return $this
      ->select('landing_page_templates.t_name')
      ->findAll();
    }
    
}
