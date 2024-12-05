<?php
declare(strict_types=1);

/**
 * @copyright   2023 808BIZ
 * @link        https://808.biz/
 */
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\CategoryModel;

/**
 * @property int $id
 * @property int $parent_id
 * @property Category|null $parent
 * @property int $cat_status
 * @property string $cat_name
 * @property string $cat_slug
 * @property string $cat_img
 * @property string $cat_img_alt
 * @property string $cat_type
 * @property string $cat_md
 */

class Category extends Entity
{
  protected ?Category $parent = null;
  //protected ?Category $parent_name = null;

  protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

  protected $casts   = [
    'id'              => 'integer',
    'parent_id'       => '?integer',
    'cat_name'        => 'string',
    'cat_slug'        => 'string',
    'cat_img'         => 'string',
    'cat_img_alt'     => 'string',
    'cat_type'        => 'string',
    'cat_status'      => 'integer',
    'cat_md'          => 'string',
  ];

  public function getParent(): ?self
  {
    if ($this->parent_id === null){
      return null;
    }
    return (new CategoryModel())->getCategoryById($this->parent_id);
  }

  /*
  public function getParentName(): ?self
  {
    if ($this->parent_id === null){
      return null;
    }
    return (new CategoryModel())->getCategoryById($this->parent_id)->cat_name;
  }
  */
}

