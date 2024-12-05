<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Adz;

class AdvModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ad_s';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Adz::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'id_client',
      'campaign',
      'text_ads',
      'ad728x90',
      'ad250x125',
      'ad250x250',
      'ad250x300',
      'ad300x250',
      'ad300x300',
      'ad300x600',
      'ad320x100',
      'ad320x320',
      'ad320x480',
      'ad480x600',
      'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    

    public function getshowAd($id)  //admin show
    {
      return $this
        ->where(['id' => $id])
        ->first();
    }

    public function get728x90Ad($client = false)  //working
    {
      return $this
      ->select('ad728x90')
    //  ->where('id_client', $client)
      ->orderBy('id', 'RANDOM')
      ->first();
    }

    public function get300x600Ad($client = false) // needs to fix
    {
      return $this
      ->select('ad300x600')
    //  ->where('id_client', $client)
    ->where('ad300x600 !=', null)
      ->orderBy('id', 'RANDOM')
      ->first();
    }

    public function getTallSidebarAd($client = false)  // works
    {
      return $this
      ->select('ad300x600 as sideBarAd')
      ->where('ad300x600 !=', '')
      //->where('id_client', $client)
      ->orderBy('id', 'RANDOM')
      ->first();
    }

    public function getSqSidebarAd($client = false)  // works
    {
      return $this
      ->select('ad300x300 as sideBarAd')
      ->where('ad300x300 !=', '')
      //->where('id_client', $client)
      ->orderBy('id', 'RANDOM')
      ->first();
    }

    public function get728Ad()  //ad728x90 etc.
    {
      return $this
        ->select('ad728x90')
        ->where('ad728x90 !=', '') //ad728x90
        ->orderBy('id', 'RANDOM')
        ->first();
    }

    public function getClientAds($client)
    {
      return $this
        ->where(['id_client' => $client])
        ->orderBy('id', 'DESC')
        ->first();
    }
}
