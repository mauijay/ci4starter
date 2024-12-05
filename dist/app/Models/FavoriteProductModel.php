<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoriteProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'favorite_products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    
    protected $allowedFields    = ['user_id', 'product_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $userModel;
    protected $comicModel;

    public function __construct()
    {
        parent::__construct();
        
        $this->userModel  = model('UserModel');
        $this->productModel = model('ProductModel');
    }

    public function isFavoriteProduct($product_id)
    {
        return (bool) $this->where(['user_id' => auth()->id(), 'product_id' => $product_id])->first();
    }

    public function findFavoriteProduct($product_id)
    {
        return $this->where(['user_id' => auth()->id(), 'product_id' => $product_id])->first();
    }
    
    public function saveFavoriteProduct($favoriteProduct)
    {
        return $this->save($favoriteProduct);
    }

    public function deleteFavoriteProduct($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('favorite_products');
        return $builder->delete(['id' => $id]);
    }

    public function getFavoriteProducts($user_id)
    {
        $favoriteProducts = $this->where('user_id', $user_id)->findAll();

        $data['favoriteProducts'] = array_map(function ($favoriteProduct) {
            $favoriteProduct->user  = $this->userModel->find(auth()->id());
            $favoriteProduct->product = $this->productModel->findProductById($favoriteProduct->product_id);
            return $favoriteProduct;
        }, $favoriteProducts);

        return $data['favoriteProducts'];
    }

    
}
