<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wallets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'user_id',
                                    'amount'
                                  ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo {
      return $this->belongsTo(User::class);
    }

    /**
     * Get the wallet's transactions.
     */
    public function transaction(): MorphMany {
        return $this->morphMany(Transaction::class, 'payable');
    }
    
}
