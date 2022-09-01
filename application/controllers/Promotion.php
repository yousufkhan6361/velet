<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotion extends MY_Controller {

	/**
	 * Default Controller
	 */

    private $json_param = array();
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    public function index($id='')
    {
        $cat = "promotions";
        
        //debug($cat);
        
        $param1['where']['category_slug'] = $cat;
        $category2 = $this->model_category->find_one($param1);
        
        $catid2 = $category2['category_id'];
            
        $param['where']['ads_category_id'] = $catid2;
        $data['ads'] = $this->model_ads->find_all_active($param);
        
         $catName = $category2['category_name'];

         $data['catName'] = $catName;


         $data['imgPath'] = g('base_url').$category2['category_image_path'].$category2['category_image'];

         //debug($data['imgPath'],1);
             
             //debug($category2,1);
            //debug($data['imgPath'],1);
             
            // $param3['where']['ads_category_id'] = $catId;
            // $data['ads'] = $this->model_ads->find_all_active($param3);
       
        // Load view
        $this->load_view('index', $data);
    }

    // product post pagination
    // private function _pagination()
    // {
    //     $this->load->library('mypagination');

    //     $pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/page/";
    //     $pagination["total_rows"] = $this->model_product->get_total_count_promotion();
    //     $pagination["per_page"] = 10;
    //     $pagination['use_page_numbers']  = TRUE;
    //     $pagination["uri_segment"] = 3;
    //     $pagination['last_tag_open'] = '';

    //     $this->mypagination->initialize($pagination);

    //     $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
    //     $vars["data"] = $this->model_product
    //         ->get_promotion_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"]);

    //     $vars["links"] = $this->mypagination->create_links();

    //     return $vars;
    // }


}
