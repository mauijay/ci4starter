<?php

use Admin\Controllers\Dashboard;
use Admin\Controllers\BillingDisputes;

if(!isset($routes))
{ 
  $routes = \Config\Services::routes(true);
}

//Admin
$routes->group('admin', ['filter' => 'group:admin,superadmin'], static function ($routes) {  

  // Dashboard
  $routes->get('',            [Dashboard::class, 'index'],      ['as' => 'admin.dashboard']);
  $routes->get('info',        [Dashboard::class, 'info'],       ['as' => 'admin.info']);
  $routes->get('changelog',   [Dashboard::class, 'changelog'],  ['as' => 'admin.changelog']);
  $routes->get('systeminfo',  [Dashboard::class, 'systeminfo'], ['as' => 'admin.systeminfo']);

  $routes->match(['GET', 'POST'], 'billing-dispute/(:num)', [BillingDisputes::class, 'dispute'], ['as' => 'user.billing.dispute']);
});
