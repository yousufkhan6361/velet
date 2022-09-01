<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio extends MY_Controller {

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
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(10);

        $data['cms_title'] = $this->model_cms_title->find_all_by_page('home');

        $data['portfolio'] = $this->model_portfolio->get_portfolio();
        // Get Recent workj
        // Get Packagesj
        // Load View
        $this->load_view("index", $data);
    }

}