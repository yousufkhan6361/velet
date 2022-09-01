<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_category extends MY_Controller {

    /**
     * Blog_category Controller. - The default controller
     *
     * @package		Blog - Controller
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
    public function index($slug='')
    {
        if(!empty($slug))
        {
            // Get slug response
            $blog_detail = $this->model_blog_category->find_by_slug($slug);

            //$data['banner'] = $this->model_banner->get_banners(8);
            // Set Blog info
            $data['detail'] = $blog_detail;
            // Set blog comments
            //$data['comments'] = $this->model_blog->get_comments($slug);
            // Set banner heading
            //$data['banner_heading'] = "Blog Detail";
            //$data['categories'] = $this->model_blog_category->get_recent_categories();
            //debug($data['categories'],1);
            // Load view
            $this->load_view("index" , $data);
        }
        // No slug
        else
        {
            redirect(l('404') , true);
        }
    }

    // Search Blog
    /*public function search()
    {
        $keyword = $this->input->get('search');
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
        $data['banner_heading'] = "Blog - Search";
        // Set data
        $data['blog_info'] = $this->_search_pagination($keyword);
        // Load view
        $this->load_view("search" , $data);
    }*/

    // Blog post pagination
    private function _pagination()
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/page/";
        $pagination["total_rows"] = $this->model_blog->get_total_count();
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 3;
        $pagination['last_tag_open'] = '';

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $vars["data"] = $this->model_blog
            ->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"]);

        $vars["links"] = $this->mypagination->create_links();

        return $vars;
    }

    // Blog search pagination
    private function _search_pagination($keyword)
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') .$this->router->fetch_class() . "/search/page/";
        $pagination["total_rows"] = $this->model_blog->get_total_count(array(), $keyword);
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 4;
        $pagination['last_tag_open'] = '';

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
        $vars["data"] = $this->model_blog
            ->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"], array(), $keyword);

        $vars["links"] = $this->mypagination->create_links();

        return $vars;
    }

    public function detail($slug = '')
    {
        // has slug
        if(!empty($slug))
        {
            // Get slug response
            $blog_detail = $this->model_blog->find_by_slug($slug);

            // Found slug in table
            if(array_filled($blog_detail))
            {
                //$data['banner'] = $this->model_banner->get_banners(8);
                // Set Blog info
                $data['detail'] = $blog_detail;
                //debug($data,1);
                // Set blog comments
                $data['comments'] = $this->model_blog->get_comments($slug);
                // Set banner heading
                //$data['banner_heading'] = "Blog Detail";
                $data['categories'] = $this->model_blog_category->get_recent_categories();
                //debug($data['categories'],1);
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
        $data = $this->model_blog_category->get_recent_categories();
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
                    'label'=>'Captcha',
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
            $category = $this->model_blog_category->find_by_slug($cat_slug);
            if(array_filled($category)){
                // Get banner
                $data['banner'] = $this->model_banner->get_banners(8);
                // Get categories
                $data['categories'] = $this->get_categories();
                // Get recent post
                $data['recent'] = $this->model_blog->get_recent_post();
                // Set data
                $data['blog_info'] = $this->_category_pagination($cat_slug,$category['blog_category_id']);
                // Load view
                $this->load_view("category" , $data);
            }
            else{
                redirect('/');
            }
        }
    }

    // Blog post pagination
    private function _category_pagination($cat_slug, $cat_id)
    {
        $this->load->library('mypagination');

        $pagination["base_url"] = g('base_url') . $this->router->fetch_class()."/category/".$cat_slug."/page/";
        $pagination["total_rows"] = $this->model_blog_category->get_total_count($cat_id);
        $pagination["per_page"] = 10;
        $pagination['use_page_numbers']  = TRUE;
        $pagination["uri_segment"] = 5;
        $pagination['last_tag_open'] = '';

        $this->mypagination->initialize($pagination);

        $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
        $vars["data"] = $this->model_blog_category
            ->get_pagination_data($pagination["per_page"], (($page > 0)?($page-1):($page)) * $pagination["per_page"], $cat_id);

        $vars["links"] = $this->mypagination->create_links();

        return $vars;
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */