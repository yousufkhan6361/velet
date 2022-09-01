<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Gallery extends MY_Controller {

	/**
	 * gallery Achievements page
	 *
	 * @package		gallery
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "gallery_id,gallery_name,gallery_image,gallery_status";
        $this->dt_params['searchable'] = array("gallery_id","gallery_name","gallery_status");
        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                        "hide_add_button"=>false
                                      );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

        $this->_list_data['gallery_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
		// For use IN JS Files

		//$this->_list_data['gallery_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");

		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}


	public function add($id='', $data=array())
	{
		// Popluated LISTDATA in constructor

		$this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
		$this->register_plugins("jquery-file-upload");
		/*$this->form_data['gallery_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		$this->_list_data['gallery_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");*/
		
		
		parent::add($id, $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
