<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_of_service extends MY_Controller {

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

        // Get and set cms data
        $data['terms_of_service'] = $this->model_cms_page->get_page(4);
        // Set banner heading
        $data['banner_heading'] = "Terms of Service";
        // Load View
        $this->load_view("index", $data);
    }



}
