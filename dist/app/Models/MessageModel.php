<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Message;

class MessageModel extends Model
{
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Message::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      "user_id",
      "message",
      "is_read",
      "chat_id"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getMessagesOfChat($chatId, $mask_as_read = false)
    {
        $messages = $this
            ->where('chat_id', $chatId)
            ->findAll();

        if($mask_as_read){
            foreach($messages as $message){
                if($message->user_id != user_id()){
                    $message->is_read = true;
                    model('MessageModel')->save($message);
                }
            }

            $messages = $this
                ->where('chat_id', $chatId)
                ->findAll();
        }


        return $messages;

    }

    public function getNewMessagesOfCurrentUser()
    {
        $chatIds = [];
        $chats = model('ChatModel')
            ->whereIn('user1_id', [user_id()])
            ->orWhereIn('user2_id', [user_id()])
            ->findAll();

        if(!$chats){
            return [];
        }
        foreach($chats as $chat){
            $chatIds[] = $chat->id;
        }

        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->whereIn('chat_id', $chatIds);
        $builder->whereNotIn('user_id', [user_id()]);
        $builder->where('is_read', null);
        $builder->orderBy('created_at');
        $query = $builder->get();

        return $query->getResult();

        return $messages;

    }
}
