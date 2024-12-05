<?php

namespace Blogs\Models;

use CodeIgniter\Model;

class BlogCategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'news_categories';
    // protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = 'object';
        
    protected $allowedFields    = ['product_id', 'category_id'];

    protected $categoryModel;

    public function __construct()
    {
        parent::__construct();
        
        $this->categoryModel = model('categoryModel');
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
    
}
