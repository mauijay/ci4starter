<?php 
      namespace Admin\Models;
      use CodeIgniter\Model;
      class AdminModel extends Model 
      {
          protected $table = 'Admin';
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