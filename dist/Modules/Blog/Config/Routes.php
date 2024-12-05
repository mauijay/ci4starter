<?php
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
//$routes->add('news', 'News\Controllers\Blog::index');
$routes->get('news', [Blogs\Controllers\Blogs::class, 'index'], ['as'=>'news.index']);
