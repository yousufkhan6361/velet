<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MY_Controller {

    /**
     * product Controller. - The default controller
     *
     * @package		product - Controller
     * @author		Mike Jason
     * @version		1.0
     * @since
     */

    private $json_param = array();

    public function __construct()
    {
        // Call the Model constructor latest_product
        parent::__construct();
    }

    // Default index page
    public function index($id='')
    {
        // Set banner heading
        //$data['banner_heading'] = "product";
        // Get banner
        //$data['banner'] = $this->model_banner->get_banners(8);
        // Get categories
        //$data['categories'] = $this->get_categories();
        // Get recent post
        //$data['recent'] = $this->model_product->get_recent_post();
        // Set data
        $data['product_info'] = $this->_pagination();
        // Load view
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(3);
        $this->load_view("index" , $data);
    }
    public function save_stock_email()
    {
        global $config;
        // debug($_POST,1);
        if (count($_POST) > 0) {
            if ($this->validate("model_stock_email")) {
                $form_name = 'stock_email';
                $data['stock_email_email'] = $_POST['stock_email']['stock_email_email'];
                $data['stock_email_status'] = 1;
                $inserted_id = $this->model_stock_email->insert_record($data);
                // debug($inserted_id,1);

                if ($inserted_id > 0) {
                    $param['status'] = 1;
                    $param['txt'] = 'Thank you for Subscribing.';
                    echo json_encode($param);

                } else {
                    $param['status'] = 0;
                    $param['txt'] = 'Due to some error, email not send';
                    echo json_encode($param);
                }
            } else {
                $param['status'] = 0;
                $param['txt'] = validation_errors();
                echo json_encode($param);
            }

        }
        else {
                $param['status'] = 0;
                $param['txt'] = validation_errors();
                echo json_encode($param);
            }

    }

    // Search product
    public function search()
    {
        $keyword = $this->input->get('search');
        $category_id = $this->input->get('category_id');
        if(!empty($keyword)){
            $this->session->set_userdata('search_keyword',$keyword);
        }
        else{
            if($this->session->userdata('search_keyword')==null){
                redirect(g('base_url'));
            }
            else{
                $keyword = $this->session->userdata('search_keyword');
            }
        }

        // Set banner heading
        $data['banner_heading'] = "Product - Search ($keyword)" ;
        // Set data
        $data['product_info'] = $this->_search_pagination($keyword,$category_id);

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(3);
        // Load view
        $this->load_view("search" , $data);
    }

    // product post pagination
    private function _pagination()
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/page/";
        $pagination["total_rows"] = $this->model_product->get_total_count();
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 3;
        $pagination['last_tag_open'] = '';

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $vars["data"] = $this->model_product
            ->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"]);

        $vars["links"] = $this->mypagination->create_links();

        return $vars;
    }

    // product search pagination
    private function _search_pagination($keyword, $category_id=0)
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') .$this->router->fetch_class() . "/search/page/";
        $pagination["total_rows"] = $this->model_product->get_total_count(array(),$keyword,$category_id);
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 4;
        $pagination['last_tag_open'] = '';

        if(isset($_GET) && array_filled($_GET)){
            $suffix = '?'.http_build_query($_GET,'',"&amp;");
            $pagination['first_url'] = '1' . $suffix;
            $pagination['suffix'] = $suffix;
        }

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
        $vars["data"] = $this->model_product
            ->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"], array(), $keyword, $category_id);

        $vars["links"] = $this->mypagination->create_links();

        return $vars;
    }

    public function detail($slug = '')
    {
        // has slug
        if(!empty($slug))
        {
            $data['inner_banner'] = $this->model_inner_banner->find_by_pk(10);
            // Get slug response
            $product_detail = $this->model_product->find_by_slug($slug);

            // Found slug in table
            if(array_filled($product_detail))
            {
                //$data['banner'] = $this->model_banner->get_banners(8);
                // Set product info
                $data['detail'] = $product_detail;
                $product_id = $data['detail']['product_id'];
                $data['category_detail'] = $this->model_category->find_by_pk($data['detail']['product_category_id']);

                // $param = array();
                // $param['where']['ps_product_id'] = $product_id;
                // $data['color'] = $this->model_product_color->find_all_active($param);
                // Get product images
                $data['product_images'] = $this->model_product_image->get_images_list($product_id);
                // Get all Kits
                $param = array();
                $param['where']['product_id !='] = $product_id;
                $param['limit'] = 8;
                $data['related_products'] = $this->model_product->find_all_active($param);


                // Set product comments
                //$data['comments'] = $this->model_product->get_comments($slug);
                // Set banner heading
                //$data['banner_heading'] = "product Detail";
                $this->register_plugins(array('slick','fancybox'));
                // Load view
                $this->load_view("detail" , $data);
            }
            // Not found
            else
            {
                redirect(l('404') , true);
            }
        }
        // No slug
        else
        {
            redirect(l('404') , true);
        }
    }

    // Get categories (Get recent categories 5)
    public function get_categories()
    {
        // Get data
        $data = $this->model_product_category->get_recent_categories();
        // Return
        return $data;
    }


    public function comment_save()
    {
        $comment = $this->input->post('comment');

        if(isset($_POST) && array_filled($comment))
        {
            $custom_rule = array(
                'g-recaptcha-response'=>array(
                    'field'=>'g-recaptcha-response',
                    'label'=>'Capctcha',
                    'rules'=>'required'
                )
            );

            if($this->validate("model_comment", $custom_rule))
            {
                $this->model_comment->set_attributes($comment);
                $inserted_id = $this->model_comment->save();


                $this->json_param['status'] = 1;
                $this->json_param['txt'] = 'Your comment has been submitted successfully.Waiting for Admin approval.';

            }
            else
            {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = validation_errors();
            }

            echo json_encode($this->json_param);
        }
    }

    // Category page
    public function category($cat_slug='')
    {
        if(empty($cat_slug)){
            redirect('/');
        }
        else{
            // Check category slug
            $category = $this->model_category->find_by_slug($cat_slug);
            if(array_filled($category)){
                // Get banner
                // Set banner heading
                //$data['banner_heading'] = "product";
                // Get banner
                //$data['banner'] = $this->model_banner->get_banners(8);
                // Get categories
                //$data['categories'] = $this->get_categories();
                // Get recent post
                //$data['recent'] = $this->model_product->get_recent_post();
                // Set data
                $data['category'] = $category;

                $param = array();
                $param['where_like'][] = array(
                    'column'=>'inner_banner_name',
                    'value'=>$data['category']['category_name'],
                    'type'=>'both',
                );
                $data['inner_banner'] = $this->model_inner_banner->find_by_pk(15);
                $data['category_name'] = $category['category_name'];

                $data['product_info'] = $this->_category_pagination($cat_slug,$category['category_id']);

                $data['all_categories'] = $this->model_category->find_all_active();

                $param = array();
                $param['where']['product_category_id !='] = $data['category']['category_id'];
                $data['rest_products'] = $this->model_product->find_all_active($param);

                $param = array();
                $param['where']['product_status'] = 1;
                $data['featured_products'] = $this->model_product->find_all_active($param);

                $data['content'] = $this->model_cms_page->get_page(11);
                // debug($data['product_info'],1);

                // Load view
                $this->load_view("index" , $data);
            }
            else{
                redirect('/');
            }
        }
    }

    // product post pagination
    private function _category_pagination($cat_slug, $cat_id)
    {
        $this->load->library('mypagination');

        //$pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/category/".$cat_slug."/page/";
        $pagination["base_url"] = g('base_url') . "category/".$cat_slug."/page/";
        $pagination["total_rows"] = $this->model_category->get_total_count($cat_id);
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 4;
        $pagination['last_tag_open'] = '';

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
        $vars["data"] = $this->model_category
            ->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"], $cat_id);

        $vars["links"] = $this->mypagination->create_links();
        // debug($vars,1);
        return $vars;
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */