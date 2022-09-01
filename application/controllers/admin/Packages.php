<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packages extends MY_Controller {

    /**
     * Achievements page
     *
     * @package     packages
     *
     * @version     1.0
     * @since       Version 1.0 2017
     */

    public $_list_data = array();

    public function __construct() {

        global $config;

        parent::__construct();
        $this->dt_params['dt_headings'] = "packages_id,packages_name,packages_status";
        $this->dt_params['searchable'] = array("packages_name","packages_status");
        $this->dt_params['action'] = array(
            "hide_add_button" => true ,
            "hide" => false ,
            "show_delete" => false ,
            "show_edit" => true ,
            "order_field" => false ,
            "show_view" => false ,
            "extra" => array() ,
        );

        /*$this->_list_data['packages_is_featured'] = array(
            STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,
            STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"
        );*/



        // Following are common so, defined in MY_Controller_Admin
        // $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
        // $this->dt_params['paginate']['uri'] = "paginate";
        // $this->dt_params['paginate']['update_status_uri'] = "update_status";

        // For use IN JS Files
        $config['js_config']['paginate'] = $this->dt_params['paginate'];

        $_POST = $this->input->post(NULL, false);
    }

    public function add($id='',$data = array())
    {
        $this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
        //$params = array(
        //  'order'=>'packages_parent_id,packages_name', 
        //  'where_in'=>array('packages_parent_id' => array(0,1))
        //);
        $this->_list_data['packages_parent_id'] = $this->model_packages->find_all_list_active(array(),"packages_name");
        
        //$this->_list_data['packages_parent_id'] = $this->model_packages->find_all_list_active($params,"packages_name");
        parent::add($id);
    }

    public function index($data = array())
    {
        $this->_list_data['packages_parent_id'] = $this->model_packages->find_all_list_active(array(),"packages_name");
        parent::index();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
