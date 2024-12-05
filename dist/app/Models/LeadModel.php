<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'leads';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'company_name',
      'first_name',
      'last_name',
      'work_phone',
      'cell_phone',
      'e_mail',
      'website',
      'address',
      'city',
      'state',
      'zip',
      'is_lead',
      'lead_status_id',
      'lead_source_id',
      'last_lead_status',
      'notes',
      'files'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [      
      'company_name'    => 'required|string|min_length[4]|max_length[128]',
      'first_name'      => 'required',
      'last_name'       => 'permit_empty',
      'cell_phone'      => 'required',
      'work_phone'      => 'permit_empty',
      'website'         => 'permit_empty',
      'address'         => 'permit_empty',
      'city'            => 'permit_empty',
      'state'           => 'permit_empty',
      'zip'             => 'permit_empty',
      'e_mail'          => 'required',
      'lead_source_id'  => 'required',
      'lead_status_id'  => 'required',
      'notes'           => 'required|string|max_length[65000]',
      'files'           => 'permit_empty',
    ];
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
}
