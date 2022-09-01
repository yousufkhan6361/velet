<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy_policy extends MY_Controller {

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
        //$data['banner'] = $this->model_inner_banner->get_banner(3);
        $data['sec7'] = $this->model_cms_page->get_page(7);
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(7);
        $data['faq'] = $this->model_faq->find_all_active();
        // Set banner heading
        //$data['banner_heading'] = "Privacy Policy";
        // Load View
        $this->load_view("index", $data);
    }



}
