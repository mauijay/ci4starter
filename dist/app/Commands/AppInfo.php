<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class AppInfo extends BaseCommand {
  /**
   * The Command's Group
   *
   * @var string
   */
  protected $group = 'Development';

  /**
   * The Command's Name
   *
   * @var string
   */
  protected $name = 'starter:sysinfo';

  /**
   * The Command's Description
   *
   * @var string
   */
  protected $description = 'Quick view of This install info';

  /**
   * The Command's Usage
   *
   * @var string
   */
  protected $usage = 'starter:sysinfo [arguments] [options]';

  /**
   * The Command's Arguments
   *
   * @var array
   */
  protected $arguments = [];

  /**
   * The Command's Options
   *
   * @var array
   */
  protected $options = [];

  /**
   * Actually execute a command.
   *
   * @param array $params
   */
  public function run(array $params)
  {
    CLI::write('PHP Version: ' . CLI::color(PHP_VERSION, 'yellow'));
    CLI::write('CI Version: ' . CLI::color(\CodeIgniter\CodeIgniter::CI_VERSION, 'yellow'));
    CLI::write('APPPATH: ' . CLI::color(APPPATH, 'yellow'));
    CLI::write('SYSTEMPATH: ' . CLI::color(SYSTEMPATH, 'yellow'));
    CLI::write('ROOTPATH: ' . CLI::color(ROOTPATH, 'yellow'));
    CLI::write('Included files: ' . CLI::color(count(get_included_files()), 'yellow'));
  }
}
