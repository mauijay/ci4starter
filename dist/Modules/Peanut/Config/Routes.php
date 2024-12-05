<?php
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
//$routes->add('peanut', 'Peanut\Controllers\Peanut::index');
$routes->GET('peanut-butter', [Peanut\Controllers\Peanut::class, 'index'], ['as'=>'peanut-butter.index']);

