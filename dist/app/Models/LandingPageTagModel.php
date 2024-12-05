<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\LpTag;

class LandingPageTagModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'landing_page_tags';
  //protected $primaryKey       = 'id';
  protected $returnType       = LpTag::class;
  protected $allowedFields    = ['lp_id', 'tag_id'];


  public function getTagsForPage($pageId)
  {
    $found = $this->builder()
            ->select('landing_page_tags.*, tags.tag_name, tags.class')
            ->join('tags', 'tags.id = landing_page_tags.tag_id', 'left')
            ->where('landing_page_tags.lp_id', $pageId)
            ->get()->getResultArray();
            
    return $found;
  }

  public function checkPageTag($lpId, $tagId)
  {

    $found = $this->builder()
            ->select('tag_id')
            ->where('lp_id', $lpId)
            ->where('tag_id', $tagId)
            ->get()->getResultArray();
            
    return (bool) $found;
  }

  public function removeAllTagsFromLandingPage($lpId)
  {
    return (bool) $this->db->table('landing_page_tags')->where('lp_id', $lpId)->delete();
  }
  
}