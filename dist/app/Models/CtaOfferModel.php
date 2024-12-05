<?php

namespace App\Models;

use CodeIgniter\Model;

class CtaOfferModel extends Model
{
    protected $table            = 'cta_offers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'offer_name',
      'offer_btn_text',
      'offer_image',
      'offer_img_alt',
      'offer_filename',
      'offer_desc',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
      'offer_name'              => 'required|string|min_length[4]|max_length[255]',
      'offer_btn_text'          => 'required',
      'offer_image'             => 'required',
      'offer_img_alt'           => 'required',
      'offer_filename'          => 'required',
      'offer_desc'              => ['permit_empty', 'string', 'max_length[65000]']
    ];
    protected $validationMessages   = [
      "offer_name" => [
        "required" => "Please enter a title",
        "max_length" => "{param} maximum characters for the {field}"
      ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
