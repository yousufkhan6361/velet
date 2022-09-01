<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yeastech extends MY_Controller {

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
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $data['about_us'] = $this->model_cms_page->get_page(6);


        // Load View
        $this->load_view("index", $data);
    }

    // Shipping And Return
    public function shipping_and_return()
    {
        global $config;
        // Get banner
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $data['content'] = $this->model_cms_page->get_page(7);


        // Load View
        $this->load_view("shipping_and_return", $data);
    }

    // molecular-biology
    public function molecular_biology()
    {
        global $config;
        // Get banner
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $data['content'] = $this->model_cms_page->get_page(8);


        // Load View
        $this->load_view("molecular_biology", $data);
    }

    // Protocol
    public function protocol()
    {
        global $config;
        // Get banner
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $data['content'] = $this->model_cms_page->get_page(9);


        // Load View
        $this->load_view("protocol", $data);
    }

    // Yeastech 101
    public function yeastech_101()
    {
        global $config;
        // Get banner
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $data['content'] = $this->model_yeastech_101->find_all_active();


        // Load View
        $this->load_view("yeastech_101", $data);
    }



}
