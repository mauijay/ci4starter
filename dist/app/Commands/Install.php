<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Commands\Database\Migrate;
use Config\Services;
use App\Models\UserDetailsModel;
use App\Entities\UserDetails;
use CodeIgniter\Shield\Entities\User;

class Install extends BaseCommand {
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
  protected $name = 'starter:install';

  /**
   * The Command's Description
   *
   * @var string
   */
  protected $description = 'Run the Starter Site installer';

  /**
   * The Command's Usage
   *
   * @var string
   */
  protected $usage = 'starter:install';

  /**
   * Actually execute the Install Command.
   *
   * @param array $params
   */
  public function run(array $params)
  {
    helper('custom');

    $this->params = $params;
    $this->runMigrations();
    $this->runSeeder();
    $this->runCreateAdmin();
  }

  /**
   * Summary of runMigrations
   * @return void
   */
  public function runMigrations()
  {
    CLI::write(CLI::color('1. Run migration', 'yellow'));
    try {
      $command = new Migrate(Services::logger(), Services::commands());
      $command->run(['all' => null]);
    } catch (\Exception $e) {
      CLI::write(CLI::color($this->showError($e), 'red'));
    }
  }

  /**
   * Summary of runSeeder
   * @return void
   */
  public function runSeeder()
  {
    CLI::write(CLI::color('2. Example data', 'yellow'));
    $seeder = \Config\Database::seeder();
    try {
      $seeder->call('A1Starter');
      CLI::write(CLI::color('Starter data inserted', 'green'));
    } catch (\Exception $e) {
      CLI::write(CLI::color('Starter data could not be inserted.', 'red'));
    }
    try {
      $seeder->call('A2cms');
      CLI::write(CLI::color('Admin CM data inserted', 'green'));
    } catch (\Exception $e) {
      CLI::write(CLI::color('Admin CMS data could not be inserted.', 'red'));
    }
    try {
      $seeder->call('A3Ecommerce');
      CLI::write(CLI::color('Ecommerce data inserted', 'green'));
    } catch (\Exception $e) {
      CLI::write(CLI::color('Ecommece data could not be inserted.', 'red'));
    }
    try {
      $seeder->call('A4Premium');
      CLI::write(CLI::color('Premium data inserted', 'green'));
    } catch (\Exception $e) {
      CLI::write(CLI::color('Premium data could not be inserted.', 'red'));
    }
    try {
      $seeder->call('A5Samples');
      CLI::write(CLI::color('Samples data inserted', 'green'));
    } catch (\Exception $e) {
      CLI::write(CLI::color('Samples data could not be inserted.', 'red'));
    }
    try {
      $seeder->call('Blogs\Database\Seeds\BlogSeeder');
      CLI::write(CLI::color('Sample Blog Articles inserted', 'green'));
    } catch (\Exception $e) {
      CLI::write(CLI::color('Sample Blog Articles could not be inserted.', 'red'));
    }

  }

  /**
   * Summary of runCreateAdmin
   * @return void
   */
  public function runCreateAdmin()
  {
    CLI::write(CLI::color('3. Create admin', 'yellow'));
    $username = null;
    $password = null;
    $email    = null;
    // Set default credentials if quiet mode set
    if (array_key_exists('q', $this->params)) {
      $username = 'admin';
      $password = createRandomPassword(12);
      $email    = 'admin@808.biz';
    }
    // Set or overwrite credentials if they are given as parameters
    if (array_key_exists('u', $this->params) and !empty($this->params['u'])) {
      $username = $this->params['u'];
    }
    if (array_key_exists('e', $this->params) and !empty($this->params['e'])) {
      $email = $this->params['e'];
    }
    if (array_key_exists('p', $this->params) and !empty($this->params['p'])) {
      $password = $this->params['p'];
    }
    if (!array_key_exists('q', $this->params)) {
      if (!$username) {
        $username = CLI::prompt('Username', null, 'required');
      }
      if (!$email) {
        $email = CLI::prompt('E-Mail', null, 'required|valid_email');
      }
      if (!$password) {
        $password = CLI::prompt('Password', null, 'required');
      }
    }
    $users = auth()->getProvider();
    $user  = new User([
      'username' => $username,
      'first_name' => 'Admin',
      'avatar' => get_gravatar($email),
      'email' => $email,
      'password' => $password,
    ]);
    $users->save($user);
    $user = $users->findById($users->getInsertID());
    $user->activate();
    $user->addGroup('superadmin');
    CLI::write(CLI::color('Admin created', 'green'));
    CLI::write(CLI::color('You can now log in to the website with your credentials', 'green'));
    CLI::write(CLI::color('E-Mail: ' . $email, 'blue'));
    CLI::write(CLI::color('Password: ' . $password, 'blue'));
    CLI::write(CLI::color('INSTALLTION COMPLETED', 'green'));
  }
}
