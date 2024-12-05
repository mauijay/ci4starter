<?php 
        namespace Admin\Libraries;
        use Admin\Models\AdminModel;
        class AdminLib {
            public function __construct() {
                $config = config(App::class);
                $this->response = new Response($config);
            }
        }