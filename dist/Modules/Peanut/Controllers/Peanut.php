<?php 
namespace Peanut\Controllers;
use CodeIgniter\Controller;

class Peanut extends Controller
{
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        
    }
    
    /**
     * Summary of index
     * @return string
     */
    public function index()
    {
        $data = [];
        helper(['form']);
        
        return view('Peanut\Views\index', $data);
    }
}
