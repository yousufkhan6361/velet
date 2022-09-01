<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MY_Controller {

	/**
	 * Privacy_policy Controller
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Page
    public function index()
    {
        global $config;
        $data['banner'] = $this->model_inner_banner->get_banner(16);
        // Get and set cms data
        $data['content'] = $this->model_cms_page->get_page(12);
        // Set banner heading
        //$data['banner_heading'] = "Privacy Policy";
        // Load View
        $this->load_view("index", $data);
    }



}
