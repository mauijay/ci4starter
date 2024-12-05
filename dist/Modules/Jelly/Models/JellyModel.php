<?php 
namespace Jelly\Models;
use CodeIgniter\Model;

class JellyModel extends Model 
{
    protected $table = 'Jelly';
    protected $allowedFields = [];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function beforeInsert(array $data) {
        return $data;
    }

    protected function beforeUpdate(array $data) {
        return $data;
    }
}