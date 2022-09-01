<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

    /**
     * Default Controller
     */
    
    public function __construct()
    {
        // Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Home Page
    public function index()
    {
        global $config;
        // Get banner
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(8);
        // Load View
        $this->load_view("index", $data);
    }
}