<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchandise extends MY_Controller {

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
        $data['categories'] = $this->get_categories(2);
        $data['brands'] = $this->get_brands(2);
        $data['styles'] = $this->get_style(2);
        // Get recent post
        //$data['recent'] = $this->model_product->get_recent_post();
        // Set data
        $data['product_info'] = $this->_pagination();
        //exit;
        // Load view
        $this->load_view("index" , $data);
    }

    // product post pagination
    private function _pagination()
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/page/";
        //$pagination["total_rows"] = $this->model_product->get_total_count();
        $pagination["total_rows"] = $this->model_product->get_total_count_merchandise();
        $pagination["per_page"] = 12;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 3;
        $pagination['last_tag_open'] = '';

        // For GET Filters
        $pagination['suffix'] = '?' . http_build_query($_GET, '', "&");
        $pagination["first_url"] = "1" . $pagination['suffix'];

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $vars["data"] = $this->model_product
            ->get_pagination_data_merchandise($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"]);
        $vars["links"] = $this->mypagination->create_links();

        return $vars;
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
        // Load view
        $this->load_view("search" , $data);
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
            // Get slug response
            $product_detail = $this->model_product->find_by_slug($slug);

            // Found slug in table
            if(array_filled($product_detail))
            {
                //$data['banner'] = $this->model_banner->get_banners(8);
                // Set product info
                $data['detail'] = $product_detail;
                $product_id = $data['detail']['product_id'];
                // Get product images
                //$data['product_images'] = $this->model_product_image->get_images_list($product_id);
                // Get all Kits
                //$data['kits'] = $this->model_product_kit->find_by_id($product_id);
                // Get all Prep size
                //$data['prep_size'] = $this->model_product_prep_size->find_by_id($product_id);
                //debug($data);
                // Set product comments
                //list($data['comments'], $data['count'], $data['avg_rating']) = $this->model_comment->get_comments($product_detail['product_id']);
                list($comments, $count, $avg_rating) = $this->model_comment->get_comments($product_detail['product_id']);
                //debug($comments,1);

                $x=0;
                $y=0;
                foreach ($avg_rating as $key=>$value):
                    $x = $x + $value['comment_rating'] * $value['total'];
                    $y = $y + $value['total'];
                endforeach;
                $avg_rating = ($y>0)? ($x) / ($y) : 0;

                $data['comments'] = $comments;
                $data['count'] = $count;
                $data['avg_rating']= ceil($avg_rating);

                // Get product colors
                $data['colors'] = $this->model_product_color->find_all_product_color($product_id);;

                // Set banner heading
                //$data['banner_heading'] = "product Detail";
                //$this->register_plugins(array('slick','fancybox'));
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
    public function get_categories($type=1)
    {
        // Get data
        $data = $this->model_category->get_recent_categories($type);
        // Return
        return $data;
    }
    // Get categories (Get recent categories 5)
    public function get_brands($type=1)
    {
        // Get data
        $data = $this->model_brand->get_recent_brands($type);
        // Return
        return $data;
    }
    // Get categories (Get recent categories 5)
    public function get_style($type=1)
    {
        // Get data
        $data = $this->model_style->get_recent_style($type);
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
                $data['product_info'] = $this->_category_pagination($cat_slug,$category['category_id']);
                // Load view
                $this->load_view("category" , $data);
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

        return $vars;
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */