<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\InvoicePosition;

class InvoicePositionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invoices_position';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = InvoicePosition::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'invoice_id',
      'user_id',
      'title',
      'description',
      'price',
      'price_inkl',
      'multiplication',
      'mwst',
      'unit',
      'notes'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    

    public function getDiverentMwst($invoiceId){
      $found = $this->builder()
          ->select('mwst')
          ->where('invoice_id',$invoiceId)
          ->where('deleted_at =', null)
          ->distinct()
          ->orderBy('mwst')
          ->get()->getResultArray();

      return $found;
    }
}
