<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends MY_Controller {

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

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(20);
        $data['sec3'] = $this->model_cms_page->get_page(3);
        $data['sec4'] = $this->model_cms_page->get_page(4);
        $data['pricings'] = $this->model_pricing->find_all_active();
        $data['faqs'] = $this->model_faq->find_all_active();
        $data['sec5'] = $this->model_cms_page->get_page(5);
        // debug($data['testimonials'],1);
        $data['sec9'] = $this->model_cms_page->get_page(9);
        // Load View
        $this->load_view("index", $data);
    }
}