<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Chat;

class ChatModel extends Model
{
    protected $table            = 'chats';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Chat::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      "user2_id",
      "user1_id"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAvailableReceivers(){
      $return = [];
      foreach(model('UserModel')->findAll() as $val){
          $search_exists = $this
              ->whereIn('user1_id', [user_id(), $val->id])
              ->whereIn('user2_id', [user_id(), $val->id])
              ->findAll();

          if(!$search_exists AND user_id() != $val->id){
              $return[$val->id] = profile($val->id)->firstname . ' ' . profile($val->id)->lastname;
          }

      }

      return $return;
  }

  public function getChats(){
      $chats = $this
          ->where('user1_id', user_id())
          ->orWhere('user2_id', user_id())
          ->findAll();

      return $chats;
  }

  public function getOtherChatMember($chatId){
      $chat = $this->find($chatId);
      if($chat->user1_id == user_id()){
          return $chat->user2_id;
      } else {
          return $chat->user1_id;
      }

  }
}
