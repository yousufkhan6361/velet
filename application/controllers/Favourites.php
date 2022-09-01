<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favourites extends MY_Controller {

	/**
	 * Default Controller
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Home Page
	public function index()
    {
        // debug(phpinfo(),1);
        global $config;
        // Get banner
        // $data['banner'] = $this->model_banner->find_all_active();
        // $data['assets'] = $this->model_assets->find_all_active();
        // $data['sec1'] = $this->model_cms_page->get_page(1);
        // $data['blogs'] = $this->model_blog->find_all_active();
        // $data['sec2'] = $this->model_cms_page->get_page(2);
        // $data['sec3'] = $this->model_cms_page->get_page(3);
        // $data['sec4'] = $this->model_cms_page->get_page(4);
        // $data['testimonial'] = $this->model_testimonial->find_all_active();

        // $param = array();
        // $param['where']['product_is_featured'] = 1;
        // $param['limit'] = 8;
        // $data['products'] = $this->model_product->find_all_active($param);

        // debug($data['banner'],1);
        
        // Load View
        $this->load_view("index", $data);
    }
}
