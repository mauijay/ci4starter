<?php 
        namespace Admin\Controllers;
        use CodeIgniter\Controller;
        class Dashboard extends Controller
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
             * @since version 0.1.0
             * @author Jay Lamping <jaycadla@gmail.com>
             */
            public function index()
            {
                $data = [];
                helper(['form']);
                
                return view('Admin\Views\index', $data);
            }
        }
      