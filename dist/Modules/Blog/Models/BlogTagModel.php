<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\PostTag;

class BlogTagModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'news_tags';
    protected $primaryKey       = 'id';
    protected $returnType       = PostTag::class;
    protected $allowedFields    = ['news_id', 'tag_id'];


    public function addTagToPost($tagId, $newsId)
    {        
      $data = [
          'tag_id'  => (int) $tagId,
          'news_id' => (int) $newsId
      ];

      return (bool) $this->insert($data);
    }

    public function removeAllTagsFromPost($newsId)
    {
      return (bool) $this->where('news_id', $newsId)->delete();
    }

    public function getTagsForPost($newsId)
    {
      $found = $this->builder()
              ->select('news_tags.*, tags.tag_name')
              ->join('tags', 'tags.tags_id = news_tags.tag_id', 'left')
              ->where('news_tags.news_id', $newsId)
              ->get()->getResultArray();
              
      return $found;
    }

    public function checkPostTag($newsId, $tagId)
    {
      $found = $this
              ->select('tag_id')
              ->where('news_id', $newsId)
              ->where('tag_id', $tagId)
              ->get()->getResultArray();
              
      return (bool) $found;
    }

    /*

    protected $categoryModel;

    public function __construct()
    {
        parent::__construct();
        
        $this->tagModel = model('tagModel');
    }

    public function getComicCategories($comic_id)
    {
        $comic_categories = $this->where(compact('comic_id'))->findAll();

        $data['categories'] = array_filter($comic_categories, function ($comic_category) {
            $category = $this->categoryModel->findCategoryById($comic_category->category_id);

            if ($category) {
                $comic_category->name = $category->name;
                return $comic_category;
            }
        });

        return $data['categories'];
    }

    public function getComicCategoriesWithDeleted($comic_id)
    {
        $comic_categories = $this->where(compact('comic_id'))->findAll();

        $data['categories'] = array_map(function ($comic_category) {
            $comic_category->name = $this->categoryModel->findCategoryWithDeletedById($comic_category->category_id)->name;
            return $comic_category;
        }, $comic_categories);

        return $data['categories'];
    }

    public function saveComicCategory($comicCategory)
    {
        return $this->save($comicCategory);
    }

    public function findComicCategories($comic_id)
    {
        $comic_categories = $this->where(compact('comic_id'))->findAll();

        $data['categories'] = array_map(function ($comic_category) {
            $comic_category = $this->categoryModel->findCategoryWithDeletedById($comic_category->category_id);

            if ($comic_category->deleted_at !== null) {
                $comic_category->name = $comic_category->name;
                return $comic_category;
            }
        }, $comic_categories);

        $data['categories'] = array_filter($data['categories']);

        return empty($data['categories']) ? NULL : $data['categories'];
    }
    */
    
}
