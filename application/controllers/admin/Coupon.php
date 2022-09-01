<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Coupon extends MY_Controller {

	/**
	 * Coupon Controller
	 *
	 * @package		Self :D
	 * @author      Waqas Ahmed (waqasahmed.it@gmail.com)
	 * @version		2.0 -- Robust , Advanced And More Frustating...
	 * @since		Version 2.0 2015
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "coupon_id,coupon_comments,coupon_rate,coupon_code,coupon_status";
        $this->dt_params['searchable'] = explode("," , $this->dt_params['dt_headings']);//array("coupon_id","coupon_code","coupon_rate","coupon_audience","coupon_start_date","coupon_expire_date","coupon_status");

        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        
        $this->_list_data['coupon_is_first_time'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">No</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">YES</span>"  
                                    );

         $this->_list_data['coupon_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );

        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files
		$config['js_config']['paginate'] = $this->dt_params['paginate'];
		
		$this->_list_data['coupon_type'] = $this->coupon_type_list();
		$this->_list_data['coupon_apply_on'] = $this->coupon_apply_on_list();

		
		
		// $this->_list_data['coupon_product_category'] = $this->model_product_category->find_all_list_active(array(),"product_category_name");

		// $this->_list_data['coupon_product'] = $this->model_product->find_all_list_active(array(),"product_name");
		// debug($this->_list_data['coupon_product_category'],1 );


		// Populating LISTDATA

		$_POST = $this->input->post(NULL, true);
	}
	

	function coupon_type_list()
	{
		return array(
			        1=>'Coupon type (%)',
					2=> 'Coupon type ($)',
					);

        // return array(
        //     1=>'Member',
        //     2=> 'Guest'
        // );
	}
	function coupon_apply_on_list()
	{
		return array(
					1=>'All Products',
					2=> 'Individual Product category(s)',
					3=> 'Individual Product(s)',
					);
	}		


	/**
		GENERATE COUPON CODE
	*/
	public function genrate_code()
	{
		//$var = "MKS0091";
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$var = "";
		for ($i = 0; $i < 6; $i++) {
		    $var .= $chars[mt_rand(0, strlen($chars)-1)];
		}

		// check coupon code already exist
		$param = array();
		$param['where']['coupon_code'] = $var;
		$data = $this->model_coupon->find_all($param);

		// when coupon code exist than recursive function load
		if(isset($data) && array_filled($data))
		{
			$this->genrate_code();
		}

		echo json_encode($var);
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
