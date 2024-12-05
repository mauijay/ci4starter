<?php

namespace App\Controllers;

use \App\Models\RecordModel;

/**
 * Home Controller
 */

class Home extends BaseController
{
  protected $rM;
  public function __construct()
  {
    $this->rM = new RecordModel();
  }
    public function index(): string
    {
      $siteName = setting()->get('AppJay.siteName');
      $data = [
        'title' => $siteName,
        'heading' => 'Hawaii Business Development',
        'keyword' => 'Hawaii Business Development',
        'desc' => '808 Business Solutions small business development.',
        'mis' => $this->rM->getAnnouncements('mission')->paginate(5),
      ];

      // return view('welcome_message', $data);
      // return view('home', $data);
      return view('ghome', $data);
    }

    public function about(): string
  {
    $data = [
      'title' => 'About Us',
      'heading' => 'About Us - Hawaii Business Development',
      'keyword' => 'about-us',
      'desc' => 'About Us description'
    ];
    return view('pages/about', $data);
  }

  public function terms(): string
  {
    $data = [
      'title' => 'Terms and Conditions | Hawaii SB Solutions',
      'heading' => 'About Us - Hawaii Business Development',
      'keyword' => 'terms-of service',
      'desc' => 'Terms of Service for Hawaii SB Solutions',
    ];
    return view('pages/terms', $data);
  }

  public function privacy(): string
  {
    $data = [
      'title' => 'Privacy Policy | Hawaii SB Solutions',
      'heading' => 'About Us - Hawaii Business Development',
      'keyword' => 'About Hawaii Business Development',
      'desc' => 'Privacy Policy for Hawaii SB Solutions',
    ];
    return view('pages/privacy', $data);
  }

  public function contact()
  {
    $data = [
      'title' => 'Contact Us',
      'heading' => 'Contact Us - Hawaii Business Development',
      'keyword' => 'Contact Hawaii Business Development',
      'desc' => 'Bulid your business bigger, better and faster with Hawaii Small Business Solutions',
    ];
    return view('/pages/contact', $data);
  }
}
