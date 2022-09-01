<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	/**
	 * Search Controller
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Page
    public function index()
    {
        // Has get value
        if((isset($_GET)) && (count($_GET)>0)){
            // Set banner heading
            $data['banner_heading'] = "Search - Item";
            // Set data
            $data['item_info'] = $this->_pagination();
            //debug($data,1);
            // Load view
            $this->load_view("index" , $data);
        }
        // Get value not found
        else{
            redirect('/');
        }
    }

    // Pagination
    private function _pagination()
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/page/";
        $pagination["total_rows"] = $this->model_item->get_total_count();
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 3;
        $pagination['last_tag_open'] = '';
        if(isset($_GET) && array_filled($_GET)){
            $suffix = '?'.http_build_query($_GET,'',"&amp;");
            $pagination['first_url'] = '1' . $suffix;
            $pagination['suffix'] = $suffix;
        }

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $vars["data"] = $this->model_item->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"]);

        $vars["links"] = $this->mypagination->create_links();

        return $vars;
    }



}
