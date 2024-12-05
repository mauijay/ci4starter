<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'employee_number',
      'first_name',
      'last_name',
      'email',
      'phone',
      'address',
      'position',
      'join_date',
      'salary',
      'image',
      'added_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

  //  protected $beforeInsert   = ['setUserId'];

    /**
     * Defines the logged in user id in the data array
     *
     * @param array $data
     * @return array
     */
    protected function setUserId(array $data): array
    {

        // Is the user logged in?
        if (!auth()->loggedIn()) {

            throw new Exception('There is no valid session');
        }

        if (!isset($data['data'])) {

            return $data;
        }


        $data['data']['added_by'] = auth()->user()->id;

        return $data;
    }
}