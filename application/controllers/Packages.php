<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends MY_Controller {

	/**
	 * Default Controller
	 */
	
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
        //debug(g('base_url'));

        // debug($data['banner'],1);
        
        // Load View
        $this->load_view("index", $data);
    }

    public function payment(){

        $packageName = $_GET['package'];
        $oid = $_GET['oid'];
        //debug($packageName,1);

        $param['where']['packages_name'] = $packageName;
        $data['packages'] = $this->model_packages->find_one_active($param);

        $param1['where']['order_id'] = $oid;
        $orderData = $this->model_order->find_one_active($param1);

 //       debug($orderData);

        $totalAmount = $orderData['order_total'];


      // if($this->session->has_userdata('couponSession') AND $orderData['order_business_feature'] == 0){

      //   $couponSession = $this->session->userdata('couponSession');
      //   // debug($couponSession['discounted_price']);
      //   // debug($couponSession);

      //   $totalAmount = $couponSession['discounted_total_price'];

      // }else if($this->session->has_userdata('couponSession') AND $orderData['order_business_feature'] == 1){

      //   $couponSession = $this->session->userdata('couponSession');

      //   $totalAmount = $couponSession['discounted_total_price'];

      // }else{

      // }

      //debug($totalAmount);

        $data['totalPrice'] = $totalAmount;

        if($packageName == "Premium"){

            $data['featuredStatus'] = 1; 

        }else{

            $data['featuredStatus'] = 0;
        }

        if($orderData['order_business_feature'] == 1){
            $data['checkedStatus'] = 1; 
        }else{
            $data['checkedStatus'] = 0;

        }

        
        $data['custom'] = $oid;
        $data['packageName'] = $packageName;

        $data['success_url'] = g('base_url') . "checkout/success?oid=" . $oid . "&code=" . md5($oid);
        $data['notify'] = g('base_url') . "checkout/notify?oid=" . $oid . "&code=" . md5($oid);
        $data['notify_without_payment'] = g('base_url') . "checkout/notify_without_payment?oid=" . $oid . "&code=" . md5($oid);
        $data['cancel_url'] = g('base_url') . "checkout/error?oid=" . $oid . "&code=" . md5($oid);

        //debug($data['totalPrice']);
        //debug($data['packages'],1);

        $this->load_view("payment", $data);
        //debug($data['packages']);
    }

    public function checkSubscription(){

        $packageId = $_POST['pid'];
        $userId = $this->userid;


        $param['where']['packages_id'] = $packageId;
        $packages = $this->model_packages->find_one($param);

        $param2['where']['order_user_id'] = $userId;
        $param2['where']['order_payment_status'] = 1;
        $userSubscription = $this->model_order->find_one($param2);


        $param3['where']['subscription_user_id'] = $userId;
        $param3['where']['subscription_payment_status'] = 1;
        $userSubscriptionAutoRenewal = $this->model_subscription->find_one($param3);

       // debug($userSubscriptionAutoRenewal,1);

        //$query = $this->db->last_query($userSubscription);

        // $checkPaymentStatus = $this->db->query("SELECT * FROM `fb_order`

        //                                             WHERE `order_user_id` = 6
        //                                             AND `order_payment_status` = 1
        //                                              LIMIT 1");

        // $resultStatus = $checkPaymentStatus->result_array();
        // debug($query,1);

        if($userSubscription){

            $pkgName = $userSubscription['order_package_name'];
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = "You already subscribe for ".$pkgName." package";

        }else if($userSubscriptionAutoRenewal){
            

            $param5['where']['packages_id'] = $userSubscriptionAutoRenewal['subscription_membership_id'];
            $autopackages = $this->model_packages->find_one($param5);
            $pkgName2 = $autopackages['packages_name'];

            $pkgName = $userSubscriptionAutoRenewal['order_package_name'];
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = "You already subscribe for ".$pkgName2." package";

        }else{

            $this->json_param['status'] = 2;

        }

        echo json_encode($this->json_param);
    }

    public function saveOrder(){

        $packageId = $_POST['pid'];
        $userId = $this->userid;

        $param['where']['packages_id'] = $packageId;
        $packages = $this->model_packages->find_one($param);

            $order_user_id = $userId;
            $order_package_id = $packageId;
            $order_package_name = $packages['packages_name'];
            $order_amount = $packages['packages_price'];
            $order_total = $packages['packages_price'];
            $days = $packages['packages_days'];

            // if($order_package_name == "Premium"){
            //   $order_amount += 6; 
            //   $order_total +=6; 
            // }

            $insertData = array(
                'order_user_id' => $order_user_id,
                'order_package_id' => $order_package_id,
                'order_package_name' => $order_package_name,
                'order_amount' => $order_amount,
                'order_total' => $order_total,
                'order_package_days' => $days,
                'order_status' => 1
            );

            $insert = $this->db->insert('fb_order', $insertData);

            $insert_id = $this->db->insert_id();


            $insertData2 = array(
                'subscription_id' => $insert_id,
                'subscription_user_id' => $order_user_id,
                'subscription_membership_id' => $order_package_id,
                'subscription_membership_name' => $order_package_name,
                'subscription_amount' => $order_amount,
                'subscription_duration' => $days,
                'subscription_status' => 1
            );

            $insert2 = $this->db->insert('fb_subscription', $insertData2);

            $insert_id2 = $this->db->insert_id();

            //debug($insert_id2,1);

            if($insert2){

                        $this->json_param['status'] = 1;
                        $this->json_param['oid'] = $insert_id2;
                        //$this->json_param['txt'] = "Already added to favourite list";

                    }else{

                        $this->json_param['status'] = 0;
                }

       // debug($packages,1);

        echo json_encode($this->json_param);

        //$insert_id = $this->db->insert_id();
        //debug($insert_id,1);
    }

    public function updateFeaturePriceOn(){

        $featurePrice = $_POST['featurePrice'];
        $oid = $_POST['oid'];
        $originalPrice = $_POST['originalPrice'];

      //  if($this->session->has_userdata('couponSession')){
      //  $couponSession = $this->session->userdata('couponSession');
      //  $finalPrice = $couponSession['discounted_total_price'] + $featurePrice;
      //  }else{
      //  $finalPrice = $originalPrice + $featurePrice;
      //  }

        $finalPrice = $originalPrice + $featurePrice;

        $data = array(

                'order_business_feature' => 1,
                'order_total' => $finalPrice
                
            );

        $this->db->where('order_id', $oid);
        $update = $this->db->update('fb_order', $data);

        if($update){
            $this->json_param['status'] = 1;
            $this->json_param['txt'] = "You business feature is onn";
        }

        echo json_encode($this->json_param);

        //debug($oid,1);
    }

    public function checkCoupon(){

        $coupon = $_POST['coupon'];
        $price = $_POST['price'];
        $packageId = $_POST['packageId'];
        $userId = $_POST['userId'];
        $oid = $_POST['oid'];

        //debug($oid,1);

        $par['where']['coupon_code'] = $coupon;
        $couponVerify = $this->model_coupon->find_one_active($par);

        $couponPer = $couponVerify['coupon_rate'];
        $couponId = $couponVerify['coupon_id'];

        if(empty($couponVerify)){

            $this->json_param['status'] = 0;
            $this->json_param['txt'] = "Coupon code is invalid";
            echo json_encode($this->json_param);
            exit;

        }else{

        $couponDiscount1 = intval($price * $couponPer) / 100;
        $couponDiscount = number_format((float)$couponDiscount1, 2, '.', '');
        $total1 = $price - $couponDiscount;
        $discountedAmount = number_format((float)$total1, 2, '.', '');

        //debug($couponPer,1);

            $newdata = array(
                            'user_id'     => $userId,
                            'package_id'     => $packageId,
                            'coupon_id'  => $couponId,
                            'percent' => $couponPer,
                            'discounted_price'     => $couponDiscount,
                            'discounted_total_price'     => $discountedAmount,
                            'is_coupon' => TRUE
                    );

            $this->session->set_userdata('couponSession',$newdata);


            $updateOrderData = array(
                            'order_total' => $discountedAmount,
                            'order_coupon_discount' => $couponPer
                        );
           
            $this->db->where('order_id', $oid);
            $update = $this->db->update('fb_order', $updateOrderData);



            $this->json_param['status'] = 1;
            $this->json_param['txt'] = "Coupon applied";
            echo json_encode($this->json_param);
           // exit;


        }

        //debug($couponVerify,1);
    }

    public function updateFeaturePriceOf(){

        $featurePrice = $_POST['featurePrice'];
        $oid = $_POST['oid'];
        $originalPrice = $_POST['originalPrice'];
        //debug($originalPrice);
        $finalPrice = $originalPrice - $featurePrice ;

        $data = array(

                'order_business_feature' => 0,
                'order_total' => $finalPrice
            );

        $this->db->where('order_id', $oid);

        $update = $this->db->update('fb_order', $data);

        if($update){
            $this->json_param['status'] = 1;
            $this->json_param['txt'] = "You business feature is off";
        }

        echo json_encode($this->json_param);

        //debug($oid,1);
    }


    public function expireSubscription(){
        // $Date = "2021-04-28 21:54:34";
        // $tempDate = date('Y-m-d', strtotime($Date. ' + 45 days'));
        // echo date('Y-m-d', strtotime('-3 day', strtotime($tempDate)));
        $param['where']['order_payment_status'] = 1;
        $orders = $this->model_order->find_all_active($param);

        //debug($orders,1);

        foreach ($orders as $key => $order) {
            
            $orderPackageName = $order['order_package_name'];
            $orderPlacedDate = $order['order_createdon'];
            $orderPackageDays = $order['order_package_days'];
            $orderId = $order['order_id'];
            $orderUserId = $order['order_user_id'];
            
            $this->updatePaymentStatus($orderPackageName,$orderPlacedDate,$orderPackageDays,$orderId,$orderUserId);

         }
    }

    public function updatePaymentStatus($orderPackageName,$orderPlacedDate,$orderPackageDays,$orderId,$orderUserId){

       // debug($orderId);
        // getting package expiry date by matching with orderplaced date and calculate days
        $packageExpireDate = date('Y-m-d', strtotime($orderPlacedDate. ' + '.$orderPackageDays.' days'));
        $currentDate = date("Y-m-d");
       // debug($orderPlacedDate,1);

        //$currentDate = '2021-05-28';

        $param2['where']['signup_id'] = $orderUserId;
        $user = $this->model_signup->find_one_active($param2);

        $userName = $user['signup_firstname'];
        $userEmail = $user['signup_email'];
        
        // need to send email before 3 days of expiration
        $threeDaysBeforeDate = date('Y-m-d', strtotime('-3 day', strtotime($packageExpireDate)));
        


        // sending email for expiry reminder 3 days before 
        // -----------------------------------------------
        if($threeDaysBeforeDate == $currentDate ){

            $data = array(
                "email"=>$userEmail,
                "expiryDate" => $packageExpireDate
            );

            $template = $this->load->view("_layout/email_template/subscription_alert", $data, true);
            $db_to = g("db.admin.email") ;
            $to = $userEmail;
            //debug($to);
            parent::client_email($to,$template,'Package Subscription Alert');
        }
        // ------------------------------------------------



        
        //$currentDate = '2021-11-07';
        // matching expire date with current date to update payment status
        if($packageExpireDate == $currentDate){

             //debug($orderUserId);

           // update payment status to 0 (order expire)
            $updateStatus = array(
                    'order_payment_status' => 0,
                    'order_payment_expire' => 1
            );
            $this->db->where('order_id', $orderId);
            $this->db->update('fb_order', $updateStatus);


            // update ad status to 0 ( this user ad will also not show because his order expire )

            $par333['where']['ads_user_id'] = $orderUserId;
            $adsdata = $this->model_ads->find_all_active($par333);
            foreach ($adsdata as $key2 => $ad) {
            
            $adid = $ad['ads_id'];

             $updateStatus2 = array(
                'ads_status' => 0
            );
            $this->db->where('ads_id', $adid);
            $this->db->update('fb_ads', $updateStatus2);
                
            }
           
        }

    }

}
