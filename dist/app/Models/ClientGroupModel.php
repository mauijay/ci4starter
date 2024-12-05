<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientGroupModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'client_groups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = 'object';
   
    protected $allowedFields    = ['cg_title', 'deleted'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}
