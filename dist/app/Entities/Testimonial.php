<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Testimonial extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getauthorname()
    {
      return $this->getusername($this->attributes['users_id']);       
    }

    public function  ximage($jenis = null)
    {
      $img = $this->attributes['picture'] ?? '';
      switch ($jenis) {
        case 'mini':
            return base_url("/uploads/testimonials/thumbs{$img}");
            break;
        case 'max':
            return base_url("/uploads/testimonials/{$img}");
            break;
        default:
            return $this->attributes['picture'];
            break;
      }
    }

    public function getcommnt()
    {
      $model = new \App\Models\TestimonialReplyModel();
      $commet = $model->where('id', $this->attributes['id'])->find();
      if ($commet) {
          $tulisan = '';
          foreach ($commet as  $value) {
              $tulisan .='<p><b>'. $this->getusername($value->users_id) .'</b>: ' .$value->comment .'</p>' ;
          }
          return $tulisan;
        //  print_r ($tulisan); die;
      }
      return null;
    }

    private function getusername($id)
    {
      $users = auth()->getProvider();
      $penulis = $users->find($id);
      if ($penulis) {
          return $penulis->userfullname;
      }
      return null;
    }

}
