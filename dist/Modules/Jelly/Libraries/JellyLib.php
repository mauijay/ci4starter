<?php 
namespace Jelly\Libraries;
use Jelly\Models\JellyModel;

class JellyLib {

    public function __construct() {
        $config = config(App::class);
        $this->response = new Response($config);
    }

}