<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Comment;

class CommentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'comments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Comment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'id_author',
      'id_post',
      'customer_id',
      'product_id',
      'project_id',
      'invoice_id',
      'website_id',
      'comment_type',
      'comment'      
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}
