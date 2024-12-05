<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ClientModel;
use App\Models\CategoryModel;
use App\Models\LandingPageTagModel;

class LandingPage extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];


    public function removeAllTags(){
        
      $lptM = model(LandingPageTagModel::class);
  
      return $lptM->removeAllTagsFromLandingPage($this->id);
    }
   

    public function getTags(){
      $lptM = model(LandingPageTagModel::class);
  
      return $lptM->getTagsForPage($this->id);
    }

    public function hasTag($tagId){
      $lptM = model(LandingPageTagModel::class);

      return $lptM->checkPageTag($this->id, $tagId);
    }

    public function getclientname()
    {
      //  return $this->getname($this->attributes->id);
      //  return $this->getname($this->attributes['client_id']);
      if (! empty($this->attributes['client_id'])) {
        return $this->getname($this->attributes['client_id']);
      }
      return '808 Business Solutions';       
    }

    public function getclientlogo()
    {
      //  return $this->getname($this->attributes->id);
      //  return $this->getname($this->attributes['client_id']);
      if (! empty($this->attributes['client_id'])) {
        return $this->getlogo($this->attributes['client_id']);
      }
      return 'BS_logo.webp';       
    }

    public function getcatname()
    {
      return $this->getcat($this->attributes['id_category']);
    }

    private function getname($id)
    {      
      $cm = model(ClientModel::class);
      $client = $cm->find($id);
      //  if ($client) {
      //      return $client->client_name;
      //  }
      //  return '808 Business Solutions';
      return $client->client_name;
    }

    private function getlogo($id)
    {      
      $cm = model(ClientModel::class);
      $client = $cm->find($id);
      //  if ($client) {
      //      return $client->client_name;
      //  }
      //  return '808 Business Solutions';
      return $client->client_logo;
    }

    private function getcat($id)
    {      
      $catz = model(CategoryModel::class);
      $cat = $catz->find($id);
      if ($cat) {
        return $cat->cat_name;
      }
      return 'No Category selected';      
    }
}
