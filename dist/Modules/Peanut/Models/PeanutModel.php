<?php 
namespace Peanut\Models;
use CodeIgniter\Model;

class PeanutModel extends Model 
{
    protected $table = 'Peanut';
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