<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'orders_id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = 'object';//\App\Entities\order::class;
    protected $useSoftDeletes   = false;
    
    protected $allowedFields    = [
      'user_id',
      'payment_type_id',
      'amount',
      'is_paid',
      'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
    public function myOrders($id)
    {
      return $this
        
        ->select("orders.*, order_details.orderdetails_total as itemTotal, order_details.order_qty as itemS, products.product_image as itemImg, products.product_img_alt as itemImgAlt, products.product_name as productName")                                                          
        ->join('order_details', 'order_details.order_id = orders.orders_id', 'left')
        ->join('products', 'products_id = order_details.product_id', 'left')                            
        ->where('user_id', $id)
        ->findAll();       
    }
}
