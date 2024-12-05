<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\ClientContact;

class ClientContactModel extends Model
{
    protected $table            = 'clients_contacts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ClientContact::class;
    //protected $useSoftDeletes = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
      'firstname',
      'lastname',
      'workphone',
      'cellphone',
      'mail',
      'type'
    ];

    // Dates
    protected $useTimestamps = true;
    //protected $dateFormat = 'int';
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
