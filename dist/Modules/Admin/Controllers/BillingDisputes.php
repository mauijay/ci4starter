<?php 
        namespace Admin\Controllers;
        use CodeIgniter\Controller;
        class BillingDisputes extends Controller
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
             * Summary of dispute
             * @param mixed $id
             * @return string
             * @since version 0.1.0
             * @author Jay Lamping <jaycadla@gmail.com>
             */
            public function dispute($id)
            {
                $data = [];
                helper(['form']);
                
                return view('Admin\Views\billing_disputes', $data);
            }
        }
      