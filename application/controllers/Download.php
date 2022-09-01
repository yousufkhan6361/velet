<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends MY_Controller {

	/**
	 * Download Controller
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
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $data['content'] = $this->model_resource_download->find_all_active();


        // Load View
        $this->load_view("index", $data);
    }



}
