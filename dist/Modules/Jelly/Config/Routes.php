<?php
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
//$routes->add('jelly', 'Jelly\Controllers\Jelly::index');
//$routes->GET('jelly', 'Jelly::index', ['as' => 'news-list']);
$routes->GET('jelly', [Jelly\Controllers\Jelly::class, 'index'], ['as'=>'jelly.index']);

