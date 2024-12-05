<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/',                [App\Controllers\Home::class, 'index'],   ['as' => 'home']);
$routes->get('about',            [App\Controllers\Home::class, 'about'],   ['as' => 'about.us']);
$routes->get('contact',          [App\Controllers\Home::class, 'contact'], ['as' => 'contact.us']);
$routes->get('privacy',          [App\Controllers\Home::class, 'privacy'], ['as' => 'privacy.policy']);
$routes->get('terms-of-service', [App\Controllers\Home::class, 'terms'],   ['as' => 'terms.service']);

service('auth')->routes($routes);
