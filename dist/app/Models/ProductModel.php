<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Product;

class ProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'products_id';
    protected $useAutoIncrement = true;
    protected $returnType       = Product::class;
    protected $useSoftDeletes   = false;
    
    protected $allowedFields    = [
      'product_name',
      'slug',
      'category_id',
      'brand_id',
      'description',
      'short_description',
      'details',
      'note',
      'product_image',
      'product_img_alt',      
      'height',
      'width',
      'length',
      'weight',
      'msrp',
      'discount',
      'cost',
      'supplier_id',
      'supplier_item_code',
      'sku',
      'stock',
      'sold_count',
      'status',
      'stars',
      'featured',
      'onSale',
      'last_modified_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $categoryModel;
    protected $productCategoryModel;
    protected $productRatingModel;

    public function __construct()
    {
      parent::__construct();
        
      $this->categoryModel = model('categoryModel');
      $this->productCategoryModel = model('productCategoryModel');
      $this->productRatingModel = model('productRatingModel');
    }

    public function search($keyword)
    {
      return $this
      ->join('categories', 'products.category_id=categories.id', 'left')
      ->like('product_name', $keyword)->orLike('description', $keyword);
    }





    public function getShopIndex($catId = false)
    {


      if ($catId === false) {
        return $this
        ->select('products_id,product_name,product_image,product_img_alt,msrp,discount,onSale,slug,category_id')
        ->orderBy('products.products_id', 'asc');
      }

      return $this
      ->where(['category_id' => $catId])
      ->select('products_id,product_name,product_image,product_img_alt,msrp,discount,onSale,slug,category_id')
      ->orderBy('products.products_id', 'asc');

      
      
    }



    public function getProducts($slug = false)
    {
      if ($slug === false) {
        return $this
        ->join('categories', 'products.category_id=categories.id', 'left')
        
        ->orderBy('products.products_id', 'asc');          
      }
      return $this
        ->join('categories', 'products.category_id=categories.id', 'left')
        ->where(['slug' => $slug])
        ->first();      
    }

    public function getProductsId($id = false)
    {
      if ($id === false) {
        return $this
          ->join('categories', 'products.category_id=categories.id', 'left')
          ->orderBy('products.products_id', 'asc')
          ->paginate(12);
      }
      return $this
        ->join('categories', 'products.category_id=categories.id', 'left')
        ->where(['products_id' => $id])
        ->first();
    }

    public function getCartProduct($id)
    {
      return $this
        ->where(['products_id' => $id])
        ->select('products.*, categories.cat_name')
        ->join('categories', 'products.category_id=categories.id', 'left')
        ->first();
    }

    public function getshowproduct($id)  //admin show
    {
      return $this
        ->where(['products_id' => $id])
        ->select('products.*, brands.brand_name, brands.brand_logo, brands.brand_logo_alt, categories.cat_name, suppliers.name as supplierName')
        ->join('brands', 'products.brand_id=brands.brands_id', 'left')
        ->join('categories', 'products.category_id=categories.id', 'left')
        ->join('suppliers', 'products.supplier_id=suppliers.suppliers_id', 'left')
        ->first();

    }
  
      public function getFeaturedProducts()
    {
      return $this
        ->where('featured', 1)
        ->select("products.products_id, products.product_image, products.product_img_alt, products.product_name, products.slug, products.msrp, products.discount, products.status, products.featured, products.onSale, categories.cat_slug as catSlug, categories.cat_name as catName, categories.id as catId")
        ->join('categories', 'products.category_id=categories.id', 'left')        
        ->findAll(4);
    }
  
    public function getPopularProducts($limit = 3)
    {    
      return $this
        ->select("products.products_id, products.product_image, products.product_img_alt, products.product_name, products.slug, products.msrp, products.discount, products.status, products.featured, products.onSale, categories.cat_slug as catSlug, categories.cat_name as catName")
        ->join('categories', 'products.category_id=categories.id', 'left')
        ->orderBy('sold_count', 'RANDOM')
        ->findAll($limit);      
    }
    
    public function getnewArrivals()
    {    
      return $this
        ->select("products.products_id, products.product_image, products.product_img_alt, products.product_name, products.msrp, products.discount, categories.cat_slug as catSlug, categories.cat_name as catName")
        ->join('categories', 'products.category_id=categories.id', 'left')
        ->orderBy('products.products_id', 'desc')
        ->findAll(8);      
    }
    public function getLikeProducts()
    {

      //'likeProducts'  => Product::inRandomOrder()->with('subCategory')->take(8)->get(),
      // ->select('order.*','order_details.orderdetail_total','products.product_image')
      // ->select("orders.*, categories.name as categoryName, categories.slug as categorySlug, brands.name as brandName, brands.slug as brandSlug, (SELECT MIN(price) FROM products AS variants WHERE (products.id = variants.id AND variants.type = 'simple') OR products.id = variants.parent_id LIMIT 1) price")
      
      return $this
      ->select("products.products_id, products.product_image, products.product_img_alt, products.product_name, products.msrp, products.discount, categories.cat_name as caTName, categories.cat_slug")
      ->join('categories', 'products.category_id=categories.id')
      //->where(['categories.id' => $cat_id])
      ->findAll(8);
    }

    public function getDiscountedPriceAttribute()
    {
      return ((100 - (float)$this->discount) / 100) * (float)$this->msrp;
    }

    public function findProductById($id)
    {
        $productx = $this->find($id);

        return $productx;
    }

    public function findProductWithDeletedById($id)
    {
        return $this->withDeleted()->find($id);
    }

    public function findProductBySlug($slug)
    {
        $product = $this->where('slug', $slug)->first();

        if ($product) {
            $product->type = $this->categoryModel->findTypeById($product->type_id);
            $product->categories = $this->productCategoryModel->getProductCategories($product->products_id);
            $product->ratings = $this->productRatingModel->getProductRatings($product->products_id);
            $product->average_stars = $this->productRatingModel->getProductStars($product->products_id);
        }

        return $product;
    }
}
