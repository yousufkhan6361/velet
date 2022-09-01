<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Inner_banner extends MY_Controller {

	/**
	 * CSL Achievements page
	 *
	 * @package		inner_banner
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "inner_banner_id,inner_banner_name,inner_banner_status";
        $this->form_params['action'] = array(
            'hide_save_new' => true
        );        
        $this->dt_params['searchable'] = array("inner_banner_id","inner_banner_name","inner_banner_status");
        
        $this->dt_params['action'] = array(
                                        "hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => false ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        
        $this->_list_data['inner_banner_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-danger\">Inactive</span>" ,
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );

         $this->form_params['action'] = array(
                                    'hide_save' => true,
                                    'hide_save_new' => false
                                );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];


        $this->_list_data['inner_banner_page'] = array(
            '1'=>'MPJE/CPJE',
            '2'=>'Terms & Condition',
            '3'=>'Privacy Policy',
            '4'=>'Resources',
            '5'=>'About Us',
            '6'=>'Contact Us',
            '7'=>'Sign Up',
            '8'=>'Login',
            '9'=>'Naplex',
            '10'=>'Mpje/cpje',
            '11'=>'Checkout',
            '12'=>'Fpgee',
            '13'=>'Pharmacy',
            '21'=>'Nursing Calculations',
            '22'=>'Pharmacy Technician',
            '31'=>'Pharmacy Technician Pharmaceutical Calculations',
            '23'=>'Naplex Biostatistics',
            '24'=>'Naplex Poster',
            '25'=>'Naplex Printed Book',
            '26'=>'Naplex Test Bank',
            '30'=>'Naplex Pharmaceutical Calculations',
            '27'=>'Ptce Test Bank',
            '28'=>'Fpgee Biostatistics',
            '29'=>'Fpgee Pharmaceutical Calculations',
            '14'=>'Payment Success',
            '15'=>'Practice Test',
            '16'=>'General',
            '17'=>'Blog',
            '18'=>'Blog Details',
            '19'=>'News And Event Details',
            '20'=>'Success',
        );

		//$this->_list_data['inner_banner_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		//$this->_list_data['inner_banner_product_id'] = $this->model_product->find_all_list_active(array(),"product_name");

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='', $data=array())
	{
		parent::add($id, $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
