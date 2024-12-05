<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AppJay extends BaseConfig
{
  /**
   * --------------------------------------------------------------------------
   * Website Name
   * --------------------------------------------------------------------------
   *
   * The name that should be displayed for the site.
   */
  public string $siteName = 'Your Name Here';
  /**
   * --------------------------------------------------------------------------
   * Site Online?
   * --------------------------------------------------------------------------
   *
   * When false, only superadmins and user groups with permission will be
   * able to view the site. All others will see the "System Offline" page.
   */
  public bool   $siteOnline = true;  //or false
  /**
   * --------------------------------------------------------------------------
   * Site Offline View
   * --------------------------------------------------------------------------
   *
   * The view file that is displayed when the site is offline.
   */
  public        $siteOfflineView = 'Views/errors/html/offline.php';

  

  public string $companyName = '808 Business Solutions, LLC';
  public string $slogan = 'Your success is our bussiness!';
  public string $about = 'Serving pas photos, call photos and photo printing from various media such as cellphones, CDs, flash drives with superior print quality is our about info';

  public string $title = 'Easy Customer Management';
  public string $loginImage = 'assets/images/loginImage.png';
  public string $logo = 'assets/images/logo.png';

  public array $about_team = [
    [
      'title' => 'team member 1',
      'image' => 'https://picsum.photos/600?1',
    ], [
      'title' => 'team member 2',
      'image' => 'https://picsum.photos/600?2',
    ]
  ];
  
  public function __construct() {
    //  $this->app_csrf_exclude_uris = app_hooks()->apply_filters('app_filter_app_csrf_exclude_uris', $this->app_csrf_exclude_uris);
  }

  public $app_settings_array = array(
    "app_version" => "3.5.3",
    "app_update_url" => 'https://808businesssolutions.com/rise/',
    "updates_path" => './updates/',
  );
  
  public $app_csrf_exclude_uris = array(
    "notification_processor/create_notification",
    "paypal_redirect", "paypal_redirect/index",
    "paytm_redirect", "paytm_redirect/index", "paytm_redirect.*+",
    "stripe_redirect", "stripe_redirect/index",
    "pay_invoice", "pay_invoice/*",
    "google_api/save_access_token", "google_api/save_access_token_of_calendar", "google_api/save_access_token_of_own_calendar",
    "webhooks_listener.*+",
    "external_tickets.*+",
    "collect_leads.*+",
    "upload_pasted_image.*+",
    "request_estimate.*+",
    "events/snooze_reminder", "events/reminder_view", "events/save_reminder_status",
    "cron",
    "notifications/count_notifications", "notifications/get_notifications",
    "messages/count_notifications",
    "microsoft_api/save_outlook_smtp_access_token"
  );

  public int    $perPage = 20;
  public string $lastKalahariImport;
  public string $lastAbacusImport;
  public int    $invoiceTemplateId = 0;

  public string $layoutFront = 'front';

  public array $MenuUser = [
    [
      'menu' => 'Price list',
      'url' => '/pricelist'
    ],
    [
      'menu' => 'Portofolio',
      'url' => '/portofolio'
    ],
    /*  [
        'menu' => 'Jadwal Boking',
        'url' => ''
    ], */
    [
      'menu' => 'Testimoni',
      'url' => '/testimoni'
    ],
    [
      'menu' => 'About',
      'url' => '/about'
    ],
    [
      'menu' => 'Contact',
      'url' => '/contact'
    ],
  ];

  public array $contact = [
    
      'address' => '909 Kapiolani Blvd Suite 1901</br> Honolulu, Hi 96814',
      'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1295.4355285449021!2d-157.85203123948185!3d21.297574389416912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c006dedc4c69023%3A0x2e3d3e4f7bb7d1c2!2s808biz%2C%20Inc.!5e0!3m2!1sen!2sus!4v1678606141109!5m2!1sen!2sus',
      'wa' => ' +18087251900',
      'mail' => 'solutions@808businesssolutions.com',
      'twitter' => 'https://twitter.com/808biz',
      'facebook' => 'https://www.facebook.com/808Biz',
      'google' => 'https://www.google.com/search?sca_esv=557255143&rlz=1C1GCEA_en&tbm=lcl&sxsrf=AB5stBhLlKM_gYVnuFdJRrm8KkxGfn6PLw:1692141568267&q=808+biz&spell=1&sa=X&ved=2ahUKEwiF9tfI5t-AAxWwI0QIHed2BGsQBSgAegQICBAB&biw=1518&bih=1587&dpr=1.25#rlfi=hd:;si:;mv:[[21.311422323087502,-157.84059821501208],[21.28159366273162,-157.8641587389989]]',
      'instagram' => 'https://www.instagram.com/808biz/',
      'linkedin' => 'example.com/808biz',
      'github' => 'https://github.com/MauiJay',
      'youtube' => 'https://www.youtube.com/channel/UCKugQRHtUSvf9Ge0TKqoi8g',
      'tiktok' => 'https://tiktok.com/808biz',
      
  ];

  public string $layoutAdmin = 'LayoutAdmin';

  public array $MenuAdmin = [
      [
          'icon' => '<i class="fa-solid fa-user-gear"></i>',
          'menu' => 'Admin',
          'url' => '/admin/admin'
      ],
      [
          'icon' => '<i class="fa-regular fa-image"></i>',
          'menu' => 'Portofolio',
          'url' => '/admin/portofolio'
      ],
      [
          'icon' => '<i class="fa-solid fa-ticket"></i>',
          'menu' => 'Booking',
          'url' => '/admin/booking'
      ],
      [
          'icon' => '<i class="fa-regular fa-credit-card"></i>',
          'menu' => 'Pembayaran',
          'url' => '/admin/pembayaran'
      ],
      [
          'icon' => '<i class="fa-solid fa-star"></i>',
          'menu' => 'Testimoni',
          'url' => '/admin/testimoni'
      ],
      [
          'icon' => '<i class="fa-solid fa-users"></i>',
          'menu' => 'User',
          'url' => '/admin/user'
      ],
      [
          'icon' => ' <i class="fa-solid fa-calendar-days"></i>',
          'menu' => 'Paket',
          'url' => '/admin/paket'
      ],


  ];
  


  public array $chat = [
    
    [
      'question' => 'What time does your office open?',
      'answer' =>   'We are open from 9:00 am - 5:00 pm, Monday - Friday',
    ],
    [
      'question' => 'What color is the sky?',
      'answer' =>   'The sky is blue',
    ],
    [
      'question' => 'Where can i find Frequent Questions?',
      'answer' =>   'Try this <strong><a href=\"/faq\">FAQ link</a></strong> ',
    ],
    [
      'question' => 'How many hours are in a day?',
      'answer' =>   'There are only 24 hours in a day, so make good use of your time!',
    ],
    [
      'question' => 'Can you help me start my business?',
      'answer' =>   'We can help you from the start!',
    ],
    
  ];
  public string $orderlimit="6 months";

  public array $account = [ //changed this from rekening
     'atasnama' => "erlanga adi pamungkas",
     'no'=>'7000 0101 7707 533',
     'bank' => 'BRI',
     'img' =>''
  ];

  
}