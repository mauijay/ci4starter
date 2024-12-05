<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\WebsiteTag;

class WebsiteTagModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'websites_tags';
    //protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = WebsiteTag::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'tag_id',
      'id_website'
    ];    

    public function addTagToWebsite($tagId, $websiteId)
    {        
      $data = [
        'tag_id'     => (int) $tagId,
        'id_website' => (int) $websiteId
      ];
      return (bool) $this->insert($data);
    }


    public function removeAllTagsFromWebsite($websiteId)
    {
      return (bool) $this->where('id_website', $websiteId)->delete();
    }

    public function getTagsForWebsite($websiteId)
    {
      $found = $this
                ->select('websites_tags.*, tags.tag_name, tags.class')
                ->join('tags', 'tags.id = websites_tags.tag_id', 'left')
                ->where('websites_tags.id_website', $websiteId)
                ->get()->getResultArray();                
      return $found;
    }

    public function checkWebsiteTag($websiteId, $tagId)
    {
      $found = $this
                ->select('tag_id')
                ->where('website_id', $websiteId)
                ->where('tag_id', $tagId)
                ->get()->getResultArray();                
      return (bool) $found;
    }
}
