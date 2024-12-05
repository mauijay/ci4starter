<?php

namespace App\Entities;
use App\Libraries\Token;
use App\Models\LandingPageModel;

use CodeIgniter\Entity\Entity;

class Subscriber extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function startActivation()
    {
        $token = new Token;
        
        $this->token = $token->getValue();
        
        $this->activation_hash = $token->getHash();
    }
    
    public function activate()
    {
      $this->status = 'subscribed';        
      
      $this->activation_hash = null;
    } 
    
    public function getCampaignOffer()
    {
      //  return $this->getname($this->attributes->id);
      //  return $this->getname($this->attributes['client_id']);
      if (! empty($this->attributes['campaign'])) {
        
        return $this->getoffer($this->attributes['campaign']);
      }
      return '';       
    }

    private function getoffer($id)
    {      
      $lpM = model(LandingPageModel::class);
      /* the Campaign id is the landing page id */
      //$page = $lpM->where([$id, 'id'])
      $page = $lpM->find($id);
      //  if ($client) {
      //      return $client->client_name;
      //  }
      //  return '808 Business Solutions';
      return $page->cta_offer;
    }
    
}
