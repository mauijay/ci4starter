<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\BlogTagModel;

/**
 * Class Post
 *
 * Represents a single blog post.
 */
class Post extends Entity
{
    // Added 'publish_at' so we get a Time instance
    // to make it simpler to work with.
    protected $dates = [
        'created_at',
        'updated_at',
        'publish_at'
    ];

    /**
     * Return the URL to this post.
     *
     * @return string
     */
    public function slug_link()
    {
        return site_url('/news/'. $this->slug);
    }

    public function adminLink(?string $postfix = null)
    {
        $url = "/admin/news-edit/{$this->id}";

        if (! empty($postfix)) {
            $url .= "/{$postfix}";
        }

        return trim(site_url($url));
    }

    public function getBody()
    {
        return nl2br($this->attributes['body']);
    }

    public function nextPost()
    {
      if (! empty($this->attributes['id'])) {
        $nextId = $this->attributes['id']+1;
        return $this->getinfo($nextId);
      }
      return '808 BS';
    }
    
    public function prevPost()
    {
      if (! empty($this->attributes['id'])) {
        $prevId = $this->attributes['id']-1;
        return $this->getinfo($prevId);
      }
      return '808 BS';
    }

    private function getinfo($id)
    { 
      //$nextId = $id+1;
      $r = model('BlogModel')->find($id);
      $return = [];
      $return['id'] = $r->id;
      $return['title'] = $r->post_title;
      $return['slug'] = $r->slug;      
      //dd($r);
      
      if ($r) {
        return $return ?? null;
      }
      return 'didnt find contact';      
    }

    /* ******************************* ecm ********************* */

    public function removeAllTags(){
        
      $blogTagModel = model(BlogTagModel::class);
  
      return $blogTagModel->removeAllTagsFromPost($this->id);
  }

  public function addTagToPost($tagId){
      
      $blogTagModel = model(BlogTagModel::class);
  
      return $blogTagModel->addTagToPost($tagId, $this->id);
  }

  public function getTags(){
      $blogTagModel = model(BlogTagModel::class);
  
      return $blogTagModel->getTagsForPost($this->id);
  }

  public function hasTag($tagId){
      $blogTagModel = model(BlogTagModel::class);

      return $blogTagModel->checkPostTag($this->id, $tagId);
  }

}
