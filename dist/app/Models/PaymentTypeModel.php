<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentTypeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payment_types';
    protected $primaryKey       = 'types_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'types_name',
                                    'types_description'
                                  ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}
