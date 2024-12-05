<?php

namespace App\Models;
use App\Libraries\Token;
use CodeIgniter\Model;
use App\Entities\Subscriber;

class SubscriberModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'subscribers';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = Subscriber::class;
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'email','name', 'phone', 'campaign', 'client', 'offer_cta', 'source_url', 'section', 'frequency', 'number_of_news', 'payment_status', 'social_share', 'status', 'activation_hash', 'subscribed_at', 'unsubscribed_at'
  ];

  // Dates
  protected $useTimestamps = false;
  // Validation
  protected $validationRules = [
    'email'       => 'required|max_length[254]|valid_email|is_unique[subscribers.email]',
    'campaign'    => 'permit_empty',
    'client'      => 'permit_empty',
    'offer_cta'   => 'permit_empty',
    'source_url'  => 'permit_empty',
    'section'     => 'permit_empty',
    
  ];
  protected $validationMessages = ['email' => ['is_unique' => 'Subscribers.email.is_unique']];
  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = [];
  protected $afterInsert = ['sendEmailToUser'];

  protected function sendEmailToUser(array $data)
  {
      //TODO send email to new user
  } 

  public function findByEmail($email)
  {
    return $this->where('email', $email)->first();
  }

  public function activateByToken($token)
  {
    $token = new Token($token);      
    $token_hash = $token->getHash();      
    $sub = $this->where('activation_hash', $token_hash)->first();
    //dd($sub);             
    if ($sub !== null) {          
      $sub->activate();          
      $this->protect(false)->save($sub);
    //  $this->save($sub);
    //  unset($cart[$input['product_id']]);
    //  unset($cart[$input['product_id']]);                       
    }
  }
  
  

  function subscribeAction_model($Blogger_mail,$Blogger_name)
  {
   
    //$sql = "insert into subscribersmaster values (?,?)";    
    //$query = $this->db->query($sql,array($Blogger_mail,$_SESSION['email'])); 

    // $sql  = "select subscriber_email from subscribersmaster where email = ?";
    // $query = $this->db->query($sql,array($Blogger_mail));

    //return $query->num_rows();

    // if($query->num_rows()==0)
    // {
     $sql1 = "Insert into subscribersmaster values(?,?)";
 
    $query1 = $this->db->query($sql1,array($Blogger_mail,$this->session->userdata('email')));


    // }

    //else
    // {
     
    //return 3;
    //    $sql2 = "update user_subscribers set subscribersList = array_append(subscribersList, ?)
    //where email = ?";
 
    //$query2 = $this->db->query($sql2,array($_SESSION['email'],$Blogger_mail));


    // }

     
    if($this->db->affected_rows()>0)
   {
    return true;
   }
   else
     return false;


     
  }

  function subscribeStatus_check($Blogger_mail)
  {
    
    $sql =  "select * from subscribersmaster where email = ? and subscriber_email = ?";
    $query = $this->db->query($sql,array($Blogger_mail,$this->session->userdata('email')));

    if($query->result())
    { 
      return false;
    }

  else
  {
    return true;
  } 
  }

  function sendMailtoSubscribers($data)
  {
    
    //$sql = "Select subscribersList from user_subscribers where email = ?";
    // $query = $this->db->query($sql,array($_SESSION['email']));

    $sql = "Select subscriber_email from subscribersmaster where email = ?";
    $query = $this->db->query($sql,array($this->session->userdata('email')));

    
    $sql2 = "Select * from usermaster where email = ?";
    $query2 = $this->db->query($sql2,array($this->session->userdata('email')));

    /////////////////////////



              $config['protocol']    = 'smtp';

              $config['smtp_host']    = 'ssl://smtp.gmail.com';

              $config['smtp_port']    = '465';

              $config['smtp_timeout'] = '7';

              $config['smtp_user']    = 'aniket9304@gmail.com';

              $config['smtp_pass']    = 'alexandersupertramp';

              $config['charset']    = 'utf-8';

              $config['newline']    = "\r\n";

              $config['mailtype'] = 'text'; // or html

              $config['validation'] = TRUE; // bool whether to validate email or not      

              $this->email->initialize($config);


            
              //$this->email->to('saurabh134741@gmail.com');

        
              
            


    ///////////////////////////////
      
            //  $config['validation'] = TRUE; // bool whether to validate email or not     

              //return $query->result_array();
        //    $q_result = $query->result_array()[0];

          //$q_result = explode(',',$q_result);
          //return $q_result;
              
            $i = 0;
            
          //  $q = array();
        
            //return $q_result;


            foreach ($query->result() as $row) {
              
              $this->email->from('aniket9304@gmail', 'NAVREAD BLOG');
              //$this->email->to();
              $this->email->to($row->subscriber_email);

              $this->email->subject('NAVREAD BLOG FEED');
              $this->email->message($query2->row()->fullname.' has published a new blog "'.$data['blogname'].'". You may want to read it.'); 
            
            $this->email->send();
            $i++;

            }
        

  }
}
