<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Technical_document extends MY_Controller {

	/**
	 * technical_document page
	 *
	 * @package
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "technical_document_id,technical_document_title,technical_document_part_number,technical_document_status";
        $this->dt_params['searchable'] = array("technical_document_id","technical_document_title","technical_document_status");
        $this->dt_params['action'] = array(
                                        "hide_add_button" => false ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        
        $this->_list_data['technical_document_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-danger\">Inactive</span>" ,
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files
		$config['js_config']['paginate'] = $this->dt_params['paginate'];
		
		// Populating LISTDATA

		$_POST = $this->input->post(NULL, false);
	}
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
