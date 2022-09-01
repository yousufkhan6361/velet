<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Application extends MY_Controller {

	/**
	 * application Achievements page
	 *
	 * @package		application
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "application_id,application_name,application_image,application_status";
        $this->dt_params['searchable'] = array("application_id","application_name","application_status");
        $this->dt_params['action'] = array(
        								"hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

        $this->_list_data['application_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='')
	{
		parent::add($id);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
