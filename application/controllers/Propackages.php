<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propackages extends MY_Controller {

	/**
	 * Default Controller
	 */
	
    //private $packageid;


	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Home Page
	public function index()
    {

        // debug(phpinfo(),1);
        global $config;
        // Get banner
        // $data['banner'] = $this->model_banner->find_all_active();
        // $data['assets'] = $this->model_assets->find_all_active();
        // $data['sec1'] = $this->model_cms_page->get_page(1);
        // $data['blogs'] = $this->model_blog->find_all_active();
        // $data['sec2'] = $this->model_cms_page->get_page(2);
        // $data['sec3'] = $this->model_cms_page->get_page(3);
        // $data['sec4'] = $this->model_cms_page->get_page(4);
        // $data['testimonial'] = $this->model_testimonial->find_all_active();

        // $param = array();
        // $param['where']['product_is_featured'] = 1;
        // $param['limit'] = 8;
        $data['packages'] = $this->model_packages->find_all_active();

        // debug($data['banner'],1);
        
        // Load View
        $this->load_view("index", $data);
    }

    public function payment(){

        //debug("sds",1);
        $packageName = $_GET['package'];
        $oid = $_GET['oid'];
        //debug($oid,1);

        $param['where']['packages_name'] = $packageName;
        $data['packages'] = $this->model_packages->find_one_active($param);

        $param1['where']['subscription_id'] = $oid;
        $orderData = $this->model_subscription->find_one($param1);

        //debug($orderData,1);

        $totalAmount = $orderData['subscription_amount'];
        $data['packageName'] = $packageName;
        $data['totalPrice'] = $totalAmount;

        if($packageName == "Premium"){

            $data['featuredStatus'] = 1; 

        }else{

            $data['featuredStatus'] = 0;
        }

        if($orderData['subscription_business_feature'] == 1){
            $data['checkedStatus'] = 1; 
        }else{
            $data['checkedStatus'] = 0;

        }

        //$totalAmount = $data['packages']['packages_price'];

        $data['totalPrice'] = number_format((float)$data['totalPrice'], 2, '.', '');

        //debug($data['totalPrice'] ,1);
        //debug($data['total_amount'],1);
        
        $membership_id  =  $data['packages']['packages_id'];

        //$this->packageid = $membership_id;
        //debug($membership_id,1);
        $data['custom']  = $oid;

        $data['success'] = g('base_url')."propackages/success?membershipid=".$membership_id."&oid=".$oid."&code=".md5($oid);
        $data['notify'] = g('base_url')."propackages/notify?membershipid=".$membership_id."&oid=".$oid."&code=".md5($oid);
        //debug(ENVIRONMENT,1);
        $keys = $this->model_paypal_subscription->entrypoint($membership_id,$oid);
        //debug($keys,1);
        
        //debug($keys,1);     
        $data['planId'] = $keys['planId'] ;
        $data['accesstoken'] = $keys['accesstoken'] ;
        $data['token_type'] = $keys['token_type'] ;
        $data['subscription_id'] = $membership_id;
        $data['subscription_main_id'] = $keys['subscription_main_id'] ;
    
        // $data['success_url'] = g('base_url') . "checkout/success?oid=" . $oid . "&code=" . md5($oid);
        // $data['notify'] = g('base_url') . "checkout/notify?oid=" . $oid . "&code=" . md5($oid);
        // $data['cancel_url'] = g('base_url') . "checkout/error?oid=" . $oid . "&code=" . md5($oid);
        //debug($data['packages'],1);

        $this->load_view("payment", $data);
        //debug($data['packages']);
    }

    public function updateFeaturePriceOn(){

        $featurePrice = $_POST['featurePrice'];
        $oid = $_POST['oid'];
        //debug($_POST,1);
        $originalPrice = $_POST['originalPrice'];

        $finalPrice = $originalPrice + $featurePrice;

        $data = array(

                'subscription_business_feature' => 1,
                'subscription_amount' => $finalPrice
                
            );

        $this->db->where('subscription_id', $oid);
        $update = $this->db->update('fb_subscription', $data);

        if($update){
            $this->json_param['status'] = 1;
            $this->json_param['txt'] = "You business feature is onn";
        }

        echo json_encode($this->json_param);

        //debug($oid,1);
    }

    public function updateFeaturePriceOf(){

        //debug($_POST,1);
        $featurePrice = $_POST['featurePrice'];
        $oid = $_POST['oid'];
        $originalPrice = $_POST['originalPrice'];
        //debug($originalPrice);
        $finalPrice = $originalPrice - $featurePrice ;

        $data = array(

                'subscription_business_feature' => 0,
                'subscription_amount' => $finalPrice
            );

        $this->db->where('subscription_id', $oid);

        $update = $this->db->update('fb_subscription', $data);

        if($update){
            $this->json_param['status'] = 1;
            $this->json_param['txt'] = "You business feature is off";
        }

        echo json_encode($this->json_param);

        //debug($oid,1);
    }


    public function notify(){
        $data = $this->input->post();
        $serilize = serialize($data);

        $oid = $this->input->get('oid');
        $code = $this->input->get('code');
        $membershipid = $this->input->get('membershipid');

        
// membership data
        $parm['where']['packages_id'] = $membershipid;
        $membership=$this->model_packages->find_one_active($parm);

        //debug($membership,1);

        $data['total_amount']=number_format((float)$membership['packages_price'], 2, '.', '');
              
// userdata
        $userdata= $this->model_signup->find_by_pk($this->userid);

        if($code == md5($oid)){

            $status_codes = array("Default"=>0,"Completed"=>1,"Pending"=>2,"Denied"=>3,"Failed"=>4,"Reversed"=>5);
            $payment_status = $data['payment_status'];
        // debug($oid,1);        
            if ($status_codes[$payment_status] == 1) {
                
            $order_data['order_user_id'] = $this->userid;
            $order_data['order_currency_symbol'] = 'GBP';
            $order_data['order_total'] = $data['total_amount'];
            $order_data['order_package_id'] = $membership['packages_id'];
            $order_data['order_firstname'] = $userdata['signup_firstname'].' '.$userdata['signup_lastname'];
            $order_data['order_email'] = $userdata['signup_email'];
            $order_data['order_status_message'] = 'Order Completed';
            $order_data['order_payment_status'] = $status_codes[$payment_status];
            $order_data['order_payment_comments'] = $payment_status;
            $order_data['order_paymentID'] = $data['paymentID'];
            $order_data['order_payerID'] = $data['payerID'];
            $order_data['order_response'] = $serilize;
            $order_data['order_status'] = 1;


            $inserted_id = $this->model_order->insert_record($order_data);

           //  if($inserted_id > 0)
           //  {     
           //  $oitem['order_item_status'] = 1;
           //  $oitem['order_item_order_id'] = $inserted_id;
           //  $oitem['order_item_product_id'] = $membership['packages_id'];
           //  $oitem['order_item_price'] = $data['total_amount'];
           //  $oitem['order_item_subtotal'] = $membership['packages_price'];
           //  $oitem['order_item_qty'] = 1;
           //  // debug($oitem,1);
           //  $this->model_order_item->insert_record($oitem);
           // }
               
            }else{

                echo json_encode(array('payment_status' => 'Payment Failed', 'status' => 0));
            }
             $getorderDetail = $this->model_order->find_by_pk($inserted_id);
            $email = $getorderDetail['order_email'];
      // debug($inserted_id,1);
               
               //parent::invoice($inserted_id,$email);
               //parent::invoice_admin($inserted_id,$email);
             echo json_encode(array('payment_status' => 'Completed', 'status' => 1));
            }
            else{
                echo json_encode(array('payment_status' => 'Payment Failed', 'status' => 0));
            }
        }

        
public function success()
    {
        global $config;
        $this->layout_data['title'] = "Success | ".g('site_name');
        //$data['banner'] = $this->model_inner_banner->get_banner(16);
        $oid = $this->input->get('oid');
        $code = $this->input->get('code');  
        $membershipid = $this->input->get('membershipid');    

        if($code == md5($oid)){

            $data['userdata'] = $this->model_signup->find_by_pk($this->userid);
            $to = $data['userdata']['signup_email'];

            $paraa['where']['subscription_user_id'] = $this->userid;
            $paraa['where']['subscription_membership_id'] = $membershipid;
        
   
         // $paraa['joins'][] = array(
         //    "table"=>"order_item" , 
         //    "joint"=>"order_item.order_item_order_id = order.order_id",
         //    "type"=>"left"
         //    );

         $paraa['joins'][] = array(
            "table"=>"packages" , 
            "joint"=>"packages.packages_id = subscription.subscription_membership_id",
            "type"=>"left"

            );

            $data['order_detail'] = $this->model_subscription->find_one($paraa);
            // debug($data['order_detail'],1);
            if (ENVIRONMENT != "development") {
                $template = $this->load->view('_layout/email_template/subscription_invoice',$data,true);
                 $title = 'Membership Confirmation - Invoice #' . $data['order_detail']['subscription_id'];
                 // debug($template,1);
                parent::client_email_order($to,$template,$title);
            }

            $parm['where']['packages_id'] = $membershipid;
            $data['membership']  = $membership=$this->model_packages->find_one_active($parm);

             $this->load_view("success", $data);

            }
            else{
                redirect(l('404') , true);
            }
        }

}
