<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authenticity extends MY_Controller {

	/**
	 * Terms_of_service Controller
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
        //$data['banner'] = $this->model_inner_banner->get_banner(2);
        $data['sec11'] = $this->model_cms_page->get_page(11);
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(7);
        // Set banner heading
        //$data['banner_heading'] = "Terms and Conditions";
        // Load View
        $this->load_view("index", $data);
    }



}
