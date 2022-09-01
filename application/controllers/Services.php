<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MY_Controller
{
    /**
     * service Controller
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

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(22);
        // Get and set cms data
        $data['services'] = $this->model_service->find_all_active();

        $data['sec2'] = $this->model_cms_page->get_page(2);

        $data['pricings'] = $this->model_pricing->find_all_active();
        
        $data['sec3'] = $this->model_cms_page->get_page(3);

        $this->load_view("index", $data);
    }

    public function detail($slug = '')
    {
        global $config;
        if (!empty($slug)) {
            // $data['bg_service_details'] = $this->model_inner_banner->find_one(
            //                array('where'=>array('inner_banner_id'=>3,'inner_banner_status'=>1)));
            $parm['where']['service_slug'] = $slug;
            $data['service_details'] = $this->model_service->find_one($parm);
            $this->load_view("detail", $data);
        } else {
            redirect(l('404'), true);
        }
    }
//     public function search ()
//         {
// // debug($_GET['search'],1);
//         if(isset($_GET['search']) && !empty($_GET['search']))
//         {
//         $slug = trim($_GET['search']);
//         $param['where_string'] = "service_title LIKE '%".$slug."%'  ";
//         $data['services'] = $this->model_services->find_all_active($param);
//         // echo $this->db->last_query();
//        // debug($data['servicess'],1);
//             $this->load_view("search", $data);
//         }
//         else{
//             redirect(g('base_url'));
//         }
//     }

}