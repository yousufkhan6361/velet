<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends MY_Controller {

	/**
	 * Testimonial Controller
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

        // Get testimonials
        $data['content'] = $this->model_testimonial->find_all_active();
        // Set banner heading
        $data['banner_heading'] = "Testimonials";
        // Load View
        $this->load_view("index", $data);
    }



}
