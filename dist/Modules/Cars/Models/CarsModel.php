<?php 
      namespace Cars\Models;
      use CodeIgniter\Model;
      class CarsModel extends Model 
      {
          protected $table = 'Cars';
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