<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class WebinarPresenterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'webinar_peserta';
    protected $primaryKey       = 'wp_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['webinar_id', 'user_id', 'is_register'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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

    protected $builder;
    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->builder = $db->table('webinar_peserta');
    }

    public function getWebinarPeserta($webinarId = false, $userId = false)
    {
        $this->builder->select('is_register');
        $this->builder->where('webinar_id', $webinarId);
        $this->builder->where('user_id', $userId);
        $query = $this->builder->get();

        return $query->getRow();
    }
    
    public function registrasiWebinar($webinarId, $userId)
    {
        $data = [
            'webinar_id' => $webinarId,
            'user_id'    => $userId,
            'is_register'=> 1,
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ];
        $this->builder->insert($data);

    }

    public function cancelWebinar($webinarId, $userId)
    {
        $this->builder->delete(['webinar_id' => $webinarId, 'user_id' => $userId]);
    }
}
