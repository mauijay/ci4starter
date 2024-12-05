<?php
namespace Blogs\Models;

use Blogs\Entities\Post;
use CodeIgniter\Model;
use Faker\Generator;

class BlogModel extends Model {
  protected $DBGroup = 'default';
  protected $table = 'news';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $insertID = 0;
  protected $returnType = Post::class;
  protected $useSoftDeletes = false;
  protected $protectFields = true;
  protected $allowedFields = ['post_title', 'slug', 'short_title', 'lead', 'body', 'id_author', 'id_category', 'id_tags', 'id_comments', 'id_ebook', 'post_img', 'post_img_alt', 'post_img_credit', 'related_vid', 'md', 'keyword', 'reader_hits', 'post_status', 'like', 'unlike', 'stars', 'publish_at'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  // Validation
  protected $validationRules = [

    'id_category' => 'required',
    'post_title' =>
      [
        'label' => 'Title',
        'rules' => 'required|string|min_length[4]|max_length[128]',
        'errors' =>
          [
            'required' => 'Please fill out the post title field',
            //'min_length'  => 'Supplied value ({value}) for {field} must have at least {param} characters.',
            'min_length' => 'Your {field} is too short. You want to get hacked?',
            "max_length" => "{param} maximum characters for the {field}"
          ]
      ],
    'body' =>
      [
        'label' => 'Blog Body',
        'rules' => 'required|string|min_length[4]|max_length[128000]',
        'errors' =>
          [
            'required' => 'All Blog Posts must have {field} provided, thanks dumbass'
          ]
      ],
    'image' =>
      [
        'label' => 'Image File',
        'rules' =>
          [
            'uploaded[image]',
            'is_image[image]',
            'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
            'max_size[image,4096]'
          ],
        'errors' => [
          'uploaded' => 'Please choose a photo',
          'is_image' => 'The format of this image is unknown',
          'mime_in' => 'We can only accept gif, jpg, png and webp, Thanks',
          'max_size' => 'Size should not exceed 4 MB'
        ]
      ],
    'post_status' => 'required',
    'slug' => 'required',
    'short_title' => 'required',
    'lead' => 'required',
    'post_img_credit' => 'required',
    'related_vid' => 'permit_empty',
    'post_img_alt' => 'required',
    'md' => 'required',
    'id_ebook' => 'required',
    'id_author' => 'permit_empty',
    'reader_hits' => 'permit_empty',
    'like' => 'permit_empty',
    'unlike' => 'permit_empty',
    'stars' => 'permit_empty',
    'publish_at' => 'permit_empty',
  ];
  protected $validationMessages = [
    "post_title" => [
      "required" => "Please enter a title",
      "max_length" => "{param} maximum characters for the {field}"
    ]
  ];
  protected $skipValidation = true;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  //  protected $beforeInsert   = ['setUserId'];
  protected $beforeUpdate = [];


  protected $categoryModel;
  protected $blogCategoryModel;
  protected $blogRatingModel;

  public function __construct()
  {
    parent::__construct();

    $this->categoryModel     = model('categoryModel');
    $this->blogCategoryModel = model('blogCategoryModel');
    $this->blogRatingModel   = model('blogRatingModel');
  }

  /**
   * Defines the logged in user id in the data array
   *
   * @param array $data
   * @return array
   */
  protected function setUserId(array $data): array
  {

    // Is the user logged in?
    if (!auth()->loggedIn()) {

      throw new Exception('There is no valid session');
    }

    if (!isset($data['data'])) {

      return $data;
    }


    $data['data']['id_author'] = auth()->user()->id;

    return $data;
  }

  public function search($keyword)
  {
    //$builder->like('title', 'match');
    //$builder->orLike('body', $match);   
    return $this->like('post_title', $keyword)->orLike('keyword', $keyword);
  }


  /**
   * Filters any future queries to only include published posts.
   *
   * @return \CodeIgniter\Database\BaseBuilder
   */
  public function published()
  {
    return $this->where('publish_at <=', date('Y-m-d H:i:s'));
  }

  /**
   * Generate a set of fake data for this post.
   *
   * @param Generator $faker
   *
   * @return array
   */


  /** my old shit before i read Foundations, all logic done in the model */

  public function getNews($slug = false)
  {
    if ($slug === false) {
      return $this
        ->published()
        ->join('categories', 'news.id_category=categories.id', 'left')
        ->join('users', 'news.id_author=users.id', 'left')
        ->orderBy('news.id', 'desc');
    }
    return $this
      ->select("news.*, categories.id as catId, categories.cat_name, users.id as userId, users.avatar, users.username")
      ->join('categories', 'news.id_category=categories.id', 'left')
      ->join('users', 'news.id_author=users.id', 'left')
      ->where(['slug' => $slug])
      ->first();
  }

  public function getAdminList()
  {
    return $this
      ->select("news.id, news.post_title, news.slug, news.post_img, news.publish_at, news.reader_hits, categories.cat_name")
      ->join('categories', 'news.id_category=categories.id', 'left')
      ->findAll();
  }

  public function getFeaturedNews($catId = false)
  {
    if ($catId === false) {
      return $this
        ->where('post_status', 'featured')
        ->join('categories', 'news.id_category=categories.id', 'left')
        ->join('users', 'news.id_author=users.id', 'left')
        ->orderBy('news.id', 'RANDOM')
        //->findAll($limit);
        ->first();
    }
    return $this
      ->where('post_status', 'featured')
      ->join('categories', 'news.id_category=categories.id', 'left')
      ->join('users', 'news.id_author=users.id', 'left')
      ->where(['id_category' => $catId])
      ->first();
  }

  public function getPopularNews($limit = 3)
  {
    return $this
      ->select("news.post_title, news.slug as newsSlug, news.post_img, news.post_img_alt, news.short_title, news.body, news.stars, news.reader_hits, news.created_at, categories.cat_name, categories.color as catcolor")
      ->join('categories', 'news.id_category=categories.id', 'left')
      ->orderBy('reader_hits', 'desc')
      ->findAll($limit);
  }

  public function getTop3ByCatNews($catId)
  {
    return $this
      ->select("news.short_title, news.slug as news3Slug, news.body, news.post_status, categories.cat_name, users.avatar, users.username")
      ->join('categories', 'news.id_category=categories.id', 'left')
      ->join('users', 'news.id_author=users.id', 'left')
      ->where('id_category', $catId)
      ->where('post_status !=', 'featured')
      //  ->orderBy('reader_hits', 'desc')
      ->orderBy('news.id', 'RANDOM')
      ->findAll(3);
  }

  public function findPostBySlug($slug)
  {
    $post = $this->where('slug', $slug)->first();

    if ($post) {
      $post->type          = $this->categoryModel->findTypeById($post->type_id);
      $post->categories    = $this->comicCategoryModel->getComicCategories($post->id);
      $post->ratings       = $this->comicRatingModel->getComicRatings($post->id);
      $post->average_stars = $this->comicRatingModel->getComicStars($post->id);
    }

    return $post;
  }

  public function getPagination($perPage, $group = 'default', $totalPage = null, $segment = 3)
  {
    
    $posts = $this->getNews()->paginate($perPage, $group, $totalPage, $segment);
    
    $data['posts'] = array_map(function ($post) {
      $post->ratings       = $this->blogRatingModel->getPostRatings($post->id);
      $post->average_stars = $this->blogRatingModel->getPostStars($post->id);
      return $post;
    }, $posts);

    return $data['posts'];
  }

  public function getPagination2($perPage, $group = 'default', $totalPage = null, $segment = 4)
  {
    $posts = $this
      ->select('news.*, categories.cat_name, users.username')
      ->join('categories', 'news.id_category=categories.id', 'left')
      ->join('users', 'news.id_author=users.id', 'left')
      ->orderBy('news.id', 'desc')
      ->findAll();

      $data['posts'] = array_map(function ($post) {
        $post->ratings       = $this->blogRatingModel->getPostRatings($post->id);
        $post->average_stars = $this->blogRatingModel->getPostStars($post->id);
        return $post;
      }, $posts);

            

        $data =[
            'posts'  => $this->paginate($perPage),
            
        ];   


    

    return $data['posts'];
  }

  public function fake(Generator &$faker)
  {
    $deletedAt  = [null, null, null, null, date('Y-m-d H:i:s')];
    $books      = [null, null, null, null, null, [rand(1, 6)]];
    $postStatus = ['shown', 'archived'];
    return [
      'post_title' => $faker->words(4, true),
      'short_title' => $faker->words(3, true),
      'slug' => $faker->slug(),
      'lead' => $faker->paragraph(3),
      'body' => $faker->realText(200) . "\n\n" . $faker->realText(200),

      'id_author' => $faker->randomElement(['1', '2', '3', '4', '5']),
      'id_category' => rand(1, 8), // $faker->randomElement(['1','2']),
      'id_tags' => rand(1, 8),
      'id_comments' => rand(1, 8),
      'id_ebook' => $books[rand(0, 5)],
      'post_img' => 'news-1.webp',
      'post_img_alt' => $faker->realText(15),
      'thumbnail' => 'Post_1.jpg',

      'related_vid' => 'https://www.youtube.com/watch?v=_eW8oeY0bpk',
      'post_tags' => 'tags',
      'md' => $faker->words(10, true),
      'reader_hits' => rand(99, 2500),
      //  'post_status'     => $postStatus[rand(0, 1)],
      'post_status' => $faker->randomElement(['shown', 'archived']),
      'like' => rand(99, 2500),
      'unlike' => rand(9, 125),
      'publish_at' => $faker->dateTime()
    ];
  }
}
//                    $faker->imageUrl($width = 640, $height = 480),
//   'publish_at'  => date('Y-m-d H:i:s'), //'2022-02-06 09:57:41', 

