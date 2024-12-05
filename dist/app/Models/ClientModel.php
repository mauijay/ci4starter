<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Client;


class ClientModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = Client::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'id',
      'client_name',
      'type',
      'address',
      'city',
      'state',
      'zip',
      'website',
      'website_image',
      'client_logo',
      'main_contact',
      'billing_contact',
      'main_email',
      'main_phone',
      'starred_by',
      'group_id',      
      'owner_id',
      'created_by',
      'client_status',
      'client_migration_date',
      'tax_id_number',
      'disable_online_payment',
      'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
      'id'                      => 'required|is_unique[clients.id]',
      'client_name'             => 'required|string|min_length[4]|max_length[128]',
      'type'                    => 'required',
      'address'                 => 'permit_empty',
      'city'                    => 'permit_empty',
      'state'                   => 'permit_empty',
      'zip'                     => 'permit_empty',
      'website'                 => 'permit_empty',
      'website_image'           => 'permit_empty',
      'client_logo'             => 'permit_empty',
      'main_contact'            => 'permit_empty',
      'billing_contact'         => 'permit_empty',
      'main_phone'              => 'required',
      'main_email'              => 'permit_empty',
      'starred_by'              => 'permit_empty',
      'group_id'                => 'required',
      'owner_id'                => 'permit_empty',
      'created_by'              => 'permit_empty',
      'client_status'           => 'required',
      'client_migration_date'   => 'permit_empty',
      'tax_id_number'           => 'permit_empty',
      'disable_online_payment'  => 'permit_empty',
      'notes'                   => ['permit_empty', 'string', 'max_length[65000]'],      
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;    

  public function getContactsSlider($limit = false)
  {    
    return $this
    ->select("client_name, website, client_logo")
    ->orderBy('id', 'RANDOM')
    ->findAll($limit);      
  }

  public function getrandom($limit)
  {
    return $this
    ->orderBy('id', 'RANDOM')
    ->findAll($limit);
  }

  public function findMyClients()
  {
    return $this
    ->select('id, client_name')
    ->findAll();
  }

  /* ########################################################
    * From here are functions for the API
    #########################################################*/

  public function getAllCustomers()
  {
    $return = [];
    foreach($this->findAll() as $val){
        $return[] = $val->prepareForReturn();
    }
    return $return;
  }  
}
