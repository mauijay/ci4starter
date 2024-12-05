<?php

namespace Blogs\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run()
    {
      /* Call primary site seeders */
		
		  $this->call('Blogs\Database\Seeds\NewsFeaturedSeeder');// 1
      $this->call('Blogs\Database\Seeds\NewsSeeder');// 2
      // $this->call('Blogs\Database\Seeds\CommentsSeeder');// 2
      // $this->call('Blogs\Database\Seeds\NewsRatingsSeeder');// 2
      // $this->call('Blogs\Database\Seeds\NewsTagsSeeder');// 2
    }
}
