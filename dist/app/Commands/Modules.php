<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Modules extends BaseCommand {
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
  protected $name = 'make:module';

  /**
   * The Command's Description
   *
   * @var string
   */
  protected $description = 'Create CodeIgniter Modules in root directory Modules folder';

  /**
   * The Command's Usage
   *
   * @var string
   */
  protected $usage = 'make:module [arguments] [options]';

  /**
   * The Command's Arguments
   *
   * @var array
   */
  protected $arguments = ['ModuleName' => 'Module name to be created'];

  /**
   * The Command's Options
   *
   * @var array
   */
  protected $options = [
    '-f' => 'Set module folder other than app/Modules',
    '-c' => 'Create only con[F]ig, [C]ontroller, [L]ibrary, [M]odel, [V]iew, [O]ther dirs'
  ];

  /**
   * Summary of module_name, new module name
   * @var 
   */
  protected $module_name;


  /**
   * Summary of module_folder (Modules)
   * @var 
   */
  protected $module_folder;


  /**
   * Summary of view_folder (View)
   * @var 
   */
  protected $view_folder;

  /**
   * Actually execute a command.
   *
   * @param array $params
   */
  public function run(array $params)
  {
    helper('inflector');
    if (!isset($params[0])) {
      CLI::error("Module name must be set!. \n\nUsage:\n" . $this->usage);
      return;
    }
    $this->module_name = $params[0];
    if (strlen(preg_replace('/[^A-Za-z0-9]+/', '', $this->module_name)) <> mb_strlen($this->module_name)) {
      CLI::error("Module name must to be plain ascii characters A-Z or a-z, and can contain numbers 0-9");
      return;
    }
    $this->module_name = ucfirst($this->module_name);
    //$module_folder         = preg_replace('/[^A-Za-z0-9]+/','',$params['-f'] ?? CLI::getOption('f'));
    $module_folder = 'Modules';
    //$this->module_folderOrig   = $module_folder?ucfirst($module_folder):basename(APPPATH).DIRECTORY_SEPARATOR.'Modules'; // change this to root path
    $this->module_folderOrig = ucfirst($module_folder); // change this to root path
    $this->module_folder     = APPPATH . '..' . DIRECTORY_SEPARATOR . $this->module_folderOrig;
    if (!is_dir($this->module_folder)) {
      mkdir($this->module_folder);
    }
    $this->module_folder = realpath($this->module_folder);
    CLI::write('Creating module ' . $this->module_folderOrig . DIRECTORY_SEPARATOR . $this->module_name);
    if (!is_dir($this->module_folder . DIRECTORY_SEPARATOR . $this->module_name)) {
      mkdir($this->module_folder . DIRECTORY_SEPARATOR . $this->module_name, 0777, true);
    }
    try {
      if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'F')) {
        $this->createConfig();
      }
      if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'C')) {
        $this->createController();
      }
      if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'L')) {
        $this->createLibrary();
      }
      if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'M')) {
        $this->createModel();
      }
      if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'V')) {
        $this->createView();
      }
      if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'O')) {
        $this->createOtherDirs();
      }
      $this->updateAutoload();

      CLI::write('Module created!');
      CLI::write('Try to browse to http://localhost:8080/' . strtolower($this->module_name));

    } catch (\Exception $e) {
      CLI::error($e);
    }
  }

  /**
   * Create Config File
   */
  protected function createConfig()
  {
    $configPath = $this->createDir('Config');
    if (!file_exists($configPath . '/Routes.php')) {
      $routeName = strtolower($this->module_name);
      $template  = "<?php
        if(!isset(\$routes))
        { 
            \$routes = \Config\Services::routes(true);
        }
        \$routes->get('" . strtolower($routeName) . "', [" . ucfirst($routeName) . "\Controllers\\" . ucfirst($routeName) . "::class, 'index'], ['as'=>'" . strtolower($routeName) . ".index']);
        ";
      file_put_contents($configPath . '/Routes.php', $template);
    } else {
      CLI::error("Routes Config already exists!");
    }
  }

  /**
   * Create controller file
   */
  protected function createController()
  {
    $controllerPath = $this->createDir('Controllers');
    if (!file_exists($controllerPath . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . '.php')) {
      $template = "<?php 
        namespace " . ucfirst($this->module_name) . "\\Controllers;
        use CodeIgniter\\Controller;
        class " . ucfirst($this->module_name) . " extends Controller
        {
            /**
             * Constructor.
             *
             */
            public function __construct()
            {
              //
            }
            
            /**
            * Summary of index
            * @return string
            */

            public function index()
            {
                \$data = [];
                helper(['form']);
                
                return view('" . ucfirst($this->module_name) . "\Views\index', \$data);
            }
        }
      ";
      file_put_contents($controllerPath . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . '.php', $template);
    } else {
      CLI::error("Controller already exists!");
    }
  }

  /**
   * Create models file
   */
  protected function createModel()
  {
    $modelPath = $this->createDir('Models');
    if (!file_exists($modelPath . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . 'Model.php')) {
      $template = "<?php 
      namespace " . ucfirst($this->module_name) . "\\Models;
      use CodeIgniter\Model;
      class " . ucfirst($this->module_name) . "Model extends Model 
      {
          protected \$table = '" . $this->module_name . "';
          protected \$allowedFields = [];
          protected \$beforeInsert = ['beforeInsert'];
          protected \$beforeUpdate = ['beforeUpdate'];          
          public function __construct()
          {
              parent::__construct();
          }          
          protected function beforeInsert(array \$data) {
              return \$data;
          }
          protected function beforeUpdate(array \$data) {
              return \$data;
          }
      }";
      file_put_contents($modelPath . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . 'Model.php', $template);
    } else {
      CLI::error("Model already exists!");
    }
  }

  /**
   * Create library file
   */
  protected function createLibrary()
  {
    $libPath = $this->createDir('Libraries');
    if (!file_exists($libPath . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . 'Lib.php')) {
      $template = "<?php 
        namespace " . ucfirst($this->module_name) . "\\Libraries;
        use " . ucfirst($this->module_name) . "\Models\\" . ucfirst($this->module_name) . "Model;
        class " . ucfirst($this->module_name) . "Lib {
            public function __construct() {
                \$config = config(App::class);
                \$this->response = new Response(\$config);
            }
        }";
      file_put_contents($libPath . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . 'Lib.php', $template);
    } else {
      CLI::error("Library already exists!");
    }
  }

  protected function createView()
  {
    $viewPath = $this->createDir('Views');
    if (!file_exists($viewPath . DIRECTORY_SEPARATOR . 'index.php')) {
      $routeName = strtolower($this->module_name);
      $template  = '<section><h1>' . strtolower($routeName) . ' module</h1><br><p>This is the new index page</p></section>';
      file_put_contents($viewPath . DIRECTORY_SEPARATOR . 'index.php', $template);
    } else {
      CLI::error("Index view already exists!");
    }
  }

  /**
   * Summary of create Other Directories
   * @return void
   */
  protected function createOtherDirs()
  {
    $this->createDir('Database', true);
    $this->createDir('Database/Migrations', true);
    $this->createDir('Database/Seeds', true);
    $this->createDir('Filters', true);
    $this->createDir('Language', true);
    $this->createDir('Validation', true);
  }

  /**
   * function createDir
   * 
   * Create directory and set, if required, gitkeep to keep this in git.
   * 
   * @param string $folder
   * @param string $gitkeep
   * @return string
   */

  protected function createDir($folder, $gitkeep = false)
  {
    $dir = $this->module_folder . DIRECTORY_SEPARATOR . ucfirst($this->module_name) . DIRECTORY_SEPARATOR . $folder;
    if (!is_dir($dir)) {
      mkdir($dir, 0777, true);
      if ($gitkeep) {
        file_put_contents($dir . '/.gitkeep', '');
      }
    }
    return $dir;
  }

  /**
   * function updateAutoload
   * 
   * Add a psr4 configuration to Config/Autoload.php file
   * 
   * @return boolean
   */

  protected function updateAutoload()
  {
    $Autoload = new \Config\Autoload;
    $psr4     = $Autoload->psr4;
    if (isset($psr4[ucfirst($this->module_name)])) {
      return false;
    }
    $file = fopen(APPPATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Autoload.php', 'r');
    if (!$file) {
      CLI::error("Config/Autoload.php nor readable!");
      return false;
    }

    $newcontent = '';
    $posfound   = false;
    $posline    = 0;

    /* $psr4Add = " ' " . ucfirst($this->module_name) . "' => " . 'ROOTPATH . ' . "'Modules\\" . ucfirst($this->module_name) . "',"; */
    $psr4Add = "        '" . ucfirst($this->module_name) . "'    => " . 'ROOTPATH . ' . "'Modules/" . ucfirst($this->module_name) . "',";
    /*
    if (CLI::getOption('f')== '') {
        $psr4Add = "                '".ucfirst($this->module_name) . "' => ". 'APPPATH . ' ."'Modules\\" . ucfirst($this->module_name)."',";
    } else {
        $psr4Add = "                '".ucfirst($this->module_name) . "' => ". 'ROOTPATH . ' . "'".$this->module_folderOrig."\\" . ucfirst($this->module_name)."',";
    }
    */

    while (($buffer = fgets($file, 4096)) !== false) {
      if ($posfound && strpos($buffer, ']')) {
        //Last line of $psr4
        $newcontent .= $psr4Add . "\n";
        $posfound   = false;
      }
      if ($posfound && $posline > 3 && substr(trim($buffer), -1) != ',') {
        $buffer = str_replace("\n", ",\n", $buffer);
      }
      if (strpos($buffer, 'public $psr4 = [')) {
        $posfound = true;
        $posline  = 1;
        //First line off $psr4
      }
      if ($posfound) {
        $posline++;
      }
      $newcontent .= $buffer;
    }

    $file = fopen(APPPATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Autoload.php', 'w');
    if (!$file) {
      CLI::error("Config/Autoload.php not writable!");
      return false;
    }
    fwrite($file, $newcontent);
    fclose($file);

    return true;
  }


}
