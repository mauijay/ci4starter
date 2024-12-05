<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\LandingPage;

class LandingPageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'landing_pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = LandingPage::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'user_id',
      'client_id',
      'lp_name',
      'lp_title',
      'lp_slug',
      'lp_cta',
      'lp_image',
      'lp_img_alt',
      'lp_favicon',
      'lp_status',
      'lp_template',
      'lp_views',
      'lp_clicks',
      'id_category',
      'facebook',
      'youtube',
      'twitter',
      'pinterest',
      'phone',
      'email',
      'map',      
      'f_app',
      'g_app',
      'lp_md',
      'lp_key'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getPage($slug = false)
    {
      if ($slug === false) {
        return $this
      //  ->published()
      //  ->join('categories', 'news.id_category=categories.id', 'left')
      //  ->join('users', 'news.id_author=users.id', 'left')
        ->orderBy('client_id', 'desc');
      }
      return $this
      //  ->select("news.*, categories.id as catId, categories.cat_name, users.id as userId, users.avatar, users.username")
      //  ->join('categories', 'news.id_category=categories.id', 'left')
      //  ->join('users', 'news.id_author=users.id', 'left')
        ->where(['lp_slug' => $slug])
        ->first();
    }

}
