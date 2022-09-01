<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shrimps_snails extends MY_Controller {

	/**
	 * Contact US Controller
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
        // Get banner
        $data['sec4'] = $this->model_cms_page->get_page(4);
        $data['sec9'] = $this->model_cms_page->get_page(9);
        // Load View
        $this->load_view("index", $data);
    }
}