<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'order_details';
    protected $primaryKey       = 'detail_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'order_id',
      'product_id',
      'product_price',
      'order_qty',
      'orderdetails_total'
    ];

    // Dates
    protected $useTimestamps = true;
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

    public function getReceipt($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this
          ->select("orders_details.*, products.product_name as productName, transactions.sales_tax as tax, orders.status as paidStatus, orders.amount as grandTotal")
          ->join('products', 'products.products_id=orders_details.product_id', 'left')
          ->join('transactions', 'transactions.order_id=orders_details.order_id')
          ->join('orders', 'orders.orders_id=orders_details.order_id')
          ->where(['orders_details.order_id' => $id])
          ->findAll();
        
    }
}
