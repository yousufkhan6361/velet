<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends MY_Controller {

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
        // $data['sec2'] = $this->model_cms_page->get_page(2);
        // $data['sec5'] = $this->model_cms_page->get_page(5);
        // $data['inner_banner'] = $this->model_inner_banner->find_by_pk(2);
        // $data['testimonial'] = $this->model_testimonial->find_all_active();
        // Load View
        $this->load_view("index", $data);
    }


    public function privacy()
    {
        global $config;
        // Load View
        $this->load_view("privacy", $data);
    }
    
    public function terms()
    {
        global $config;
        // Load View
        $this->load_view("terms", $data);
    }
    
     public function advertise()
    {
        global $config;
        // Load View
        $this->load_view("advertise", $data);
    }

    public function chooseus()
    {
        global $config;
        // Load View
        $this->load_view("chooseus", $data);
    }
}