<?php

namespace Admin\Config;

use CodeIgniter\Config\BaseConfig;

class AdminConfig extends BaseConfig
{
  //--------------------------------------------------------------------
  // error view pages
  //--------------------------------------------------------------------
  public $views = [
    '403' => 'Modules\Backend\Views\errors\html\error_403',
    '404' => 'Modules\Backend\Views\errors\html\error_404'
  ];

  //--------------------------------------------------------------------
  // Layout for the views to extend
  //--------------------------------------------------------------------
  public $viewLayout = 'Modules\Backend\Views\base';
}