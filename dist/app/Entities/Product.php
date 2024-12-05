<?php
declare(strict_types=1);
/**
 * @copyright   2023 808BIZ
 * @link        https://808.biz/
 */
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\CategoryModel;
//use CodeIgniter\Exceptions\PageNotFoundException; // Add this line
use RuntimeException;

/**
 * @property int $products_id
 * @property string $product_name
 * @property string $slug
 * @property int $brand_id
 * @property int $category_id
 * @property Category|null $category
 * @property string|null $description
 * @property string|null $short_description
 * @property string|null $details
 * @property string|null $note
 * @property string|null $product_image
 * @property string|null $product_img_alt
 * @property float|null $height
 * @property float|null $width
 * @property float|null $length
 * @property float|null $weight
 * @property float $msrp
 * @property float $discount
 * @property float $cost 
 * @property int $supplier_id
 * @property string|null $supplier_item_code
 * @property string $sku
 * @property int $stock
 * @property int $sold_count
 * @property int $status
 * @property int $featured
 * @property int $onSale
 * @property int $stars
 * @property int $last_modified_by
 */

class Product extends Entity
{
  protected ?Category $category = null;
  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at'
  ];
  protected $casts = [
    'products_id'         => 'integer',
    'product_name'        => 'string',
    'slug'                => 'string',
    'brand_id'            => 'integer',
    'description'         => '?string',
    'short_description'   => '?string',
    'details'             => '?string',
    'note'                => '?string',
    'product_image'       => '?string',
    'product_img_alt'     => '?string',
    'category_id'         => 'integer',
    'height'              => '?float',
    'width'               => '?float',
    'length'              => '?float',
    'weight'              => '?float',
    'msrp'                => 'float',
    'discount'            => 'float',
    'cost'                => 'float',
    'supplier_id'         => 'integer',
    'supplier_item_code'  => '?string',
    'sku'                 => '?string',
    'stock'               => 'integer',
    'sold_count'          => 'integer',
    'status'              => 'integer',
    'featured'            => '?integer',
    'onSale'              => '?integer',
    'stars'               => 'integer',
    'last_modified_by'    => 'integer',
  ];
  

  /**
   * Return the URL to this post.
   *
   * @return string
   */
  public function link()
  {
    return site_url('shop/'. $this->products_id);
    //return route_to('shop.show', $this->id);
  }

  public function slug_link()
  {
    return site_url('shop/'. $this->slug);
    //return route_to('shop.show', $this->slug);
  }

  /**
   * Returns the product category entity
   */
  public function getCategory(): ?Category
  {
    if ($this->products_id === null) {
      throw new RuntimeException('Product must be added before getting category.');
    }
    if (! $this->category instanceof Category) {
      $this->category = (new CategoryModel())->getCategoryById($this->category_id);
    }
    return $this->category;
  }
}
