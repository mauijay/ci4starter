<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Mail;

class MailModel extends Model
{
    protected $table            = 'mails';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Mail::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      "user_id",
        "queue_id",
        "type",
        "name",
        "reply_to",
        "receiver",
        "subject",
        "text",
        "error",
        "error_retries",
        "sent_at",
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
