<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ClientContactModel;

class Client extends Entity
{
  protected $datamap = [];

  protected $dates   = [
      'created_at',
      'updated_at',
      'deleted_at',
  ];

  protected $casts   = [];
  public $data;
  public $contact =[];
  public $billingContact = [];
  public $mainContact = [];
  public $contacts = [];

  public function getcontactName()
  {
   //dd($this->attributes['main_contact']);
    if (! empty($this->attributes['main_contact'])) {
      return $this->getname($this->attributes['main_contact']);
    }
    return '808 BS';
  }

  private function getname($id)
  {      
    $ccm = model(ClientContactModel::class);
    $contact = $ccm->find($id);
    //dd($contact);
    if ($contact) {
        return $contact->firstname;
    }
    return 'didnt find contact';
    
  }

  public function mainContact()
  {
    $ccM = model(ClientContactModel::class);
    $this->mainContact = $ccM->find($this->main_contact);
    return $this->mainContact;
  }

  public function billingContact()
  {
    $ccm = model(ClientContactModel::class);
    $this->billingContact = $ccm->find($this->billing_contact);

    return $this->billingContact;
  }

  public function allContacts()
  {
    $ccm = model(ClientContactModel::class);
    $this->contacts = $ccm->where('id', $this->id)->findAll();

    return $this->contacts;
  }

  public function isMainContact()
  {
    return (bool)$this->main_contact;
  }

  

  /* ########################################################
     * Ab hier sind Funktionen für die API
     #########################################################*/
     public function prepareForReturn(){
      $r = model('CustomerModel')->find($this->id);

      $return = [];
      $return['id'] = $r->id;
      $return['status'] = $r->status;
      $return['addressnumber'] = $r->addressnumber;
      $return['name'] = $r->customername;
      $return['street'] = $r->street;
      $return['postcode'] = $r->postcode;
      $return['city'] = $r->city;
      $return['mail'] = $r->mail;
      $return['phone'] = $r->phone;
      $return['notes'] = $r->notes;
      $return['main_contact'] = $r->main_contact;
      $return['billing_contact'] = $r->billing_contact;

      return $return ?? null;
  }

}
