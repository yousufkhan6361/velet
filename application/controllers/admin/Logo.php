<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Logo extends MY_Controller {

	/**
	 * Achievements page
	 *
	 * @package		logo
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "logo_id,logo_name,logo_src,logo_status";
        $this->dt_params['searchable'] = array("logo_id","logo_name","logo_status");
        $this->form_params['action'] = array(
        	'hide_save' => true,
        	'hide_save_new' => true
    	);

		$this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        
        $this->_list_data['logo_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files
		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='',$data=array())
	{
		$this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );

		parent::add($id, $data);
	}

	// BeforeRender Hook to manipulate Overrides... for Add Method
	public function before_add_render(&$data)
	{
		$this->layout_data['bread_crumbs'] = array(
											array(
												"home/"=>"Home" , 
												'logo/add/1' => "Logo",
												//$class_name."/add/" => "Add ".humanize($class_name),
											)
										);
		return true;
	}

	public function index()
	{
		//$this->_list_data['category_parent_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		parent::index();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
