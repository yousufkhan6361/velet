<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Order extends MY_Controller {

	/**
	 * user admin
	 *
	 * @package		User
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "order_id,order_package_name,order_total,order_payment_status";
        $this->dt_params['searchable'] = array("order_id","order_package_name","order_email","order_payment_status","order_dispatch_status");
        $this->dt_params['action'] = array(
        								"hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => false ,
                                        "show_edit" => false ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array(
                                        	'<a title="View" href="'.$config['admin_base_url'].'order/detail/%d/" class="btn-xs btn btn-primary order_details_btn"><i class="icon-picture"></i></a>',
                                        	
                                		) ,
                                      );
        
        $this->_list_data['user_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
         $this->_list_data['order_dispatch_status'] = array(
            STATUS_INACTIVE => "<span class=\"label label-default\">No</span>" ,
            STATUS_ACTIVE =>  "<span class=\"label label-primary\">Yes</span>"
        );

		// For use IN JS Files
		$config['js_config']['paginate'] = $this->dt_params['paginate'];
		
		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='', $data=array())
	{
		// Popluated LISTDATA in constructor
		/*$this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
		parent::add($id, $data);*/
		redirect(g('admin_base_url') . "order");
	}
	public function update_dispatch($order_id=''){
		$id=$_GET['id'];
		$dispatch_status=$_GET['st_type'];
		//debug($dispatch_status,1);
		if($dispatch_status==0){
		$updateorder['order_dispatch_status']=1;
		}else{
			$updateorder['order_dispatch_status']=0;
		}
		$this->model_order->update_by_pk($id, $updateorder);
		redirect(g('admin_base_url') . "order");
	}



	public function detail($order_id='')
	{   

		//debug($order_id,1);
		/** check rights before deletion **/
		$class_name = $this->router->class;
		$page_name = $class_name."_edit";

		$this->layout_data['template_config']['show_toolbar'] = false ;
		$this->register_plugins(array(						
									"jquery-ui",
									"bootstrap",
									"bootstrap-hover-dropdown",
									"jquery-slimscroll",
									"uniform",
									"boots",
									"font-awesome",
									"simple-line-icons" ,
									"select2",
									"bootbox",
									"bootstrap-toastr",
									"bootstrap-datetimepicker"
								));
		
		$data['order_detail'] = $this->model_order->get_order_detail($order_id);

		$userID = $data['order_detail']['order_user_id'];
		
		$par3['where']['signup_id'] = $userID;
		$data['signupData'] = $this->model_signup->find_one($par3);

		//debug($data['signupData'],1);
		// if(!array_filled($data[ 'order_detail' ]))
		// 	not_found("Invalid Order ID");
		// $total_quantity = 0;
		// $total_amount = 0;
		// $item_data = $this->model_order_item->get_order_items($order_id);
        //debug($item_data,1);
		
		// $data[ 'total_quantity' ] = $total_quantity;
		// $data[ 'total_amount' ] = $total_amount;
		// $data[ 'order_items' ] = $item_data;
		// //$data[ 'adshare_info' ] = $adshare;
		// $data[ 'page_title_min' ] = "Detail";
		// $data[ 'page_title' ] = "Order";
		// $data[ 'class_name' ] = "order";
		// $data[ 'model_name' ] = "model_order";
		// $data[ 'model_obj' ] = $this->model_order;
		// $data[ 'dt_params' ] = $this->dt_params ;
		// $data[ 'id' ] = $id;
        //debug($data,1);

		//$this->load_view("invoice" , $data);
		$this->load_view("detail" , $data);
	}

	public function index()
	{
		// Popluated LISTDATA in constructor
		parent::index();
	}
	
	public function get_view($id=0) {

		global $config;
		$result = array();
		$class_name = $this->router->class;
		$model_name = 'model_'.$class_name ;
		$model_obj = $this->$model_name ;
		$form_fields = $model_obj->get_fields();
		if($id)
		{
			$result['record'] = $this->$model_name->find_by_pk($id);
			$result['record'] = $this->$model_name->prepare_view_data($result['record']);
			if(!$result['record'] )
				$result['failure'] = "No Item Found";
				// Load relation fields data
			$relation_data = $this->$model_name->get_relation_data($id);
			if(array_filled($relation_data))
				$result['record']['relation_data'] = $relation_data;
		}
		else
		{
			$result['failure'] = "No Item Found";
		}
	
		return $result;

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
