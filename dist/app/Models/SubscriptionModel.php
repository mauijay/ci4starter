<?php

namespace App\Models;

use CodeIgniter\Model;


class SubscriptionModel extends Model
{
    protected $table            = 'subscriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['plan_id', 'client_id', 'user_id', 'status','payment_type','payment_status', 'subs_auth_code'];

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

    public function getMySubscription($id)
    {
      return $this
      ->select([
        'subscriptions.*',
        'subscription_plans.name as plan_name',
        'payment_types.types_name as payment_method_name',
        'subscription_plans.price as subscription_price',
        'subscription_plans.duration as subscription_duration'        
      ])
      ->join('subscription_plans', 'subscription_plans.id = subscriptions.plan_id')
      ->join('payment_types', 'payment_types.types_id = subscriptions.payment_type')
      ->where('client_id', auth()->user()->id)      
      ->where(['subscriptions.id' => $id])
      ->first();
    }
    

    public function getMySubscriptions()
    {
      return $this
      ->select([
        'subscriptions.*',
        'subscription_plans.name as plan_name',
        'clients.client_name',
        'websites.domain_name',
        'payment_types.types_name as payment_method_name',
        'date(billings.valid_from) as valid_from',
        'date(billings.valid_to) as valid_to',
        'billings.price'
      ])
      ->join('subscription_plans', 'subscription_plans.id = subscriptions.plan_id')
      ->join('clients', 'clients.id = subscriptions.client_id')
      ->join('websites', 'websites.subscription_id = subscriptions.id')
      ->join('payment_types', 'payment_types.types_id = subscriptions.payment_type')
      ->join('billings', 'billings.subscription_id = subscriptions.id AND billings.status = "valid"', 'left')
      ->where(['subscriptions.user_id' => auth()->user()->id])
      ->where('user_id', auth()->user()->id)         
      ->findAll();
    }
    
}
