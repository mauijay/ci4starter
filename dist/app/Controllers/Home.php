<?php

namespace App\Controllers;

/**
 * Home Controller
 */

class Home extends BaseController
{
    public function index(): string
    {
      $siteName = setting()->get('AppJay.siteName');
      $data = [
        'title' => $siteName
      ];

      // return view('welcome_message', $data);
      // return view('home', $data);
      return view('ghome', $data);
    }
}
