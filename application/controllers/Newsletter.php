<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class newsletter extends MY_Controller {

	/**

	 * newsletter Controller

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

        $this->layout_data['title'] = "Newsletter | ".g('site_name');

        // $data['banner'] = $this->model_inner_banner->get_banner(5);




        // $data['newsletter'] = $this->model_faq->find_all_active();
        // debug($data['faqs_2'],1);   
        

        $this->load_view("index", $data);

    }     
}

