<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductRatingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_ratings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'product_id', 'stars', 'rating', 'comment'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getComicStars($comic_id)
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT AVG(stars) as average_stars FROM comic_ratings WHERE comic_ratings.comic_id=' . $db->escape($comic_id));
        $row = $query->getRow();
        return intval($row->average_stars);
    }

    public function getComicRatings($comic_id)
    {
        $userModel = model('userModel');

        $comicRatings = $this->where('comic_id', $comic_id)->findAll();

        $data['comicRatings'] = array_map(function ($comicRating) use ($userModel) {
            $comicRating->user = $userModel->find($comicRating->user_id);
            return $comicRating;
        }, $comicRatings);

        return $data['comicRatings'];
    }

    public function saveComicRating($comicRating)
    {
        return $this->save($comicRating);
    }

    public function findComicRating($comic_id)
    {
        return $this->where(['user_id' => auth()->id(), 'comic_id' => $comic_id])->first();
    }
    
}
