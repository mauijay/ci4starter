<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Poll;

class PollingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pollings';
    protected $primaryKey       = 'poll_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Poll::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['question', 'yes', 'no', 'no_comment', 'status'];

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

    public function pullingDeleteThisLater()
    {
      $PULL = array();
      $result = $this->db->select('*')
      ->from('pulling')
      ->order_by('time_stamp', 'DESC')
      ->limit(1)
      ->get()
      ->row();
      $PULL['question'] = $result->question;
      $PULL['id'] = $result->id;
      return $PULL;
    }

    public function pollingx()
    {
      //
           
    }

    /* $voting_result = $this->db->select("*")
        ->from('pulling')
        ->where('status',1)
        ->order_by('id','DESC')
        ->get()->result();
    */

    public function all()
    {
      return $this->db->table('pollings')->where('status',1)
      ->orderBy('q_id','DESC')->get()->getResult();
    }    

    public function join()
    {
      return $this->db->table('news')
      ->where('news_id >', 90)
      ->where('news_id <', 120)
      ->join('sg_users', 'news.author = sg_users.id')
      ->get()
      ->getResult();
    }

    public function search($search_string)
    {        
      return $this->db->table('news')
      ->like('post_title', $search_string, 'both')
      ->orLike ('body', $search_string, 'both')
      ->join('categories', 'news.category_id=categories.id', 'left')
      ->join('users', 'news.author_id=users.id', 'left')
      ->orderBy('news.id', 'ACS')
      ->get()
      ->getResult();
    }
}
