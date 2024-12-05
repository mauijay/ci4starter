<?php 
        namespace Cars\Controllers;
        use CodeIgniter\Controller;
        class Cars extends Controller
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
                $data = [];
                helper(['form']);
                
                return view('Cars\Views\index', $data);
            }
        }
      