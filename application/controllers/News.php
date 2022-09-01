<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class News extends MY_Controller {

    private $json_param = array();

	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();

    }



    // Default index page

	public function index()

	{

        // Set banner heading

        //$data['banner_heading'] = "news";

        // Get banner

        //$data['banner'] = $this->model_banner->get_banners(8);

        //$data['banner'] = $this->model_inner_banner->find_by_pk(4);

        //debug($data['banner'],1);

        // Get categories

        //$data['categories'] = $this->get_categories();

        // Get recent post

        //$data['recent'] = $this->model_news->get_recent_post();

        // Set data

        $data['newss'] = $this->model_news->find_all_active();

		//$data['news_info'] = $this->_pagination();

        //debug($data['news'],1);

        // Load view

		$this->load_view("index" , $data);

	} 



    public function detail()
    {
        $slug = $this->uri->segment(2);

        // has slug
        if(!empty($slug))
        {
            // Get slug response
            $param['where']['news_slug'] = $slug;
            $news_detail = $this->model_news->find_one($param);
            //debug($news_detail,1);
            // Found slug in table
            if(array_filled($news_detail))
            {
                //$data['banner'] = $this->model_banner->get_banners(8);
               // $data['inner_banner'] = $this->model_inner_banner->find_by_pk(9);
                // Set news info
                $data['detail'] = $news_detail;
                // debug($data['detail']);
                // Set news comments
                //$data['comments'] = $this->model_news->get_comments($slug);
                // Set banner heading
                //$data['banner_heading'] = "news Detail";
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



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */