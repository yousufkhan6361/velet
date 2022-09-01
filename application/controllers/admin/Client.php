<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends MY_Controller {

    /**
     * client page
     *
     * @package		TKD
     * @author		Babar Hussaini
     * @version		2.0 -- Robust , Advanced And More Frustating...
     * @since		Version 2.0 2014
     */

    public $_list_data = array();

    public function __construct() {

        global $config;

        parent::__construct();
        $this->dt_params['dt_headings'] = "client_id,client_name,client_image,client_status";
        $this->dt_params['searchable'] = array("client_id","client_name","client_status");
        $this->dt_params['action'] = array(
            "hide_add_button" => false ,
            "hide" => false ,
            "show_delete" => true ,
            "show_edit" => true ,
            "order_field" => false ,
            "show_view" => false ,
            "extra" => array() ,
        );

        $this->_list_data['client_status'] = array(
            STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,
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
