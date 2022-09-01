<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Order extends MY_Controller {

	/**
	 * CSL Achievements page
	 *
	 * @package		order
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "order_id,order_user_id,order_payment_method_id,order_shipment_method_id,order_gift_wrapped,order_total_items,
    		order_total,order_ostatus_comments , order_created_on , order_updated_on" ;
        $this->dt_params['searchable'] = array("order_id","order_user_id","order_shipment_method_id","order_payment_method_id");
        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "show_delete" => false ,
                                        "show_edit" => false ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array(
                                        	'<a target="_blank" title="View" href="'.$config['admin_base_url'].'order/detail/%d/" class="btn-xs btn btn_view_product btn-primary"><i class="icon-picture"></i></a>',
                                		) ,
                                      );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$this->add_script(
			array(
				"jquery.validate.min.js",
				"order.js",
				"admin_cart.js",
			), 'js'
		);

		$_POST = $this->input->post(NULL, false);
		$this->_list_data['order_shipment_method_id'] = $config['carriers'];
		$this->_list_data['order_payment_method_id'] = $this->model_payment_method->find_all_list_active(array(),"payment_method_name");
		$this->_list_data['order_user_id'] = $this->model_user->find_all_list_active(array("order"=>"user_email"),"user_email");
	}

	public function add($order_id=0)
	{
		$this->add_script(array("cart_style.css"));
		$this->add_script(array("themeCore.js" , "theme.js") , "js");
		
		if($_POST)
			$this->save_order();

		if(!$_POST)
			$this->cart->destroy();
		$data = array();
		$data['available_products'] = $this->model_product->get_available_products(array() , true);
		parent::add($order_id , $data);
	}

	public function save_order()
	{
		global $config; 

		if(!$this->cart->contents())
			return false;
		
		$record = $_POST[ 'order' ];
		$record['order_total'] 				= 	$this->cart->total();
		$record['order_total_items']		= 	$this->cart->total_items();

		$order_id = $this->model_order->save_cart($record) ;
		
		if($order_id)
		{
			if(is_array($_POST[ 'transfer_detail' ]))
			{
				$pmf_rec = array();
				foreach ($_POST[ 'transfer_detail' ][ 'field' ] AS $field_id => $field_val )
				{
					$i++ ;
					$pmf_rec[ $i ] = array();
					$pmf_rec[ $i ][ 'ot_detail_order_id' ] = $order_id ;
					$pmf_rec[ $i ][ 'ot_detail_field_id' ] = $field_id ;
					$pmf_rec[ $i ][ 'ot_detail_value' ] = $field_val ;
				}
				$update = $this->model_order_transfer_detail->insert_batch_record($pmf_rec);
			}

			$this->model_order_address->add_address($order_id , $record[ 'order_shipping_address_id' ] , $record[ 'order_billing_address_id' ] ) ;
			$this->model_order->update_status($order_id , $config[ 'order_status' ][ 'admin_placed' ] ) ;
			$this->cart->destroy();
			redirect("admin/order/detail/".$order_id) ;
		}
	}

	public function change_status($order_id)
	{
		$ostatus_id = intval($_POST['ostatus_id']) ;
		$order_id = intval($order_id) ;
		if($order_id && $ostatus_id)
			$update = $this->model_order->update_status($order_id , $ostatus_id);

		end_script_json( array( "success" => $update ) ) ;
	}

	public function get_order_status($order_id)
	{
		$history = array();
		$order_id = intval($order_id) ;
		if($order_id )
			$history  = $this->model_order_change->get_order_history($order_id);

		end_script_json( $history ) ;
	}


	public function add_message($order_id)
	{
		$message = $_POST['message'] ;
		$is_private = intval($_POST['is_private']) ;
		$order_id = intval($order_id) ;
		
		if($order_id && $message)
			$update = $this->model_order_message->add($order_id , $message, $is_private , 1);
		else
			end_script_json( array( "success" => false, "msg" => "Please enter your message." ) ) ;

		end_script_json( array( "success" => $update ) ) ;
	}

	public function mark_message_asread($message_id)
	{
		$response["success"] = $this->model_order_message->mark_read($message_id);
		end_script_json($response);
	}

	public function get_order_message($order_id)
	{
		$history = array();
		$order_id = intval($order_id) ;
		if($order_id )
			$history  = $this->model_order_message->get_order_message($order_id);

		end_script_json( $history ) ;
	}

	public function detail($order_id='')
	{

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
								));



		$data[ 'order_detail' ] = $this->model_order->get_order_detail($order_id);
		$data[ 'ostatuses' ] = $this->model_ostatus->find_all_list_active(array() , "ostatus_name" , "ostatus_payment_method_status_id");
		
		$data[ 'order_items' ] = $this->model_order_item->get_order_items($order_id , true);

		$data[ 'payment_method_fields' ] = $this->model_order_transfer_detail->get_order_transfer_details($order_id);
		
		$data[ 'shpping_address' ] = $this->model_order_address->find_by_pk( $data[ 'order_detail' ][ 'order_shipping_address_id' ] ) ;
		$data[ 'billing_address' ] = $this->model_order_address->find_by_pk( $data[ 'order_detail' ][ 'order_billing_address_id' ] ) ;

		$params_latest = array( "limit" => 5 ) ;
		$data[ 'user_validity_summary' ] = $this->model_order->get_user_order_validity_summary( $data[ 'order_detail' ][ 'order_user_id' ] );
		$data[ 'user_latest_orders' ] = $this->model_order->get_user_orderlist( $data[ 'order_detail' ][ 'order_user_id' ] , $params_latest );

		$data[ 'page_title_min' ] = "Detail";
		$data[ 'page_title' ] = "Order";
		$data[ 'class_name' ] = "order";
		$data[ 'model_name' ] = "model_order";
		$data[ 'model_obj' ] = $this->model_order;
		$data[ 'dt_params' ] = $this->dt_params ;
		$data[ 'id' ] = $id; 

		$this->load_view("invoice" , $data);
	}

	public function get_itemset($product_id)
	{
        $product = $this->model_product->find_by_pk($product_id);
		if( $product[ 'product_stitched' ] )
            $pis_params['where']['pis_qty - pis_qty_sold >'] = 0 ;
        $item_sets = $this->model_product_item_set->get_product_set( $product_id , $pis_params );
		end_script_json( $item_sets );
	}

	// Get Payment method fields
	public function get_payment_fields($payment_method_id)
	{
		$payment_method_field = $this->model_payment_method_field->payment_fields( $payment_method_id ) ;
		end_script_json( $payment_method_field );
	}

	public function get_product_addons($product_id)
	{
		$productlist = $this->model_product_addon->get_product_addons($product_id) ;
		end_script_json( $productlist );
	}


	public function get_address($oa_id)
	{
		$data = array();
		$data['address'] = $this->model_order_address->find_by_pk($oa_id);
		if($data['address'])
			$response['txt'] = $this->load_view("address_form" , $data , true, false );
		$response['status'] = intval( array_filled($data['address']) );

		end_script_json($response);
	}

	public function save_address()
	{
		$address = $_POST['order_address'] ;
		$update = $this->model_order_address->update_address($address);
		
		end_script_json(array(
			"success" => $update 
		));

	}


	public function save_discount()
	{
		$discount = $_POST['order'] ;
		$update = $this->model_order->update_discount($discount);
		
		end_script_json(array(
			"success" => $update 
		));

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
