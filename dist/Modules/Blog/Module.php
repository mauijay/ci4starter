<?php namespace Jay\Modules\Blog;

use Bonfire\Config\BaseModule;
use Bonfire\Libraries\Menus\MenuItem;

/**
  * News Module setup
  */

class Module extends BaseModule
{
    public function initAdmin()
    {
      // Settings menu for sidebar
      $sidebar = service('menus');
      $item    = new MenuItem([
          'title'           => 'Blogs',
          //'namedRoute'      => 'blog-list',
          //'fontAwesomeIcon' => 'fas fa-user',
          //'permission'      => 'users.settings',
      ]);
      $sidebar->menu('sidebar')->collection('settings')->addItem($item);

      // Content Menu for sidebar
      $item = new MenuItem([
          'title'           => 'Blogs',
          //'namedRoute'      => 'blog-list',
          //'fontAwesomeIcon' => 'fas fa-users',
          //'permission'      => 'users.list',
      ]);
      $sidebar->menu('sidebar')->collection('content')->addItem($item);     

    }
}