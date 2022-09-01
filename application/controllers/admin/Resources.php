<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resources extends MY_Controller {

    /**
     * Resources page
     *
     * @package
     *
     * @version     1.0 --
     * @since       Version 1.0 2019
     */

    public $_list_data = array();

    public function __construct() {

        global $config;
        
        parent::__construct();
        $this->dt_params['dt_headings'] = "resources_id,resources_title,resources_status";
        $this->dt_params['searchable'] = array("resources_id","resources_title","resources_status");
        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        
        $this->_list_data['resources_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
        $this->_list_data['resources_is_featured'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-default\">No</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Yes</span>"  
                                    );
        // Following are common so, defined in MY_Controller_Admin
        // $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
        // $this->dt_params['paginate']['uri'] = "paginate";
        // $this->dt_params['paginate']['update_status_uri'] = "update_status";

        // For use IN JS Files
        //$this->_list_data['resources_type'] = $this->resources_type_list();
        $config['js_config']['paginate'] = $this->dt_params['paginate'];
        
        // Populating LISTDATA

        $_POST = $this->input->post(NULL, false);
    }
    
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
