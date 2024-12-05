<?php namespace Blogs\Models;

use Blogs\Entities\Post;
use CodeIgniter\Model;
use Faker\Generator;

class NewsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Post::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['post_title', 'slug', 'short_title', 'lead', 'body','id_author', 'id_category', 'id_tags', 'id_comments', 'id_ebook', 'id_header_image', 'id_image_one', 'id_image_two', 'post_img', 'post_img_alt', 'thumbnail', 'related_vid', 'post_tags', 'reader_hits', 'post_status', 'published_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    //protected $validationRules      = [];
    //protected $validationMessages   = [];
    //protected $skipValidation       = false;
    //protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function published()
    {
        $this->where('published_at <=', date('Y-m-d H:i:s'));

        return $this;
    }

    public function fake(Generator &$faker)
    {
        return [
            'author_id'       => [],
            'category_id'     => [],
            'post_title'      => $faker->words(4, true),
            'slug'            => $faker->slug(),
            'short_title'     => [],
            'lead'            => [],
            'body'            => $faker->realText(300) ."\n\n". $faker->realText(300),
            'post_img'        => $faker->image($dir, $width, $height, 'cats', false),
            'post_img_alt'    => [],
            'thumbnail'       => [],
            'ebook_id'        => [],
            'related_vid'     => [],
            'post_tags'       => [],
            'post_status'     => [],
            'featured'        => [],
            'reader_hits'     => [],
            'published_at'    => [],            
            'deleted_at'      => [],
        ];
    }
}
