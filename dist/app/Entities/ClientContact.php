<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ClientModel;

class ClientContact extends Entity
{
  protected $datamap = [];
  protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
  protected $casts   = [];
  public $data;

  public function isBillingContact()
  {
    $customerModel = model(ClientModel::class);
    $customer = $customerModel->find($this->customer_id);
    return ($customer->billing_contact == $this->id) ? true : false;
  }

  public function isMainContact()
  {
    $customerModel = model(ClientModel::class);
    $customer = $customerModel->find($this->id);
    return ($customer->main_contact == $this->id) ? true : false;
  }

  public function getCustomerInfo($field)
  {
    if($this->customer_id){
      $customerModel = model(ClientModel::class);
      $customer = $customerModel->find($this->customer_id);
      $val = null;
      if($customer){
          return $customer->{$field};
      }
      return null;
    }
    return null;
  }
}
