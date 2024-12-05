<?php 
namespace Peanut\Libraries;
use Peanut\Models\PeanutModel;

class PeanutLib {

    public function __construct() {
        $config = config(App::class);
        $this->response = new Response($config);
    }

}