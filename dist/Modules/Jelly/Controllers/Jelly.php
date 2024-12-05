<?php 
namespace Jelly\Controllers;
use CodeIgniter\Controller;

class Jelly extends Controller
{
    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        
    }
    
    /**
     * Index
     *
     * @return View
     */
    public function index()
    {
        $data = [];
        helper(['form']);
        
        return view('Jelly\Views\index', $data);
    }
}
