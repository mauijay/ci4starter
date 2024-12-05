<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
//use App\Models\WebsiteModel;
use App\Models\WebsiteTagModel;
//use App\Models\CustomerModel;
use App\Models\ProjectModel;


class Website extends Entity
{
    /**
     * @var array
     */
    protected $datamap = [];

    /**
     * @var string[]
     */
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array
    */
    protected $casts   = [];
    public $data;

    public function removeAllTags()
    {        
      $wtM = model('WebsiteTagModel');    
      return $wtM->removeAllTagsFromWebsite($this->id);
    }

    public function addTagToWebsite($tagId)
    {        
      $wtM = model('WebsiteTagModel');
      return $wtM->addTagToWebsite($tagId, $this->id);
    }

    public function getTags()
    {
      $wtM = model('WebsiteTagModel');
      return $wtM->getTagsForWebsite($this->id);      
    }

    public function hasTag($tagId)
    {
      $wtM = model('WebsiteTagModel');
      return $wtM->checkWebsiteTag($this->id, $tagId);
    }
    
    public function getClientInfo($field)
    {
      if($this->client_id)
      {
        $cM = model('ClientModel');
        $client = $cM->find($this->client_id);
        $val = null;
        if($client){
          return $client->{$field};
        }
        return null;            
      }
      return null;        
    }

    public function getCustomerInfo($field) // original
    {
      if($this->customer_id){
        $customerModel = model(CustomerModel::class);
        $customer = $customerModel->find($this->customer_id);
        $val = null;
        if($customer){
          if($field == 'company'){
            if(empty($customer->{$field})){
              return $customer->contact_lastname . ' ' . $customer->contact_firstname;
            }
          }
          return $customer->{$field};
        }
        return null;          
      }
      return null;
    }

    public function getProjectInfo($field)
    {
        $result = null;
        if($this->project_id){
            $projectModel = model(ProjectModel::class);
            $result = $projectModel->find($this->project_id);
        }
        return $result ? $result->{$field} : null;        
    }

    /* ########################################################
     * Ab hier sind Funktionen für die API
     #########################################################*/
     public function prepareForReturn(){
      $r = model(WebsiteModel::class)->find($this->id);

      $return = [];
      $return['id'] = $r->id;
      $return['assign']['customer'] = $r->customer_id;
      $return['assign']['project'] = $r->project_id ?? null;
      $return['url'] = $r->website_url;
      $return['live'] = $r->website_live;
      $return['installed'] = $r->website_installed;
      $return['notes'] = $r->notes;
      $return['tags'] = [];

      return $return ?? null;
  }

}