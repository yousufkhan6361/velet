<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/stripe-php/init.php');


class Propackages2 extends MY_Controller {


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

    // charge using for stripe subscription
    public function pay()
    {
        
        //debug(g("db.admin.stripe_secret_key"),1);
        // if(!$this->user_data['signup_package_status'])
        // {
            if(isset($_POST['stripeToken']) AND isset($_POST['packages_id']))
            {


                $stripe = new \Stripe\StripeClient(g("db.admin.stripe_secret_key"));
                //header('Content-Type: application/json');
                //debug($_POST,1);
                //debug($_POST,1);
                //debug($_POST['packages_id'],1);
                $packages_id = $_POST['packages_id'];
                $oid = $_POST['oid'];

                $package = $this->model_packages->find_by_pk($packages_id);

                $token = $_POST['stripeToken'];

                $par44['where']['signup_id'] = $this->userid;
                $userdata = $this->model_signup->find_one_active($par44);


                $par455['where']['order_id'] = $oid;
                $orderDetail = $this->model_order->find_one($par455);

                $par456['where']['subscription_id'] = $oid;
                $orderDetail = $this->model_subscription->find_one($par456);

                $data['package'] = $package;
                $data['userdata'] = $userdata;
                $data['orderDetail'] = $orderDetail;
                $data['packages'] = $package;
                $data['subscription'] = $orderDetail;

                //$template = $this->load->view('_layout/email_template/invoice2',$data,true);
                //debug($template,1);

                // debug($userdata);
                // debug($this->user_data['signup_email']);
                // debug($package,1);

                // if(!empty($package))
                // {
                //     $contact_us_data['order_status'] = 1;
                //     $contact_us_data['order_user_id'] = $this->userid;
                //     $contact_us_data['order_email'] = $this->user_data['signup_email'];
                //     $contact_us_data['order_amount'] = $package['packages_amount'];
                //     $contact_us_data['order_total'] = $package['packages_amount'];
                //     $contact_us_data['order_type'] = 1;                             // type topup
                //     $contact_us_data['order_shipping'] = 0;
                //     $contact_us_data['order_payment_status'] = 1;
                //     $inserted_id = $this->model_order->insert_record($contact_us_data);

                    // if ($inserted_id > 0)
                    // {
                    //     $oitem['order_item_status'] = 1;
                    //     $oitem['order_item_name'] = $package['packages_name'];
                    //     $oitem['order_item_order_id'] = $inserted_id;
                    //     $oitem['order_item_product_id'] = $package['packages_id'];
                    //     $oitem['order_item_price'] = $package['packages_amount'];
                    //     $oitem['order_item_subtotal'] = $package['packages_amount'];
                    //     $oitem['order_item_qty'] = 1;
                    //     $oitem['order_item_user_id'] = $this->userid;
                    //     $this->model_order_item->insert_record($oitem);

                        try{

                            $customer = $stripe->customers->create([
                                'source' => $token,
                                'email' => $userdata['signup_email'],
                            ]);

                            $product = $stripe->products->create([
                                'name' => 'Custom Subscription',
                            ]);

                            $price = $stripe->prices->create([
                                'product' => $product->id,
                                'unit_amount' => $package['packages_price'],
                                'currency' => 'gbp',
                                'recurring' => [
                                    'interval' => 'day',
                                    'interval_count' => $package['packages_days'],
                                ],
                            ]);

                            $subscription = $stripe->subscriptions->create([
                                'customer' => $customer->id,
                                'items' => [[
                                    'price' => $price->id,
                                ]],
                            ]);

                            // $charge = $stripe->charges->create([
                            //     'amount' => $package['packages_amount']*100,
                            //     'currency' => 'usd',
                            //     'description' => 'Topup charge!',
                            //     'source' => $token,
                            // ]);
                        } catch(\Stripe\Exception\CardException $e) {
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                        } catch (\Stripe\Exception\RateLimitException $e) {
                            // Too many requests made to the API too quickly
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                            // return $this->json_param;
                        } catch (\Stripe\Exception\InvalidRequestException $e) {
                            // Invalid parameters were supplied to Stripe's API
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                            // return $this->json_param;
                        } catch (\Stripe\Exception\AuthenticationException $e) {
                            // Authentication with Stripe's API failed
                            // (maybe you changed API keys recently)
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                            // return $this->json_param;
                        } catch (\Stripe\Exception\ApiConnectionException $e) {
                            // Network communication with Stripe failed
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                            // return $this->json_param;
                        } catch (\Stripe\Exception\ApiErrorException $e) {
                            // Display a very generic error to the user, and maybe send
                            // yourself an email
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                            // return $this->json_param;
                        } catch (Exception $e) {
                            // Something else happened, completely unrelated to Stripe
                            $json_param['status'] = 0;
                            $json_param['txt'] = $e->getError()->message;
                            // return $this->json_param;
                        }

                        //debug($subscription,1);
                        

                        if($subscription->id != NULL)
                        {
                            // $credits['signup_credits'] = $this->user_data['signup_credits'];
                            // $credits['signup_response'] = $subscription->id;
                            // $credits['signup_packageid'] = $packages_id;
                            // $credits['signup_package_status'] = 1;
                            // $this->model_signup->update_by_pk($this->userid,$credits);


                            // $update['subscription_accesstoken'] = $token;
                            // $update['order_payment_comments'] = 'Completed';
                            // $update['order_response'] = serialize($subscription);
                            // $this->model_order->update_by_pk($inserted_id, $update);

                            $param['subscription_subcreated_post'] = serialize($subscription);
                            $param['subscription_sub_id'] = $subscription->id;
                            $param['subscription_membership_id'] = $packages_id;
                            $param['subscription_firstname'] = $userdata['signup_firstname'];
                            $param['subscription_lastname'] = $userdata['signup_lastname'];
                            $param['subscription_email'] = $userdata['signup_email'];
                            $param['subscription_payment_type'] = 'Stripe';
                            
                            $param['subscription_status'] = 1;
                            $param['subscription_payment_status'] = 1;
                            $this->model_subscription->update_by_pk($oid,$param);

                            if (ENVIRONMENT != "development") 
                            {
                                $template = $this->load->view('_layout/email_template/invoice2',$data,true);
                               // debug($template,1);
                                $title = 'Membership Confirmation - Invoice #' . $subscription->id;
                                $to = $userdata['signup_firstname'];
                                // debug($to,1);
                                parent::client_email_order($to,$template,$title);
                            }

                            $json_param['status'] = 1;
                            $json_param['txt'] = 'Subscription Purchased';
                            echo json_encode($json_param);
                        }
                        else {
                            $json_param['status'] = 0;
                            if($json_param['txt'] == NULL)
                            {
                                $json_param['txt'] = 'Something Went Wrong';
                            }
                            echo json_encode($json_param);
                        }
                    // }
                    // else
                    // {
                    //     $json_param['status'] = 0;
                    //     $json_param['txt'] = 'Something Went Wrong';
                    // }
                // }
                // else
                // {
                //     $json_param['status'] = 0;
                //     $json_param['txt'] = 'Something Went Wrong';
                // }
            }
            else
            {
                $json_param['status'] = 0;
                $json_param['txt'] = 'Something Went Wrong';
                echo json_encode($json_param);
            }
        // }
        // else
        // {
        //     $json_param['status'] = 0;
        //     $json_param['txt'] = 'A Package is currently active!';
        // }
        
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

        $membership_id  =  $data['packages']['packages_id'];
        $data['packageid'] = $membership_id;

        $data['custom']  = $oid;

        // $data['success'] = g('base_url')."propackages/success?membershipid=".$membership_id."&oid=".$oid."&code=".md5($oid);
        // $data['notify'] = g('base_url')."propackages/notify?membershipid=".$membership_id."&oid=".$oid."&code=".md5($oid);
        // //debug(ENVIRONMENT,1);
        // $keys = $this->model_paypal_subscription->entrypoint($membership_id,$oid);
        // //debug($keys,1);

        // //debug($keys,1);
        // $data['planId'] = $keys['planId'] ;
        // $data['accesstoken'] = $keys['accesstoken'] ;
        // $data['token_type'] = $keys['token_type'] ;
        // $data['subscription_id'] = $membership_id;
        // $data['subscription_main_id'] = $keys['subscription_main_id'] ;

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
