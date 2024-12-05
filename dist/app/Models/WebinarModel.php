<?php

namespace App\Models;

use CodeIgniter\Model;

class WebinarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'webinars';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'name', 
                                    'webinar_slug', 
                                    'desc', 
                                    'source_person', 
                                    'date', 
                                    'time', 
                                    'cost', 
                                    'webinar_media', 
                                    'poster'
                                  ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getWebinar($slug = false)
    {
        if( $slug == false ){
            return $this->findAll();
        }elseif( strtotime("now") < strtotime($slug) != false ){
            return $this->where(['tanggal' => $slug])->first();    
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getWebinarById($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
