<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ClientModel;

class Adz extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getClientName()
    {
      //  return $this->getname($this->attributes->id);
      //  return $this->getname($this->attributes['client_id']);
      if (! empty($this->attributes['id_client'])) {
        return $this->getname($this->attributes['id_client']);
      }
      return 'I dont know';       
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
}
