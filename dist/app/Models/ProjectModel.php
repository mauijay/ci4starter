<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Project;

class ProjectModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Project::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'client_id',
      'status',
      'name',
      'date_offer',
      'date_order',
      'date_finish',
      'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /* ########################################################
  * Ab hier sind Funktionen für die API
  #########################################################*/

  public function getProjectsByCustomer($customerId)
  {
      $return = [];
      $projects = $this->where('client_id', $customerId)->findAll();


      foreach($projects as $val){
          $return[] = $val->prepareForReturn();
      }


      return $return;
  }

  public function getAllProjects()
  {
      $return = [];
      $projects = $this->findAll();


      foreach($projects as $val){
          $return[] = $val->prepareForReturn();
      }


      return $return;
  }
}
