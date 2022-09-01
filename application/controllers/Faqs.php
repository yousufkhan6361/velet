<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends MY_Controller {

	/**

	 * Faqs Controller

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

        $this->layout_data['title'] = "Faq's | ".g('site_name');

        // $data['banner'] = $this->model_inner_banner->get_banner(5);




        $data['faqs'] = $this->model_faq->find_all_active();
        // debug($data['faqs_2'],1);   
        

        $this->load_view("index", $data);

    }     
}

