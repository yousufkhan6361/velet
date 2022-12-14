
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends MY_Controller {

    /**
     * Achievements page
     *
     * @package     brand
     *
     * @version     1.0
     */

    public $_list_data = array();

    public function __construct() {

        global $config;

        parent::__construct();
        $this->dt_params['dt_headings'] = "brand_id,brand_name,brand_image,brand_status";
        $this->dt_params['searchable'] = array("brand_name","brand_status");
        $this->dt_params['action'] = array(
            "hide_add_button" => false ,
            "hide" => false ,
            "show_delete" => true ,
            "show_edit" => true ,
            "order_field" => false ,
            "show_view" => false ,
            "extra" => array() ,
        );

        /*$this->_list_data['product_status'] = array(
            STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,
            STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"
        );*/

        // For use IN JS Files
        $config['js_config']['paginate'] = $this->dt_params['paginate'];

        $_POST = $this->input->post(NULL, false);
    }

    public function add($id='',$data = array())
    {
        $this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
        //$params = array(
        //  'order'=>'brand_parent_id,brand_name',
        //  'where_in'=>array('brand_parent_id' => array(0,1))
        //);
        //$this->_list_data['brand_parent_id'] = $this->model_brand->find_all_list_active(array(),"brand_name");
        
        //$this->_list_data['brand_parent_id'] = $this->model_brand->find_all_list_active($params,"brand_name");
        parent::add($id);
    }

    public function index($data = array())
    {
        //$this->_list_data['brand_parent_id'] = $this->model_brand->find_all_list_active(array(),"brand_name");
        parent::index();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
