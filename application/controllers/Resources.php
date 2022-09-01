<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resources extends MY_Controller {
	/**
	 * Resources Controller
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
        $data['banner'] = $this->model_inner_banner->get_banner(4);
        $data['resources'] = $this->model_resources->find_all_active();
        $this->load_view("index", $data);

    }     
}