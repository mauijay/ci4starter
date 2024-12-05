<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    
    protected $table            = 'banners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = 'object';
    
    protected $allowedFields    = [
      'product_id', 'cover'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function __construct()
    {
        parent::__construct();

        $this->pm = model(ProductModel::class);
    }

    public function getAllBanners()
    {
        $banners = $this->findAll();

        $data['banners'] = array_filter($banners, function ($banner) {
            $productx = $this->pm->findProductById($banner->product_id);
            if ($productx) {
                $banner->product = $this->pm->findProductById($banner->product_id);
                return $productx;
            }
        });
        $data['banners'] = array_values($data['banners']);

        return $data['banners'];
    }

    public function findBannerById($id)
    {
        $banner = $this->find($id);

        if ($banner) {
            $banner->product = $this->pm->findProductWithDeletedById($banner->product_id);
        }
        
        return $banner;
    }

    public function findBannerByProductId($products_id)
    {
        $banner = $this->where('product_id', $products_id)->first();

        if ($banner) {
            $banner->product = $this->pm->findProductWithDeletedById($banner->product_id);
        }
        
        return $banner;
    }

    public function deleteBanner($id)
    {
        $banner = $this->find($id);

        if ($banner) {
            if (!str_contains($banner->cover, 'images/banners/product')) {
                unlink($banner->cover);
            }
        }

        return $this->delete($id);
    }
}
