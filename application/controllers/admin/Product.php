<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MY_Controller {

    /**
     * product page
     *
     *
     * @version     1.0
     * @since       2017
     */

    public $_list_data = array();

    public function __construct() {

        global $config;

        parent::__construct();
        //$this->dt_params['dt_headings'] = "product_id,product_category_id,product_name,product_price,product_is_promotion,product_status";
        $this->dt_params['dt_headings'] = "product_id,product_name,product_status";
        $this->dt_params['searchable'] = array("product_id","product_category_id","product_name","product_status");
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

        //$para['where']['category_id > '] = 2;
        $this->_list_data['product_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");


        $this->_list_data['product_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");

        // $this->_list_data['product_color'] = $this->model_color->find_all_list_active(array(),"color_name");
        //debug($this->_list_data['product_category_id'],1 );

        /*$para['where']['category_type'] = 1;
        $this->_list_data['product_category_id'] = $this->model_category->find_all_list_active($para,"category_name");
        
        $para2['where']['category_type'] = 2;
        $this->_list_data['product_subcategory_id'] = $this->model_category->find_all_list_active($para2,"category_name");
        
        $para3['where']['category_type'] = 3;
        $this->_list_data['product_childcategory_id'] = $this->model_category->find_all_list_active($para3,"category_name");

        
        $para3['where']['category_type'] = 4;
        $this->_list_data['product_childcategory_id'] = $this->model_category->find_all_list_active($para3,"category_name");*/


        // Populating LISTDATA
        // $this->_list_data['product_brand_id'] = $this->model_brand->find_all_list_active(array(),"brand_name");
        // $this->_list_data['product_style_id'] = $this->model_style->find_all_list_active(array(),"style_name");

        // $this->_list_data['product_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
        // $this->_list_data['product_color_bridge'] = $this->model_product_color->find_all_list_active(array(),"product_color_name");

        /*$this->_list_data['product_kit'] = $this->model_kit->find_all_list_active(array('order'=>'kit_name ASC'),"kit_name");
        $this->_list_data['product_prep_size'] = $this->model_prep_size->find_all_list_active(array('order'=>'prep_size_name ASC'),"prep_size_name");*/

        // $this->_list_data['product_price'] = $this->model_pricing->find_all_list_active(array(),"pricing_amount");

        $_POST = $this->input->post(NULL, false);
    }

    public function index()
    {
        // Popluated LISTDATA in constructor
        parent::index();
    }

    public function add($id='', $data=array())
    {
        // Popluated LISTDATA in constructor
        $this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
        $this->register_plugins("jquery-file-upload");

        
        if($id)
        {
            
            $params = array();
            $params['where']['ads_gallery_ads_id'] = $id;
            $this->_list_data['adsImages'] = $this->model_ads_gallery->get_data($params);
            
        }

/*
        if(!$id)
        {
            $this->form_params = array(
                "action" => array(
                    "save_edit_attr" => "#tab_1" ,
                    "hide_save" => false ,
                    "hide_save_new" => false ,
                    "hide_cancel" => false ,
                ),
            );
        }*/



        parent::add($id, $data);
    }



    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */