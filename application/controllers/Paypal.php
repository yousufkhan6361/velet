<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MY_Controller {

	/**
	 * Paypal Controller. - The deafult controller
	 *
	 * @package		Paypal
	 * @author		Waqas Ahmed (waqasahmed.it@gmail.com)
	 * @version		2.0
	 * @since		23 AUG, 2017
	 */

	private $paypal_gateway_url;
	private $paypal_email;
	private $paypal_salt_key;
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
        $this->view_pre = 'payment/';

        $this->set_attributes();
    }

	private function set_attributes()
	{
		$this->paypal_gateway_url = (g('db.admin.sandbox') == 1) ? PAYPAL_GATEWAY_URL_TEST : PAYPAL_GATEWAY_URL_LIVE;
		$this->paypal_email = g('db.admin.business_email');
		$this->paypal_salt_key = 'F!5#iN@#l_^$';

		return true;
	}

	// private function order_no_encrypt($id)
	// {
	// 	return md5($this->paypal_salt_key.$id);
	// }

	/*
	// Form Order Confirm page before Pay
	public function index()
	{
		if(isset($_GET['id']) AND (intval($_GET['id']) > 0))
		{
			$id = $_GET['id'];
			
			$data['paypal_gateway_url'] = $this->paypal_gateway_url;
			$data['paypal_email'] = $this->paypal_email;

			$data['discount_amount'] = isset($this->session->userdata['discount']['discount_amount']) ? $this->session->userdata['discount']['discount_amount'] : 0;

			$data['user_data'] = $this->session->userdata['logged_in_front'];
			$data['program_data'] = $this->model_user_program->get_result_data_by_pk_id($id);

			$data['success_url'] = l("paypal/paypal_success")."?id=".$id."&code=".order_no_encrypt($id);
			$data['notify_url'] = l("paypal/paypal_notification")."?id=".$id."&code=".order_no_encrypt($id);
			$data['cancel_url'] = l("paypal/paypal_error")."?id=".$id."&code=".order_no_encrypt($id);
			

			$this->load_view('_form',$data);
		}
		else
		{
			die('Kill');
		}
	}
	*/

	public function paypal_notify()
	{

		// if(isset($_GET))
		// {
		// 	$generate_code = order_no_encrypt($_GET['id']);
		// 	if($generate_code == $_GET['code'])
		// 	{

		// 	}
		// }
		// $_POST = 'a:20:{s:8:"txn_type";s:10:"subscr_eot";s:9:"subscr_id";s:14:"I-4XYKPPVGVN91";s:9:"last_name";s:8:"Personal";s:17:"residence_country";s:2:"US";s:9:"item_name";s:13:"BASIC PACKAGE";s:11:"mc_currency";s:3:"USD";s:8:"business";s:36:"sb-43gbra823101@business.example.com";s:11:"verify_sign";s:56:"AdCth9i9nL2TOOvMhWwrfSSFHhw9AdMhBAGQtuT08rMueA8bsYtyzmpT";s:12:"payer_status";s:8:"verified";s:8:"test_ipn";s:1:"1";s:11:"payer_email";s:26:"buyer.paypal.dev@gmail.com";s:10:"first_name";s:5:"Buyer";s:14:"receiver_email";s:36:"sb-43gbra823101@business.example.com";s:8:"payer_id";s:13:"WH4M6GVGFC7US";s:11:"item_number";s:1:"1";s:19:"payer_business_name";s:10:"digitonics";s:6:"custom";s:2:"63";s:7:"charset";s:12:"windows-1252";s:14:"notify_version";s:3:"3.9";s:12:"ipn_track_id";s:13:"e796563c7c8b5";}';

		// debug(unserialize($sub_res),1);

	if(ENVIRONMENT != 'development')
		{
		 $msg = serialize($_POST);        
         $msg = wordwrap($msg,5000);
         mail("elle28dev@gmail.com","Paypal Animated Subscription",$msg);
		
		}

		$postData = unserialize($_POST);
   //         $paypalURL = PAYPAL_URL; 
			// $ch = curl_init($paypalURL); 
			// if ($ch == FALSE) { 
			//     return FALSE; 
			// } 
			// curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
			// curl_setopt($ch, CURLOPT_POST, 1); 
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
			// curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST); 
			// curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
			// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
			// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
			// curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
			 
			// // Set TCP timeout to 30 seconds 
			// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
			// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
			// $res = curl_exec($ch); 
 
 		// 			$msg = serialize($res);        
	  //        		$msg = wordwrap($msg,5000);
			// mail("elle28dev@gmail.com","Paypal Animated Subscription response",$msg);

					$id = $_GET['id'];
					$param['subscription_paypal_date'] = date("Y-m-d");
					$param['subscription_payment_status'] = 0;
				
				if ($postData['payer_status'] == 'verified') {
						$param['subscription_payment_status'] = 1;
				}
					$param['subscription_sub_id'] = $postData['subscr_id'];
					$param['subscription_txn_message'] = $postData['payer_status'];
					$param['subscription_status'] =1 ;
					$param['subscription_payment_txn_id'] = $postData['payer_id'];
					$param['subscription_payment_type'] = "Paypal";
					$param['subscription_payment_post'] = serialize($postData);
					$this->model_subscription->update_by_pk($id,$param);


					// Email Start
					if(ENVIRONMENT != 'development')
					{
						// sent to user email
                        $this->model_email->subscription_notification($id , 'USER');
                        // sent to admin email
                        $this->model_email->subscription_notification($id , 'ADMIN');
					}



	}

	// Form Order Confirm page after Pay
	public function paypal_success()
	{

		if(isset($_GET))
		{
			$generate_code = order_no_encrypt($_GET['id']);
			if($generate_code == $_GET['code'])
			{
				// redirect(l('cart/success/?oid=' . $_GET['id']) , true);
								
				// unset($this->session->userdata['discount']);
		    $this->cart->destroy();

			$array_items = array();
			$array_items = array('discount','shipping_charges','tax');
			$this->session->unset_userdata($array_items);

				// $this->session->unset_userdata('discount');

				//redirect(l('program_account_area/program/' . $_GET['id']) , true);
				
				$this->load_view('success',$data);
			}
			else
			{
				redirect(l('home/error' , true));
			}
		}
	}

	// If error found in payment
	public function paypal_error()
	{
		if(isset($_GET))
		{
			$generate_code = order_no_encrypt($_GET['id']);
			if($generate_code == $_GET['code'])
			{
				// redirect(l('cart/error/?oid=' . $_GET['id']) , true);
				$this->load_view('error',$data);
			}
			else
			{
				// redirect(l('home/error' , true));
			}
		}
	}

	// Paypal Notification
	public function paypal_notification()
	{
		if(isset($_GET))
		{
			$generate_code = order_no_encrypt($_GET['id']);
			if($generate_code == $_GET['code'])
			{
				$id = $_GET['id'];
				$status_codes = array("Default"=>0,"Completed"=>1,"Pending"=>2,"Denied"=>3,"Failed"=>4,"Reversed"=>5);
				$payment_status = $_POST['payment_status'];
				$order_payment_status = $status_codes[$payment_status];


				// Update USER PROGRAM 
				$data = array();
				if($order_payment_status == 1)
				{
					$param = array();
	
					$param['order_payment_status'] = $order_payment_status;
					$param['order_status'] = 1;
					$param['order_paypal_date'] = date("Y-m-d");
					$param['order_transaction_message'] = $payment_status ;
					// order_paypal_payment_status
					$param['order_payment_type'] = "Paypal";
					$param['order_payment_txn_id'] = $_POST['paymentID'];
					$param['order_paypal_ipn_track_id'] = $_POST['payerID'];
					$param['order_payment_post'] = serialize($_POST);

					$this->model_shop_order->update_by_pk($id,$param);


					// Email Start
					if(ENVIRONMENT != 'development')
					{
						// sent to user email
						$this->model_email->notification_invoice($id , 'USER');

						// sent to admin email
						$this->model_email->notification_invoice($id , 'ADMIN');
					}
					// Email END
					return true;
				}
			}
		}
	}


	// PACKAGE PAYPAL NOTIFICATION
	public function paypal_notification2()
	{
		if(isset($_GET))
		{
			$generate_code = order_no_encrypt($_GET['id']);
			if($generate_code == $_GET['code'])
			{
				$id = $_GET['id'];
				$status_codes = array("Default"=>0,"Completed"=>1,"Pending"=>2,"Denied"=>3,"Failed"=>4,"Reversed"=>5);
				$payment_status = $_POST['payment_status'];
				$order_payment_status = $status_codes[$payment_status];


				// Update USER PROGRAM 
				$data = array();
				if($order_payment_status == 1)
				{
					$param = array();
					// $param['order_payment_status'] = $order_payment_status;
					// $param['order_paypal_date'] = date("Y-m-d");
					// $param['order_paypal_payment_status'] = $payment_status ;
					// $param['order_paypal_txn_id'] = $_POST['payer_id'];
					// $param['order_paypal_ipn_track_id'] = $_POST['ipn_track_id'];
					// $param['order_payment_post'] = serialize($_POST);

					$param['subscription_payment_status'] = $order_payment_status;
					$param['subscription_paypal_date'] = date("Y-m-d");
					$param['subscription_txn_message'] = $payment_status ;
					// order_paypal_payment_status
					$param['subscription_status'] =1 ;
					$param['subscription_payment_txn_id'] = $_POST['payer_id'];
					// $param['subscription_paypal_ipn_track_id'] = $_POST['ipn_track_id'];
					$param['subscription_payment_type'] = "Paypal";
					$param['subscription_payment_post'] = serialize($_POST);

					$this->model_subscription->update_by_pk($id,$param);


					// Email Start
					if(ENVIRONMENT != 'development')
					{
						// sent to user email
                        $this->model_email->subscription_notification($id , 'USER');
                        // sent to admin email
                        $this->model_email->subscription_notification($id , 'ADMIN');
					}
					// Email END
					return true;
				}
			}
		}
	}
	
	// public function paypal_notification2()
	// {
	// 	if(isset($_GET))
	// 	{
	// 		$generate_code = order_no_encrypt($_GET['id']);
	// 		if($generate_code == $_GET['code'])
	// 		{
	// 			$id = $_GET['id'];
	// 			$status_codes = array("Default"=>0,"Completed"=>1,"Pending"=>2,"Denied"=>3,"Failed"=>4,"Reversed"=>5);
	// 			$payment_status = $_POST['payment_status'];
	// 			$order_payment_status = $status_codes[$payment_status];


	// 			// Update USER PROGRAM 
	// 			$data = array();
	// 			if($order_payment_status == 1)
	// 			{
	// 				// online_quiz_expiry Start
	// 				$param = array();
	// 				$param['oqe_payment_status'] = $order_payment_status;
	// 				$param['oqe_paypal_date'] = date("Y-m-d");
	// 				$param['oqe_paypal_payment_status'] = $payment_status;
	// 				$param['oqe_paypal_txn_id'] = $_POST['payer_id'];
	// 				$where_param = array();
	// 				$where_param['where']['oqe_id'] = $id;
	// 				$this->model_online_quiz_expiry->update_model($where_param,$param);
	// 				// online_quiz_expiry End


	// 				// Email Start
	// 				if(ENVIRONMENT != 'development')
	// 				{
	// 					// sent to user email
	// 					//$this->model_email->notification_invoice($id , 'USER');

	// 					// sent to admin email
	// 					//$this->model_email->notification_invoice($id , 'ADMIN');
	// 				}
	// 				// Email END
	// 				return true;
	// 			}
	// 		}
	// 	}
	// }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */