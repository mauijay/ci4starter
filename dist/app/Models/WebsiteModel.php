<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Website;

class WebsiteModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'websites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Website::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'client_id',
      'id_project',
      'subscription_id',
      'domain_name',
      'website_url',
      'website_image',
      'website_installed',
      'website_live',
      'notes' 
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAllWebsites(){
      $return = [];

      foreach($this->findAll() as $val){
          $return[] = $val->prepareForReturn();
      }

      return $return;
  }

  /* ########################################################
  * Ab hier sind Funktionen für die API
  #########################################################*/

  public function getWebsitesByCustomer($customerId){
      $return = [];
      $websites = $this->where('client_id', $customerId)->findAll();


      foreach($websites as $val){
          $return[] = $val->prepareForReturn();
      }


      return $return;
  }
}
