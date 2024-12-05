<?php

namespace Blogs\Models;

use CodeIgniter\Model;

class BlogRatingModel extends Model {
  protected $DBGroup = 'default';
  protected $table = 'news_ratings';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;

  protected $returnType = 'object';
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = ['user_id', 'news_id', 'stars', 'rating', 'comment'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  public function getPostStars($post_id)
  {
    $db    = \Config\Database::connect();
    $query = $db->query('SELECT AVG(stars) as average_stars FROM news_ratings WHERE news_ratings.news_id=' . $db->escape($post_id));
    $row   = $query->getRow();
    return intval($row->average_stars);
  }

  public function getPostRatings($post_id)
  {
    $userModel = model('userModel');

    $comicRatings = $this->where('news_id', $post_id)->findAll();

    $data['postRatings'] = array_map(function ($comicRating) use ($userModel) {
      $comicRating->user = $userModel->find($comicRating->user_id);
      return $comicRating;
    }, $comicRatings);

    return $data['postRatings'];
  }

  public function savePostRating($postRating)
  {
    return $this->save($postRating);
  }

  public function findPostRating($post_id)
  {
    return $this->where(['user_id' => auth()->id(), 'news_id' => $post_id])->first();
  }

}
