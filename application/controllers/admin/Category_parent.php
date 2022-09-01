<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Category_parent extends MY_Controller {

	/**
	 * CSL Achievements page
	 *
	 * @package		category_parent
	 *category_parent
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;

		parent::__construct();
        //$this->dt_params['dt_headings'] = "category_parent_id,category_parent_page,category_parent_heading,category_parent_image,category_parent_status";
        $this->dt_params['dt_headings'] = "category_parent_id,category_parent_name,category_parent_status";
        $this->dt_params['searchable'] = array("category_parent_id","category_parent_heading","category_parent_status");

        $this->dt_params['action'] = array(
        								// "hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        $this->_list_data['category_parent_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-danger\">Inactive</span>" ,
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"
                                    );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";


		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];


        /*$this->_list_data['category_parent_page'] = array(
            'home'=>'Home',
            'wireless'=>'Wireless',
            'accessories'=>'Accessories',
            'about_us'=>'About Us',
            'news_info'=>'News & Info',
            'contact_us'=>'Contact Us',
        );*/

		//$this->_list_data['category_parent_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		//$this->_list_data['category_parent_product_id'] = $this->model_product->find_all_list_active(array(),"product_name");

        //$_POST = $this->input->post(NULL, true);  // return POST with xss filter
        $_POST = $this->input->post(NULL, false); // return POST without xss filter
	}

	public function add($id='', $data=array())
	{
        $this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
		parent::add($id, $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */