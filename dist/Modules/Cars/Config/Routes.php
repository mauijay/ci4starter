<?php
        if(!isset($routes))
        { 
            $routes = \Config\Services::routes(true);
        }
        $routes->get('cars', [Cars\Controllers\Cars::class, 'index'], ['as'=>'cars.index']);
        