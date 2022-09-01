<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Promotional_banner extends MY_Controller {

	/**
	 * CSL Achievements page
	 *
	 * @package		banner
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "banner_id,banner_title,banner_image,banner_page,banner_status";
        $this->dt_params['searchable'] = array("banner_id","banner_title","banner_page","banner_status");
       	$this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => false ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];
		
		//$this->_list_data['banner_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		//$this->_list_data['banner_product_id'] = $this->model_product->find_all_list_active(array(),"product_name");

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='')
	{
		$this->layout_data['additional_tools'][] = "jstree";
		//$this->_list_data['banner_page'] = array("slider"=>"slider","right"=>"right","bottom"=>"bottom");
		parent::add($id);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
