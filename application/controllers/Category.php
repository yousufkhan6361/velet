<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Category extends MY_Controller {



	/**

	 * news Controller. - The default controller

	 *

	 * @package		news - Controller

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

        $data['categories'] = $this->model_category->find_all_active();
        //debug($data['categories']);

		//$data['news_info'] = $this->_pagination();

        //debug($data['newss'],1);

        // Load view

		$this->load_view("index" , $data);

	}



    public function detail($slug = '')

    {

    	// debug($slug,1);

        // has slug

        if(!empty($slug))

        {

            // Get slug response

            $category_detail = $this->model_category->find_by_slug($slug);



            // Found slug in table

            if(array_filled($category_detail))

            {

                //$data['banner'] = $this->model_banner->get_banners(8);



                // $data['inner_banner'] = $this->model_inner_banner->find_by_pk(9);

                // Set news info

                $data['detail'] = $category_detail;

                $data['parent_c '] = $this->model_category_parent->find_all_active();

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



    // Info for Sub category

    public function info($slug='')

    {

        if(!empty($slug))

        {

            // Get slug response

            $category_detail = $this->model_category->find_by_slug_all($slug);



            // Found slug in table

            if(array_filled($category_detail))

            {

                //$data['banner'] = $this->model_banner->get_banners(8);



                // $data['inner_banner'] = $this->model_inner_banner->find_by_pk(9);

                // Set news info

                $data['detail'] = $category_detail;

                // debug($data['detail']);

                // Set news comments

                //$data['comments'] = $this->model_news->get_comments($slug);

                // Set banner heading

                //$data['banner_heading'] = "news Detail";

                // Load view

                $this->load_view("info" , $data);

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