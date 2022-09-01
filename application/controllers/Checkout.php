<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
require APPPATH.'third_party/braintree/lib/Braintree.php';
Braintree_Configuration::environment('production');
Braintree_Configuration::merchantId('76c87y6wx558hjx5');
Braintree_Configuration::publicKey('fc82qpyqwrg5jvjw');
Braintree_Configuration::privateKey('20f021db82e87727c42677aeb1f8663b');
*/
//Braintree_Configuration::environment('sandbox');
//Braintree_Configuration::merchantId('mx244v6hnqpgzzdt');
//Braintree_Configuration::publicKey('63qbzndtnnz8hy5k');
//Braintree_Configuration::privateKey('17e4a30c16b0125c0057f137d2feb001');

//require 'braintree/lib/Braintree.php';
//require_once(APPPATH."third_party/braintree/includes/braintree_init.php");

class Checkout extends MY_Controller
{

    public $discount;
    private $total_amount;
    private $tax;
    private $shipping_amount;


    function __construct()
    {
        parent::__construct();
        $this->total_amount = $this->cart->total();
        $this->tax = g('db.admin.tax_amount');
        $this->discount = $this->_set_discount();
        $this->shipping_amount = (($this->session->userdata('shippment_price')!=null) ? $this->session->userdata('shippment_price') : '0');
    }

    public function index()
    {
        global $config;
        //$this->layout = "front_checkout";
        // Get banner


         // if($this->userid == 0)
         //    redirect(g('base_url'));

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(13);

        // get page content
        $this->layout_data['title'] = "Cart";
        $data['title'] = $this->layout_data['title'];

        $data['cart_data'] = $this->cart->contents();

        $data['breadcrumb'] = array('child_one' => 'Checkout', 'child_two' => '');

        //$discount = (isset($this->session->userdata['logged_in']['coupon_value']) ?
        //	$this->session->userdata['logged_in']['coupon_value'] : 0);

        $data['country'] = $this->model_country->find_all(array('order'=>'country ASC'));
        //$data['region'] = $this->model_region->find_all();
        //debug(123/(100/20));exit;
        //$data['discount'] = $discount;
        $data['cart_total'] = $this->cart->total();

        $data['all_categories'] = $this->model_category->find_all_active();

        // debug($shipping,1);
        // $data['shipping'] = $shipping;
        // $this->session->set_userdata('shipping',$shipping);
        // debug($this->session);


        // discount coupon start
       $get_amount =price_without_symbol($this->cart->total());

    $coupon1 = $this->session->userdata('is_coupon');
    $coupon_type = $coupon1['coupon_type'];
    $coupon_value = $coupon1['coupon_value'];


    if ($coupon_type==1){
                  $pdiscount1 = intval($get_amount * $coupon_value) / 100;
                  $pdiscount = number_format((float)$pdiscount1, 2, '.', '');
                  $total1=$get_amount - $pdiscount;
                  $total=number_format((float)$total1, 2, '.', '');
                  $data['coupon_value_get'] = '%'.$coupon_value;
                  $data['coupon_total_get'] = $total;
                  $data['coupon_value_check'] = $coupon_value;
                  $data['total_check'] = $total;

                }
                else
                {
                    $total1 = floatval($get_amount - $coupon_value);
                    $total = number_format((float)$total1, 2, '.', '');
                    $data['coupon_value_get'] = '$'.$coupon_value; 
                    $data['coupon_total_get'] = $total;
                    $data['coupon_value_check'] = $coupon_value;
                    $data['total_check'] = $total;
              }

        $this->load_view("index", $data);
    }


    /*public function step2()
    {
        if($this->userid <= 0){
            redirect(g('base_url')."login");
        }
        elseif($this->cart->contents()==null){
            redirect(g('base_url'));
        }
        else{
            $this->layout = "front_checkout";
            $data['banner'] = "banner4";
            $data['txt'] = "";
            $this->layout_data['title'] = "Billing Information";
            $data['title'] = $this->layout_data['title'];


            $data['sub_title'] = "Contact Information";
            $data['breadcrumb'] = array('child_one'=>$data['title'],'child_two'=>'');
            $data['country'] = $this->model_country->find_all();

            $data['userInfo'] = $this->model_signup->find_by_pk($this->userid);
            $data['cart_data'] = $this->cart->contents();

            $this->load_view("step2" , $data);
        }
    }*/

    public function step2()
    {
        if($this->userid<1){
            redirect('login');
        }

        // debug($_SERVER['HTTP_REFERER']);
        // debug('==========');
        // debug($this->agent->is_referral());
        // debug('==========');
        // debug($this->agent->referrer(),1);
        global $config;
        //$this->layout = "front_checkout";
        /*$data['banner'] = "banner4";
        $data['txt'] = "";*/

        // Redirect if user is not Logged in
        // if($this->userid<1){
        //     redirect(g('base_url'));
        // }
        
        
        // debug($this->session->userdata,1);

        // Get banner
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(11);

        // get page content
        $this->layout_data['title'] = "Checkout";
        $data['title'] = $this->layout_data['title'];

        //$data['sub_title'] = "Checkout";
        //$params['where'] = array('cms_page_page' => $this->page_name);
        //$data['data'] = $this->model_cms_page->find_all_active($params);
        $data['cart_data'] = $this->cart->contents();
        $data['cart_total'] = $this->cart->total() ;
        $data['shipping_amount'] = $this->session->userdata['shippment_price'];
        $data['country'] = $this->model_country->find_all();
        $data['states'] = $this->model_state->find_all();
        // debug($data['states'],1);
        $data['userdata'] = $this->user_info;
        // debug($this->session->userdata,1);

        // discount coupon start
       $get_amount =price_without_symbol($this->cart->total());

        $coupon1 = $this->session->userdata('is_coupon');
        $coupon_type = $coupon1['coupon_type'];
        $coupon_value = $coupon1['coupon_value'];


    if ($coupon_type==1){
                  $pdiscount1 = intval($get_amount * $coupon_value) / 100;
                  $pdiscount = number_format((float)$pdiscount1, 2, '.', '');
                  $total1=$get_amount - $pdiscount;
                  $total=number_format((float)$total1, 2, '.', '');
                  $data['coupon_value_get'] = '%'.$coupon_value;
                  $data['coupon_total_get'] = $total;
                  $data['coupon_value_check'] = $coupon_value;
                  $data['total_check'] = $total;
                  $data['$coupon_type'] = $coupon_type;
                  $data['$pdiscount'] = $pdiscount;

                }
                else
                {
                    $total1 = floatval($get_amount - $coupon_value);
                    $total = number_format((float)$total1, 2, '.', '');
                    $data['coupon_value_get'] = '$'.$coupon_value; 
                    $data['coupon_total_get'] = $total;
                    $data['coupon_value_check'] = $coupon_value;
                    $data['total_check'] = $total;
                    $data['$coupon_type'] = $coupon_type;
                    $data['$pdiscount'] = $coupon_value;
              }

        $this->load_view("step2", $data);

    }

    public function remove_wishlist($id)
    {

        //debug($id,1);
        // if($this->userid <= 0)
        // {
        //  $result['status'] = false;
        //  $result['txt'] = 'You are not not login or not a registered member.';
        // }
        // else
        // {
            $product_id = intval($id);
            $id = $this->model_wishlist->remove_to_wishlist($product_id);
            //debug($id,1);
            if($id > 0)
            {
                $result['status'] = true;
                $where['where']['wishlist_user_id'] =  $this->userid;
                $result['wish_items'] = $this->model_wishlist->find_count($where);
                $result['txt'] = 'Thank you! item has been added in your wishlist.';
            }
            else
            {
                $result['status'] = false;
                $result['txt'] = 'Item Already added in your wishlist'; 
        }               
        //}
        redirect(g('base_url').'wishlist');
        echo json_encode($result);          

    }

    public function step3()
    {
        //debug(1,1);
        global $config;
        // if ($this->userid <= 0) {
        //     redirect(g('base_url'));
        // } else
        // if ($this->cart->contents() == null) {
        //     redirect(g('base_url'));
        // } else {
            // Get banner
            $data['inner_banner'] = $this->model_inner_banner->find_by_pk(12);
            //$this->layout = "front_checkout";
            $order_id = intval($this->input->get('oid'));
            //$data['heading'] = "Shopping Cart - Payment";
            //$params['where']['order_user_id'] = $this->userid;
            $orderDetail = $this->model_order->find_by_pk($order_id, false, $params);

            // Order Completed
            if (!array_filled($orderDetail)) {
                redirect(g('base_url'));
            }

            $where_param['joins'][] = array(
                "table" => "product",
                "joint" => "product.product_id = order_item.order_item_product_id",
                "type" => "left"
            );
            $where_param['where']['order_item_order_id'] = $orderDetail['order_id'];
            $order_items = $this->model_order_item->find_all($where_param);

            foreach ($order_items as $key => $val) {
                $data1[] = array(
                    'name' => $val['product_name'],
                    'description' => truncate(html_entity_decode($val['product_desc']), 50),
                    'quantity' => $val['order_item_qty'],
                    'price' => $val['order_item_price'],
                    'tax' => $this->tax,
                    'sku' => $val['product_name'],
                    'currency' => 'USD'
                    //'currency' => 'GBP'
                );
            }

            // $data['amount'] = $orderDetail['order_amount'];
            $data['amount'] = number_format($orderDetail['order_amount'],2);
            $data['tax'] = $this->tax;
            //$data['shipping_price'] = $this->shipping;
            $data['orderDetail'] = $orderDetail;
            $data['itemsss'] = $data1;
            $data['custom'] = $order_id;
            $data['success_url'] = g('base_url') . "checkout/success?oid=" . $order_id . "&code=" . md5($order_id);
            $data['notify_url'] = g('base_url') . "checkout/notify?oid=" . $order_id . "&code=" . md5($order_id);
            $data['cancel_url'] = g('base_url') . "checkout/error?oid=" . $order_id . "&code=" . md5($order_id);
            $data['cart_data'] = $this->cart->contents();
            // debug($data,1);

            $this->load_view("step3", $data);
       // }
    }

    public function success()
    {
        // if($this->userid <= 0){

        //     redirect(g('base_url')."user/login");
        // }

        $order_id = $_GET['oid'];

        $data['inner_banner'] = $this->model_inner_banner->get_banner(2);

        $data['heading'] = "Success Payment";

        $data['text'] = "Thank you! Payment process has been completed.";

        // if (ENVIRONMENT != 'development') {
        //     // get order detail
        //     $getorderDetail = $this->model_order->find_by_pk($order_id);
        //     $this->invoice_email($getorderDetail);
        // }
        // Set session to null
        $this->cart->destroy();
        $this->session->set_userdata('is_success',null);

        $this->session->set_userdata('is_coupon',null);
        //debug($data,1);
        // Custom
        $this->load_view("success" , $data);
    }

    public function step4()
    {
        //if($this->userid <= 0)
        //redirect(g('base_url')."login");

        $data['title'] = "Shopping Cart - Payment";
        $data['sub_title'] = "Shopping Cart - Payment";
        $data['breadcrumb'] = array('child_one' => $data['title'], 'child_two' => '');
        $data['country'] = $this->model_country->find_all();

        $order_id = intval($_GET['oid']);

        //$data = $this->get_data_authorize($order_id);
        //debug($data);exit;

        //$total_amount = $this->get_total_amount($order_id);

        //$items = $this->model_order_item->find_all(array('where'=>array('order_item_order_id'=>$order_id)));

        //foreach ($items as $key => $value) {
        //	$this->model_order_item->update_by_pk($value['order_item_id'],
        //		array('order_final_grand_total'=>$total_amount));
        //}

        //$data['custom'] = $order_id;
        //$data['success_url'] = g('base_url')."checkout/success?oid=".$order_id."&code=".md5($order_id);
        //$data['notify_url'] = g('base_url')."checkout/notify?oid=".$order_id."&code=".md5($order_id);
        //$data['cancel_url'] = g('base_url')."checkout/error?oid=".$order_id."&code=".md5($order_id);

        $this->load_view("step4", $data);
    }


    private function _set_discount()
    {

        $discount = 0;
        $data = isset($this->session->userdata['discount']) ? $this->session->userdata['discount'] : array();
        if (isset($data['coupon']) && array_filled($data['coupon'])) {
            $coupon_discount = $this->_set_coupon_discount($data['coupon']);

            // save discount amount in session start
            $session_data = array();
            $session_data['discount']['coupon'] = $data['coupon'];
            $session_data['discount']['coupon']['discount_amount'] = $coupon_discount;
            $this->session->set_userdata($session_data);
            // save discount amount in session End

            $discount += $coupon_discount;
        }

        return $discount;
    }

    private function _set_coupon_discount($data)
    {
        $coupon_discount = $this->model_coupon->calculate_discounted_amount($data['coupon_id'], $this->total_amount);
        return $coupon_discount;
    }

    public function ajax_discount()
    {

        //if($this->userid <= 0){
        if (1 == 2) {
            $json_param['status'] = false;
            $json_param['msg']['title'] = 'Error occurred';
            $json_param['msg']['desc'] = 'You are not logged in, please login first.';
            echo json_encode($json_param);
        } else {

            if (isset($_POST) && array_filled($_POST)) {
                $coupon = htmlentities(trim($this->input->post('coupon')));

                $data = $this->model_coupon->get_coupon_exist($coupon);

                if (isset($data) && array_filled($data)) {
                    $today = date('Y-m-d');
                    if (($today >= $data['coupon_start_date']) AND ($today <= $data['coupon_expire_date'])) {

                        /** Already used **/
                        //$oldCoupon = $this->model_order->find_all(array('where'=>array('order_user_id'=>$this->userid,'order_coupon_id'=>$data['coupon_id'])));

                        //if(count($oldCoupon) > 0){
                        if (1 == 2) {
                            $json_param['status'] = false;
                            $json_param['msg']['title'] = 'Error occurred';
                            $json_param['msg']['desc'] = 'You have already used this coupon.';
                        } else {

                            $coupon_data = array();
                            $coupon_data['coupon_id'] = $data['coupon_id'];

                            $session_data = array();
                            $session_data['discount']['coupon'] = $coupon_data;
                            $session_data['discount']['coupon']['info'] = $data;
                            $this->session->set_userdata($session_data);


                            $json_param['status'] = true;
                            //$json_param['msg']['title'] = 'Error occurred';
                            $json_param['msg']['desc'] = "Discount amount added in your order";
                        }
                    } else {
                        $json_param['status'] = false;
                        $json_param['msg']['title'] = 'Error occurred';
                        $json_param['msg']['desc'] = "Sorry, we were not able to recognize the Discount Code you used. Please try again.";
                    }
                } else {
                    $json_param['status'] = false;
                    $json_param['msg']['title'] = 'Error occurred';
                    $json_param['msg']['desc'] = "Sorry, we were not able to recognize the Discount Code you used. Please try again.";
                }
            } else {
                $json_param['status'] = false;
                $json_param['msg']['title'] = 'Error occurred';
                $json_param['msg']['desc'] = 'Error Found please try again';
            }
            echo json_encode($json_param);
        }


    }

    public function shippingStep()
    {
        $order_id = intval($_GET['oid']);

        $data['title'] = "Shipping";
        $data['sub_title'] = "Shopping Cart - Shipping";
        $data['breadcrumb'] = array('child_one' => $data['title'], 'child_two' => '');
        $data['country'] = $this->model_country->find_all();

        $orderDetail = $this->model_order->find_by_pk($order_id);
        if (count($orderDetail) > 0) {
            $data['order_id'] = $orderDetail['order_id'];
            $order_id = intval($orderDetail['order_id']);
        } else {
            redirect(g('base_url'));
        }
        $data['cart_data'] = $this->cart->contents();
        $data['orderDetail'] = $orderDetail;
        //$data = $this->get_data_authorize($order_id);
        //debug($data);exit;

        //$total_amount = $this->get_total_amount($order_id);

        //$items = $this->model_order_item->find_all(array('where'=>array('order_item_order_id'=>$order_id)));

        //foreach ($items as $key => $value) {
        //	$this->model_order_item->update_by_pk($value['order_item_id'],
        //		array('order_final_grand_total'=>$total_amount));
        //}

        $this->load_view("shippingStep", $data);
    }


    public function pay_with_paypal()
    {
        //debug($_POST,1);

        if ($this->validate("model_card")) {
            //debug($_POST,1);

            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    g('db.admin.paypal_client_id'),     // ClientID
                    g('db.admin.paypal_client_sceret')      // ClientSecret
                )
            );

            $apiContext->setConfig(
                array(
                    'mode' => 'live',
                )
            );

            mail('babar.hussaini@digitonics.com', 'maria alert 1', print_r($_POST, true));


            $carddata = $_POST['card'];
            //debug($carddata,1);

            $card = new PaymentCard();

            $card->setType($carddata['cardtype'])
                ->setNumber($carddata['card_no'])
                ->setExpireMonth($carddata['card_expiry'])
                ->setExpireYear($carddata['card_year'])
                ->setCvv2($carddata['card_cvv'])
                ->setFirstName($carddata['card_fname'])
                ->setBillingCountry("US")
                ->setLastName($carddata['card_lname']);

            //debug($card , 1);

            $fi = new FundingInstrument();
            //debug($fi,1);

            $fi->setPaymentCard($card);


            // ### Payer
            // A resource representing a Payer that funds a payment
            // For direct credit card payments, set payment method
            // to 'credit_card' and add an array of funding instruments.
            $payer = new Payer();
            $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));

            // ### Itemized information
            // (Optional) Lets you specify item wise
            // information


            $itemList = new ItemList();
            // $itemList->setItems(array($item1, $item2));

            // ### Additional payment details
            // Use this optional field to set additional
            // payment information such as tax, shipping
            // charges etc.
            $details = new Details();


            $amount = new Amount();
            $amount->setCurrency("AUD")
                ->setTotal($_POST['amount'])
                ->setDetails($details);
            //debug($amount , 1);


            // ### Transaction
            // A transaction defines the contract of a
            // payment - what is the payment for and who
            // is fulfilling it.
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent set to sale 'sale'
            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

            // For Sample Purposes Only.
            $request = clone $payment;


            try {

                mail('babar.hussaini@digitonics.com', 'maria alert 2', print_r($apiContext, true));

                $payment->create($apiContext);

                $updateorder = array(
                    'order_paypal_invoice_id' => $payment->transactions[0]->invoice_number,
                    'order_payment_status' => 1,
                    'order_card_fname' => $carddetails['card_fname'],
                    'order_card_lname' => $carddetails['card_lname'],
                    'order_card_type' => $carddetails['cardtype'],
                    'order_card_no' => $carddetails['card_no'],
                    'order_card_exp' => $carddetails['card_expiry'],
                    'order_card_year' => $carddetails['card_year'],
                    'order_card_cvv2' => $carddetails['card_cvv']
                );


                $this->model_order->update_by_pk($carddata['oid'], $updateorder);

                //parent::invoice($inserted_id,$contact_us_data['order_user_id']);
                $param['status'] = 1;
                $param['txt'] = 'Payment has successfully been charged';
                echo json_encode($param);


                //debug($carddata,1);


            } catch (Exception $ex) {

                $name = "code";
                $array = (array)$ex;
                $prefix = chr(0) . '*' . chr(0);
                $code = $array[$prefix . $name];

                if ($code == 401) {
                    $message = "Sorry! your card info is not authorized, <br/> Error Code:401";
                } elseif ($code == 404) {
                    $message = "The requested resource was not found or is not available. <br/> Error Code:404";
                } elseif ($code == 503) {
                    $message = "The service (server) is temporarily unavailable but should be restored in the future. <br/> Error Code:503";
                } elseif ($code == 500) {
                    $message = "An unexpected error occurred inside the server that prevented it from fulfilling the request. Please try later. <br/> Error Code:500";
                } else {
                    $message = 'Please try again, your provided card detail is not correct.';
                }
                $param['status'] = 0;
                $param['txt'] = $message;
                echo json_encode($param);

            }
        } else {
            $param['status'] = 0;
            $param['txt'] = 'No data post found';
            echo json_encode($param);
        }
    }


    public function braintree_merchant()
    {

        //require APPPATH.'third_party/braintree/lib/Braintree.php';

        if (count($_POST) > 0) {
            $orderID = intval($_POST['order_id']);
            if (isset($_POST['checkbox']) && $_POST['checkbox'] == 'on') {
                $orderDetail = $this->model_order->find_by_pk($orderID);
                $orderAmount = $this->model_order_item->find_all(array('where' => array('order_item_order_id' => $orderID)));
                $amount = 0;
                foreach ($orderAmount as $key => $value) {
                    $amount += $value['order_item_subtotal'];
                }

                $amount = ($amount + $_POST['extra_amount']);
                //echo $amount;exit;

                $token = $_POST['payment_method_nonce'];
                $result = Braintree_Transaction::sale(array(
                    'amount' => str_replace(',', '', number_format($amount, 2)),
                    'merchantAccountId' => '',
                    'paymentMethodNonce' => $token
                , 'options' => array(
                        'submitForSettlement' => True), 'customer' => array( /* Customer Details */
                        'firstName' => $orderDetail['order_firstname'],
                        'lastName' => isset($orderDetail['order_lastname']) ? $orderDetail['order_lastname'] : $orderDetail['order_firstname'],
                        'email' => $orderDetail['order_email'],
                        'phone' => $orderDetail['order_phone'])
                ));
                if ($result->success) {

                    $updateParam['order_payment_status'] = 1;
                    $updateParam['order_order_remarks'] = 'Success';
                    $updateParam['order_response'] = 'Success';
                    $this->model_order->update_by_pk($orderID, $updateParam);

                    $status = 1;
                    $return_msg = 'Thank you! your payment has been received.';
                    $url = g('base_url') . "checkout/success?oid=" . $orderID . "&code=" . md5($orderID);
                } else {
                    $status = 2;
                    $stripe_success = 2;
                    $return_msg = $result->message;
                    $url = g('base_url') . "checkout/step3?oid=" . $orderID . "&status=" . $status . "&msg=" . $return_msg;
                }
            } else {
                $status = 2;
                $stripe_success = 2;
                $return_msg = 'Please check mark the checkbox field and proceed.';
                $url = g('base_url') . "checkout/step3?oid=" . $orderID . "&status=" . $status . "&msg=" . $return_msg;
            }
            redirect($url);
        }
    }


    public function payline_payment()
    {
        $gw = new gwapi;

        if (count($_POST) > 0) {

            $order_id = intval($_POST['order_id']);
            $cardno = $_POST['card_no'];
            $cardexp = $_POST['card_expiry'];

            // get order detail
            $getorderDetail = $this->model_order->find_by_pk($order_id);
            $orderItem = $this->model_order_item->find_all(
                array('where' => array('order_item_order_id' => $order_id))
            );

            // get all items
            $allproducts = array();
            $total = 0;
            foreach ($orderItem as $key => $value) {
                $allproducts[] = $value['order_item_product_id'];
                $total += $value['order_item_price'];
            }

            // get all products
            $getAllProducts = $this->model_product->find_all(
                array('where_in' => array('product_id' => implode(',', $allproducts)))
            );

            // get product name
            $productName = array();
            foreach ($getAllProducts as $key => $value) {
                $productName[] = $value['product_name'];
            }

            // get username password from config
            $user = $this->layout_data['config_info']['admin']['payline_user'];
            $password = $this->layout_data['config_info']['admin']['payline_password'];

            $gw->setLogin($user, $password);

            $gw->setBilling(
                $getorderDetail['order_firstname'],
                $getorderDetail['order_lastname'],
                (empty($getorderDetail['order_company']) ? $getorderDetail['order_firstname'] : $getorderDetail['order_company']),
                $getorderDetail['order_address1'],
                $getorderDetail['order_address1'],
                $getorderDetail['order_city'],
                (empty($getorderDetail['order_state']) ? $getorderDetail['order_city'] : $getorderDetail['order_state']),
                $getorderDetail['order_zip'],
                $getorderDetail['order_country'],
                $getorderDetail['order_phone'],
                (empty($getorderDetail['order_fax']) ? $getorderDetail['order_phone'] : $getorderDetail['order_fax']),
                $getorderDetail['order_email'],
                'cocosorisi.com'
            );

            $gw->setShipping(
                $getorderDetail['order_firstname'],
                $getorderDetail['order_lastname'],
                $getorderDetail['order_address1'],
                $getorderDetail['order_address2'],
                $getorderDetail['order_city'],
                $getorderDetail['order_state'],
                $getorderDetail['order_zip'],
                $getorderDetail['order_country'],
                $getorderDetail['order_phone'],
                $getorderDetail['order_fax'],
                $getorderDetail['order_email'],
                $getorderDetail['order_email']
            );

            $ip = $_SERVER['HTTP_CLIENT_IP'] ? $_SERVER['HTTP_CLIENT_IP'] : ($_SERVER['HTTP_X_FORWARDE‌​D_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

            $gw->setOrder($order_id, implode(",", $productName), 0, 0, $order_id, $ip);

            $r = $gw->doSale($total, $cardno, $cardexp);

            if ($gw->responses['responsetext'] == 'SUCCESS') {

                $updateParam['order_payment_status'] = 1;
                $updateParam['order_order_remarks'] = $gw->responses['responsetext'];
                $updateParam['order_response'] = serialize($gw->responses);
                $this->model_order->update_by_pk($order_id, $updateParam);

                $this->invoice_email($getorderDetail);

                $success_url = g('base_url') . "checkout/success?oid=" . $order_id . "&code=" . md5($order_id);
                echo json_encode(array('status' => 1, 'message' => 'Thank you! your card has been charged.', 'url' => $success_url));
            } else {
                echo json_encode(array('status' => 0, 'message' => $gw->responses['responsetext']));
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Please enter the card detail'));
        }

    }

    public function invoice_preview()
    {
        $this->layout = "tkd_invoice";
        $order_id = intval($_GET['oid']);
        $getorderDetail = $this->model_order->find_by_pk($order_id);
        $param['joins'][] = array(
            "table" => "product",
            "joint" => "product.product_id = product.product_category_id"
        );

        $param['where']['order_item_order_id'] = $getorderDetail['order_id'];
        $data['order_item'] = $this->model_order_item->find_all($param);
        $data['order_detail'] = $getorderDetail;


        $content['template'] = $this->load->view("_layout/email_template/invoice", $data, true);

        $this->load_view("invoice_print", $content);


    }

    public function notify()
    {


        $data = $this->input->post();
        //$data = unserialize('a:4:{s:14:"payment_status";s:9:"Completed";s:6:"custom";s:1:"3";s:9:"paymentID";s:30:"PAYID-LXVFL3A3GE25705MM9846446";s:7:"payerID";s:13:"J34WR38M999SA";}');

        $serilize = serialize($data);

        // send mail for testing
        /*$to = "ericwalter.developer@gmail.com";
        $subject = "Paypal Response";
        $txt = "";
        $txt .= print_r($data,true);
        $txt .= $_GET['oid'];
        $txt .= $_GET['code'];
        $from = g("db.admin.email_contact_us") ;
        $headers = "From: $from";

        mail($to,$subject,$txt,$headers);*/


        $oid = $this->input->get('oid');
        $code = $this->input->get('code');

        if ($code == md5($oid)) {

            $order_id = $data['custom'];

            $status_codes = array("Default" => 0, "Completed" => 1, "Pending" => 2, "Denied" => 3, "Failed" => 4, "Reversed" => 5);

            $payment_status = $data['payment_status'];

            $updateParam['order_payment_status'] = $status_codes[$payment_status];
            //$updateParam['order_payment_comments'] = $payment_status;
            $updateParam['order_response'] = $serilize;
            $updateParam['order_merchant'] = "Paypal";

            $this->db->where('order_id', $order_id);
            $this->db->update('order', $updateParam);


            if ($updateParam['order_payment_status'] == 1) {

                if($this->session->has_userdata('couponSession')){

                     $couponSession = $this->session->userdata('couponSession');

                     $user_id = $couponSession['user_id'];
                     $package_id = $couponSession['package_id'];
                     $coupon_id = $couponSession['coupon_id'];
                     
                     $addCouponData = array(
                                    'couponhistory_couponid' => $coupon_id,
                                    'couponhistory_userid' => $user_id,
                                    'couponhistory_package_id' => $package_id,
                                    'couponhistory_orderid' => $order_id
                            );

                    $this->db->insert('fb_couponhistory', $addCouponData);

                }

                
                $order_detail_c = $this->model_order->find_by_pk($oid);
                $email = $order_detail_c['order_email'];
                $this->invoice_email($oid);
                //exit;
               // parent::invoice_admin($oid,$email);
            
                $data11['is_success'] = 1;
                $this->session->set_userdata($data11);
            }

        }

    }
    
    public function notify_without_payment(){
        $data = $this->input->post();
        $order_id= $data['oid'];
        $updateParam['order_payment_status'] = 1;
        // $updateParam['order_response'] = $serilize;
        // $updateParam['order_merchant'] = "None";

        $this->db->where('order_id', $order_id);
        $this->db->update('order', $updateParam);


            if ($updateParam['order_payment_status'] == 1) {

                
                // $order_detail_c = $this->model_order->find_by_pk($oid);
                // $email = $order_detail_c['order_email'];
                // $this->invoice_email($oid);
                //exit;
               // parent::invoice_admin($oid,$email);
            
                $data11['is_success'] = 1;
                $this->session->set_userdata($data11);
            }

        // }
        
        if($data11['is_success'] == 1){
            $this->json_param['status'] = 1;
            $this->json_param['txt'] = "Order placed successfully";
        }else
        {
            
            $this->json_param['txt'] = "Order not placed";
            $this->json_param['status'] = 0;
        }
      

        echo json_encode($this->json_param);
    }

    public function invoice_email($orderId)
        //public function invoice_email()
    {
        /*$order_id = 28;
        $getorderDetail = $this->model_order->find_by_pk($order_id);*/
 
        $title = 'Order Confirmation - Invoice #' . $orderId;

        $param['joins'][] = array(
            "table" => "packages",
            "joint" => "packages.packages_id = order.order_package_id"
        );

        $param['where']['order_id'] = $orderId;

        $data['orderDetail'] = $this->model_order->find_one($param);
        //$data['order_detail'] = $getorderDetail;
        
        $userId = $this->userid;
        $param2['where']['signup_id'] = $userId;
        $data['userdata'] = $this->model_signup->find_one($param2);

        $template = $this->load->view("_layout/email_template/invoice", $data, true);
        
        //$template = $this->load->view("_layout/email_template/invoice",$data,false);

         $to = $data['userdata']['signup_email'];
         // debug($data['userdata']);
         // debug($data['orderDetail']);
         // debug($to);
         // debug($template,1);
        //  debug($to); 
        //  debug(g("db.admin.email")); 
        //  debug($title); 
        //  debug($template,1);
        $this->model_email->invoice_email_temp($to, $template, $title);
    }



    /*public function success()
    {
        if(count($this->cart->contents())<1)
            redirect(g('base_url'));

        $data['title'] = "Shopping Cart - Success";
        $this->title = "Shopping Cart - Success";
        $data['banner'] = 'shop.jpg';
        $data['sub_title'] = "Shopping Cart - Success";
        //$data['country'] = $this->model_country->find_all();

        // Get Order ID
        $data['order_id'] = intval($_GET['oid']);
        // Get Cart
        $data['cart'] = $this->cart->contents();
        // Set data
        $data['userdata'] = $this->model_signup->find_by_pk($this->userid);
        $data['orderData'] = $this->model_order->find_by_pk($data['order_id']);

        // update order status
        $updateorder = array(
                      // 'order_paypal_invoice_id' =>  $payment->transactions[0]->invoice_number,
                      'order_payment_status' => 1,
                      );

        $this->model_order->update_by_pk($data['order_id'],$updateorder);

        // Delete cart values
        $this->cart->destroy();

        $array_items = array();
           $array_items = array('discount');
           $this->session->unset_userdata($array_items);

        $to = $data['userdata']['signup_email'];

        // Set email invoice
        $template = $this->load->view('_layout/email_template/invoice',$data,true);

        parent::client_email($to,$template,'Order Confirmation');

        //$template_admin = $this->load->view('_layout/email_template/invoice_admin',$data,true);
        //$db_to = g("db.admin.sales_email") ;
        //$to = isset($db_to) ? $db_to :g('sales_email');
        //parent::client_email($to,$template_admin,'You Received a New Order');

        //echo $template;exit;

        $this->load_view("final_step" , $data);
        //$this->load->view('_layout/email_template/invoice',$data);
    }*/


    /*public function notify(){

        $data = serialize($_POST);
        $dd['response_data'] = $data;
        $this->model_response->insert_record($dd);

        // $data = unserialize('a:53:{s:8:"mc_gross";s:5:"22.00";s:22:"protection_eligibility";s:8:"Eligible";s:14:"address_status";s:9:"confirmed";s:12:"item_number1";s:0:"";s:3:"tax";s:4:"0.00";s:12:"item_number2";s:0:"";s:8:"payer_id";s:13:"QNLY63LVJVU9Y";s:14:"address_street";s:34:"228 Park Ave S  New York, NY 10003";s:12:"payment_date";s:25:"04:17:40 Nov 15, 2016 PST";s:14:"payment_status";s:9:"Completed";s:7:"charset";s:12:"windows-1252";s:11:"address_zip";s:5:"10163";s:11:"mc_shipping";s:4:"0.00";s:11:"mc_handling";s:4:"0.00";s:10:"first_name";s:5:"Waqas";s:6:"mc_fee";s:4:"0.94";s:20:"address_country_code";s:2:"US";s:12:"address_name";s:11:"Waqas Ahmed";s:14:"notify_version";s:3:"3.8";s:6:"custom";s:0:"";s:12:"payer_status";s:10:"unverified";s:8:"business";s:24:"waqas.ahmed@tradekey.com";s:15:"address_country";s:13:"United States";s:14:"num_cart_items";s:1:"2";s:12:"mc_handling1";s:4:"0.00";s:12:"mc_handling2";s:4:"0.00";s:12:"address_city";s:8:"New York";s:11:"verify_sign";s:56:"ACUe-E7Hjxmeel8FjYAtjnx-yjHAAHAEhK550VBebjD5xWcxYDgNKihM";s:11:"payer_email";s:23:"waqasahmed.it@gmail.com";s:12:"mc_shipping1";s:4:"0.00";s:12:"mc_shipping2";s:4:"0.00";s:4:"tax1";s:4:"0.00";s:4:"tax2";s:4:"0.00";s:6:"txn_id";s:17:"3S898887GM483031M";s:12:"payment_type";s:7:"instant";s:9:"last_name";s:5:"Ahmed";s:13:"address_state";s:2:"NY";s:10:"item_name1";s:21:"Jerk Wings (10 Count)";s:14:"receiver_email";s:24:"waqas.ahmed@tradekey.com";s:10:"item_name2";s:12:"Jerk Chicken";s:11:"payment_fee";s:4:"0.94";s:9:"quantity1";s:1:"1";s:9:"quantity2";s:1:"1";s:11:"receiver_id";s:13:"C42T7TUR6PWBE";s:8:"txn_type";s:4:"cart";s:10:"mc_gross_1";s:5:"10.00";s:11:"mc_currency";s:3:"USD";s:10:"mc_gross_2";s:5:"12.00";s:17:"residence_country";s:2:"US";s:8:"test_ipn";s:1:"1";s:19:"transaction_subject";s:0:"";s:13:"payment_gross";s:5:"22.00";s:12:"ipn_track_id";s:13:"8e8653025ec2b";}');


        $data = $_POST;
        $serilize = serialize($data);

        $oid = $_GET['oid'];
        $code = $_GET['code'];
        if($code == md5($oid)){

            $order_id = $data['custom'];
            $status_codes = array("Default"=>0,"Completed"=>1,"Pending"=>2,"Denied"=>3,"Failed"=>4,"Reversed"=>5);
            $payment_status = $data['payment_status'];
            $getOrder = $this->model_order->find_by_pk($order_id);

//
//            $param['where']['coupon_name'] = (isset($this->session->userdata['couponcode']) ? $this->session->userdata['couponcode'] : '');
//
//            $promocode = $this->model_coupon->find_all($param);
//
//
//            $remaining = $promocode[0]['coupon_limit'] - 1;
//
//            $values = array(
//                        'coupon_limit' => $remaining,
//                        );
//
//            $coupon_id = $this->model_coupon->update_by_pk($promocode[0]['coupon_id'], $values);
//

            if(count($data) > 0){
                $updateParam['order_payment_status'] = $status_codes[$payment_status];
                $updateParam['order_order_remarks'] =$payment_status;
                $updateParam['order_response'] = $serilize;
                $this->model_order->update_by_pk($order_id,$updateParam);
            }

        }

    }*/

    

    // Payment method start Stripe
    public function stripe_payment()
    {
        $response = "";
        if (isset($_POST) && array_filled($_POST)) {
            $order_id = intval($this->input->post('oid'));
            try {
                require_once(APPPATH . 'libraries/stripe-sdk/init.php');//or you
                \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

                $token = $this->input->post('stripeToken');

                $custom_amount = number_format($_POST['amount'], 0);
                // debug($_POST,1);
                // debug($token);
                // debug($custom_amount);
                
                $charge = \Stripe\Charge::create(array(
                    "amount" => $custom_amount * 100,
                    "currency" => 'GBP',
                    "card" => $token,
                    "description" => "Payment Order"
                ));
                // debug($charge);
                // debug($this->total_amount,1);


                $charge = str_replace('Stripe\Charge JSON:', '', $charge);
                // debug($charge,1);

                $response = json_decode($charge, true);

                if ($response['status'] == 'succeeded') {

                    $order_payment_status = 1;
                } else {
                    $title = "Error found please try again";
                    $order_payment_status = 0;
                    $msg_type = 'error';
                }

            } // Since it's a decline, \Stripe\Error\Card will be caught
            catch (\Stripe\Error\Card $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                $title = $err;
                $order_payment_status = 0;
                $msg_type = 'error';
            } // Invalid parameters were supplied to Stripe's API
            catch (\Stripe\Error\InvalidRequest $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                $title = $err;
                $order_payment_status = 0;
                $msg_type = 'error';
            } // Authentication with Stripe's API failed
            catch (\Stripe\Error\Authentication $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                $title = $err;
                $order_payment_status = 0;
                $msg_type = 'error';
            } // Network communication with Stripe failed
            catch (\Stripe\Error\ApiConnection $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                $title = $err;
                $order_payment_status = 0;
                $msg_type = 'error';
            } // Display a very generic error to the user, and maybe send
            catch (\Stripe\Error\Base $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                $title = $err;
                $order_payment_status = 0;
                $msg_type = 'error';
            } // Something else happened, completely unrelated to Stripe
            catch (Exception $e) {
                $title = "Error Found";
                $order_payment_status = 0;
                $msg_type = 'error';
            }


            // debug($body,1);
            if ($order_payment_status == 1) {
                // $data11['is_success'] = 1;
                // $this->session->set_userdata($data11);
                $params = array();
                $params['order_payment_status'] = 1;
                $params['order_status'] = 1;
                $params['order_payment_comments'] = 'Completed';
                $params['order_merchant'] = 'Stripe';
                $params['order_response'] = serialize($response);
                // debug($update,1);
                $update = $this->model_order->update_by_pk($order_id, $params);
                
                
                $order_detail_c = $this->model_order->find_by_pk($order_id);
                if(!empty($order_detail_c['order_coupon_id']))
                {
                    $params_c = array();
                    $params_c['coupon_status'] = 0;
                    $update = $this->model_coupon->update_by_pk($order_detail_c['order_coupon_id'], $params_c);    
                }
                
                $param_getoi = array();
                $param_getoi['order_item_order_id'] = $order_id;
                $get_oi = $this->model_order_item->find_all($param_getoi);
                
                foreach ($get_oi as $key => $value) {
                    $qty = $value['order_item_qty'];
                    $product_id_oi = $value['order_item_product_id'];
                    
                    $get_product_io = $this->model_product->find_by_pk($product_id_oi);
                    $old_qty_io = $get_product_io['product_stock'];
                    
                    $new_qty = $old_qty_io - $qty;
                    
                    $params_c = array();
                    $params_c['product_stock'] = $new_qty;
                    $update = $this->model_product->update_by_pk($product_id_oi, $params_c);
                }
                
                redirect(l('checkout/success?oid=' . $order_id), true);
                // if (ENVIRONMENT != 'development') {
                //     // debug($order_id,1);
                //     $getorderDetail = $this->model_order->find_by_pk($order_id);
                //     $this->invoice_email($getorderDetail);
                // }
            } else {
                redirect(l('checkout/error?oid=' . $order_id."&error=".$body['error']['message']), true);
            }
        }
    }


    /**
     * FUNCTION USE FOR AUTHORIZE PAYMENT METHOD START
     */
    public function get_data_authorize($orderid)
    {
        $order_id = intval($orderid);
        $data = array();
        $config_value = $this->layout_data['config_info'];

        //$shipping_amount = $this->session->userdata['shipping_content']['shipping_amount'];

        if (intval($this->userid) > 0)
            $data = $this->model_signup->find_by_pk($this->userid);

        $vars['invoice']['invoice_no'] = $order_id;

        // CUSTOMER DATA START
        //$name = explode(' ', $_POST['order_shipping_name']);
        $firstname = $data['signup_firstname'];
        $lastname = (empty($data['signup_lastname']) ? $data['signup_firstname'] : $data['signup_lastname']);


        if (isset($data) && array_filled($data)) {
            $country_name = $this->model_country->find_by_pk($data['signup_country']);

            // CUSTOMER DATA START
            $vars['user']['firstname'] = $data['signup_firstname'];
            $vars['user']['lastname'] = $data['signup_lastname'];
            $vars['user']['address'] = $data['signup_address'];
            $vars['user']['city'] = $data['signup_city'];
            $vars['user']['country'] = $country_name['country'];
            $vars['user']['phone'] = $data['signup_phone'];
            $vars['user']['email'] = $data['signup_email'];

            $orderData = $this->model_order->find_by_pk($order_id);
            //debug($orderData);exit;
            // CUSTOMER DATA END
            // SHIPPING DATA START

            $orderCountry = $this->model_country->find_by_pk($orderData['order_country']);

            $vars['shipping']['firstname'] = $orderData['order_firstname'];
            $vars['shipping']['lastname'] = $orderData['order_lastname'];
            $vars['shipping']['address'] = $orderData['order_address1'];
            $vars['shipping']['city'] = $orderData['order_city'];
            $vars['shipping']['state'] = $orderData['order_city'];
            $vars['shipping']['country'] = $orderCountry['country'];
            $vars['shipping']['zip_code'] = $orderData['order_zip'];
            $vars['shipping']['phone'] = $orderData['order_phone'];
            $vars['shipping']['email'] = $orderData['order_email'];
            // SHIPPING DATA END
        }

        $authorize_url = $config_value['authorize_net_api'][0]['config_value'];
        $api_login_id = $config_value['api_login_id'][0]['config_value'];
        $transaction_key = $config_value['transaction_key'][0]['config_value'];
        $test_request = $config_value['test_request'][0]['config_value'];

        //debug($this->session->userdata['shipping_content']['shipping_amount'] , 1);
        //debug(total_invoice_amount(23 , 2 , 20) , 1);

        $total_amount = $this->get_total_amount($order_id);
        //debug($total_amount);exit;
        $shipment_price = (isset($this->session->userdata['shippment_price']) ? $this->session->userdata['shippment_price'] : 0);
        $total_amount = ($total_amount + $shipment_price);

        $fp_timestamp = time();
        $fp_sequence = "123" . time(); // Can be changed to an invoice or other unique number.

        $fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id, $transaction_key,
            $total_amount, $fp_sequence, $fp_timestamp);


        $vars['payment_method_data']['authorize_url'] = $authorize_url;
        $vars['payment_method_data']['api_login_id'] = $api_login_id;
        $vars['payment_method_data']['transaction_key'] = $transaction_key;
        $vars['payment_method_data']['total_amount'] = $total_amount;
        $vars['payment_method_data']['fp_timestamp'] = $fp_timestamp;
        $vars['payment_method_data']['fp_sequence'] = $fp_sequence;
        $vars['payment_method_data']['fingerprint'] = $fingerprint;

        //$vars['payment_method_data']['tax'] = $this->session->userdata['tax_content']['tax_amount'];

        if ($test_request == 1)
            $vars['payment_method_data']['test_request'] = true;
        else
            $vars['payment_method_data']['test_request'] = false;

        $vars['url']['return'] = g('base_url') . "checkout/stepfinal" . "?oid=" . $order_id;
        $vars['url']['cancel'] = g('base_url') . "checkout/step2?oid=" . $order_id;
        //$vars['url']['response'] = 'http://demo-logomajestic.com/ch/cart/authorize_payment_response';//l('cart/authorize_payment_response');

        // CHECKOUT DATA END

        //$data['payment_form'] = $this->load->view('checkout/authorize_payment_form' , $vars , true);

        //$data['status'] =  true; // Ok

        //echo json_encode($data);

        //debug($vars , 1);
        return $vars;

    }


    public function get_total_amount($order_id)
    {
        $total_amount = 0;
        $item_data = $this->model_order_item->get_order_items($order_id);

        foreach ($item_data as $key => $value) {

            $options = unserialize($value['order_item_option']);

            $amount = $value['order_item_subtotal'];
            if (isset($options['subscription_tenure'])) {
                $tenure = ($options['subscription_tenure'] == 2 ? '3' : '1');
                $amount = ($value['order_item_subtotal'] * $tenure);
            }
            $total_amount += $amount;
        }

        return $total_amount;
    }


    /**
     * PAYMENT RESPONSE FUNCTION START
     */
    public function authorize_payment_response()
    {
        //$_POST = unserialize('a:44:{s:15:"x_response_code";s:1:"1";s:22:"x_response_reason_code";s:1:"1";s:22:"x_response_reason_text";s:46:"(TESTMODE) This transaction has been approved.";s:10:"x_avs_code";s:1:"P";s:11:"x_auth_code";s:6:"000000";s:10:"x_trans_id";s:1:"0";s:8:"x_method";s:2:"CC";s:11:"x_card_type";s:16:"American Express";s:16:"x_account_number";s:8:"XXXX0002";s:12:"x_first_name";s:5:"Waqas";s:11:"x_last_name";s:5:"Ahmed";s:9:"x_company";s:0:"";s:9:"x_address";s:0:"";s:6:"x_city";s:6:"asdsad";s:7:"x_state";s:0:"";s:5:"x_zip";s:0:"";s:9:"x_country";s:5:"Egypt";s:7:"x_phone";s:0:"";s:5:"x_fax";s:0:"";s:7:"x_email";s:24:"waqas.ahmed@tradekey.com";s:13:"x_invoice_num";s:10:"INV-000104";s:13:"x_description";s:0:"";s:6:"x_type";s:12:"auth_capture";s:9:"x_cust_id";s:0:"";s:20:"x_ship_to_first_name";s:11:"Waqas Ahmed";s:19:"x_ship_to_last_name";s:0:"";s:17:"x_ship_to_company";s:0:"";s:17:"x_ship_to_address";s:27:"dasdasdsadasdasda asd sadsa";s:14:"x_ship_to_city";s:6:"asdsad";s:15:"x_ship_to_state";s:0:"";s:13:"x_ship_to_zip";s:4:"6565";s:17:"x_ship_to_country";s:5:"Egypt";s:8:"x_amount";s:6:"100.00";s:5:"x_tax";s:4:"0.00";s:6:"x_duty";s:4:"0.00";s:9:"x_freight";s:4:"0.00";s:12:"x_tax_exempt";s:5:"FALSE";s:8:"x_po_num";s:0:"";s:10:"x_MD5_Hash";s:32:"C81961A6C312678CB7D02C4D4421EFA4";s:16:"x_cvv2_resp_code";s:0:"";s:15:"x_cavv_response";s:0:"";s:14:"x_test_request";s:4:"true";s:15:"x_ship_to_phone";s:5:"54646";s:20:"x_cancel_link_method";s:6:"button";}');
        if (isset($_POST) && array_filled($_POST)) {
            $data = $_POST;
            $invoice_no = $_POST['x_invoice_num'];
            //$invoice_no = intval($no[1]);
            mail('babar.hussaini@digitonics.com', 'test', print_r($_POST, true));
            //$vars['id'] = $invoice_no;
            $vars['order_order_remarks'] = $_POST['x_response_reason_text'];
            $vars['order_payment_status'] = $_POST['x_response_code'];
            $vars['order_authorize_response_code'] = $_POST['x_response_code'];
            $vars['order_authorize_response_reason_code'] = $_POST['x_response_reason_code'];
            $vars['order_authorize_response_reason_text'] = $_POST['x_response_reason_text'];
            $vars['order_authorize_avs_code'] = $_POST['x_avs_code'];
            $vars['order_authorize_auth_code'] = $_POST['x_auth_code'];
            $vars['order_authorize_trans_id'] = $_POST['x_trans_id'];
            $vars['order_authorize_card_type'] = $_POST['x_card_type'];
            $vars['order_authorize_account_number'] = $_POST['x_account_number'];
            $vars['order_authorize_cvv2_resp_code'] = $_POST['x_cvv2_resp_code'];
            $vars['order_authorize_cavv_response'] = $_POST['x_cavv_response'];
            $vars['order_authorize_test_request'] = $_POST['x_test_request'];
            $vars['order_authorize_ship_to_phone'] = $_POST['x_ship_to_phone'];
            $vars['order_payment_post'] = serialize($_POST);
            $vars['order_status_message'] = $this->model_order->get_payment_status($_POST['x_response_code']);

            $this->model_order->update_by_pk($invoice_no, $vars);

            $invoice_num = trim($_POST['x_invoice_num']);

            //$this->myemail->payment_response_email('USER' , $invoice_num);

            //$this->myemail->payment_response_email('ADMIN', $invoice_num);
        }
    }

    public function add_cart()
    {
        $data_post = $this->input->post();
        if(count($data_post) > 0)
        {
            // debug($data_post,1);
            $color = $_POST['color'];
            $product_id = $_POST['product_id'];
            $param['where']['product_id'] = intval($data_post['product_id']);
            $product_data = $this->model_product->find_one($param);
            $product_id = $product_data['product_id'];

            $price = $product_data['product_price'];
            

            $data = array(
                'id'      => $product_id,
                'qty'     => (isset($data_post['product_qty']) && !empty($data_post['product_qty']) ? $data_post['product_qty'] : 0),
                'price'   => $price,
                'name'    => htmlentities($product_data['product_name']),
                'options' => array(
                    'product_sku'=>$product_data['product_sku'],
                    'product_stock'=>$product_data['product_stock'],
                    'product_color'=>$color,
                    'product_slug' => g('base_url')."product/detail/".$product_data['product_slug'],
                    'product_img' => Links::img($product_data['product_image_path'],$product_data['product_image']),

                ));
            $this->cart->product_name_rules = '[:print:]';
            $insert = $this->cart->insert($data);
            $cart_data = $this->cart->contents();
            // debug($cart_data,1);

            //if($price == 0 || $data['product_qty'] == 0){
            if($price == 0){
                $results['status'] = 0;
                $results['msg'] = "You can not add this product because price is not set yet.";
            }
            else{

                $results['status'] = 1;
                $results['cart_data'] = $cart_data;

                $results['total'] = price($this->cart->total());
                $results['total_items'] = $this->cart->total_items() ;
                //$results['img'] = g('base_url').$product_data[0]['pi_image_path'].$product_data[0]['pi_image'] ;
                //$results['name'] = $product_data[0]['product_name'] ;
                //$results['slug'] = g('base_url')."product-detail/".$product_data[0]['product_slug'] ;
                //$results['qty'] = $data['qty'];
                //$results['price'] = $product_data[0]['product_price'];
                //$results['delete_url'] = g('base_url').'checkout/delete/'.$end_index['rowid'];

                //$results['item_div'] = $this->item_div();
                //debug($results);
            }
        }
        else
        {
            redirect('404');
        }
        echo json_encode($results);
    }

    // Check product already exists or not in cart
    public function check_id_exist_cart($product_id, $type)
    {
        $cart_data = $this->cart->contents();
        //if(in_array($product_id,array_column($cart_data,'id'))){
        /*$data = array_column($cart_data,'options');

        foreach ($cart_data as $key=>$value):
            if( ($value['id']==$product_id) && ($value['options']['cart_type']==$type) ){
                return true;
            }
        endforeach;

        return false;*/

        //if( (in_array($product_id,array_column($cart_data,'id'))) &&  ($data[0]['cart_type']==$type) ){
        if(in_array($product_id,array_column($cart_data,'id'))){
            return true;
        }
        else{
            return false;
        }
    }

    /*
     * WITHOUT ADDONS
     *
     * public function add_cart()
    {
        if(count($_POST) > 0)
        {
            $error = array();
            // For Dropdowns

            if($_POST['wishlist'] == 1){
                $this->model_wishlist->remove_to_wishlist(intval($_POST['product_id']));
            }

            $param['where']['product_id'] = intval($_POST['product_id']);

//			$param['joins'][] = array(
//                "table"=>"product_image" ,
//                "joint"=>"product_id = pi_product_id AND pi_is_featured = 1" ,
//                "type"=>"left" ,
//                                );
            $product_data = $this->model_product->find_one($param);
            $product_id = $product_data['product_id'];

            //$price = $this->model_product->get_all_prices($product_data[0]);
            $price = $product_data['product_price'];

            //$product_weight = explode('.',$product_data[0]['product_weight']);
            //$pounds = $product_weight[0];
            //$ounce = $product_weight[1];

            $data = array(
                       'id'      => $product_id,
                       'qty'     => (isset($_POST['product_qty']) && !empty($_POST['product_qty']) ? $_POST['product_qty'] : 0),
                       'price'   => $price,
                       'name'    => htmlentities($product_data['product_name']),
                       'options' => array(
                                           'product_slug' => g('base_url')."product-detail/".$product_data['product_slug'],
                                           //'product_gamertag' => $_POST['Gamertag'],
                                           //'product_dropdown' => (count($_POST['dropdown'])>0 ? serialize($_POST['dropdown']) : ''),
                                           //'product_playwith' => $_POST['playwith'],
                                           'product_color' => $_POST['color'],
                                           //'product_pound' => $pounds,
                                           'product_img' => Links::img($product_data['product_image_path'],$product_data['product_image']),

                                           ));
            $this->cart->product_name_rules = '[:print:]';
            $insert = $this->cart->insert($data);

            $cart_data = $this->cart->contents();

            if($price == 0 || $_POST['product_qty'] == 0){
                $results['status'] = 0;
                $results['msg'] = "You can not add this product because price is not set yet.";
            }
            else{

                $results['status'] = 1;
                $results['cart_data'] = $cart_data;

                $results['total'] = price($this->cart->total());
                $results['total_items'] = $this->cart->total_items() ;
                //$results['img'] = g('base_url').$product_data[0]['pi_image_path'].$product_data[0]['pi_image'] ;
                //$results['name'] = $product_data[0]['product_name'] ;
                //$results['slug'] = g('base_url')."product-detail/".$product_data[0]['product_slug'] ;
                //$results['qty'] = $data['qty'];
                //$results['price'] = $product_data[0]['product_price'];
                //$results['delete_url'] = g('base_url').'checkout/delete/'.$end_index['rowid'];

                //$results['item_div'] = $this->item_div();
                //debug($results);
            }

        }
        else
        {
            redirect('404');
        }
        echo json_encode($results);
    }*/


    public function add_cart_package()
    {
        if (count($_POST) > 0) {
            $product_id = intval($_POST['product_id']);
            $price = $_POST['product_price'];
            if ($product_id == 1) {
                $productName = "Lifetime Service $10.99 / month";
            } else {
                $productName = "Lifetime Service $79.99 / year";
            }

            $data = array(
                'id' => $product_id,
                'qty' => (isset($_POST['product_qty']) && !empty($_POST['product_qty']) ? $_POST['product_qty'] : 0),
                'price' => $price,
                'name' => htmlentities($productName),
                'options' => array(
                    'product_slug' => g('base_url') . "services-plan",
                    'product_img' => Links::img($this->layout_data['logo']['logo_image_path'], $this->layout_data['logo']['logo_image']),
                    'product_sku' => "Package",
                ));

            $insert = $this->cart->insert($data);
            $cart_data = $this->cart->contents();

            if ($price == 0 || $_POST['product_qty'] == 0) {
                $results['status'] = false;
            } else {

                $results['status'] = true;
                $results['cart_data'] = $cart_data;

                $results['total'] = $this->cart->total();
                $results['total_items'] = $this->cart->total_items();
            }
        } else {
            redirect('404');
        }

        echo json_encode($results);
    }


    public function check_checkoutpage()
    {
        if ($this->userid > 0) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function updateShippment()
    {
        $rate = explode("~", $_POST['ShipRate']);
        $this->model_user->set_extended_session(
            array('shippment_price' => $rate[0]),
            array('shippment_value' => $rate[1]));

        $totalprice = price($rate[0] + $_POST['grandTotal']);
        echo json_encode(array('totalShipGrand' => $totalprice, 'shipPrice' => $rate[0]));
    }

    public function check_shipment_set()
    {
        if (isset($this->session->userdata['shippment_price']) && $this->session->userdata['shippment_price'] > 0) {
            $order_id = intval($_POST['oid']);
            $shipprice = $this->session->userdata['shippment_price'];

            $dd['order_shipment_price'] = $shipprice;
            $this->model_order->update_by_pk($order_id, $dd);

            $url = g('base_url') . "checkout/step3?oid=" . $order_id . "&code=" . md5($order_id);
            echo json_encode(array('status' => 1, 'txt' => $url));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function add_cart_subscription()
    {

        $this->cart->destroy();
        $bottle_id = intval($_POST['flavor_bottle_id']);
        $bottles = $this->model_bottle->find_all_active($param);
        $bottle_id = $bottles[0]['bottle_id'];

        if (intval($_POST['random_flavor']) == 1) {
            $random_flavors = $this->get_random_flavors();
            $likes = implode(',', $random_flavors['like']);
            $dislike = implode(',', $random_flavors['dislike']);
            $random_select = true;
        } else {
            $likes = (isset($_POST['flavor_like_id']) && !empty($_POST['flavor_like_id']) ? $_POST['flavor_like_id'] : '');
            $dislike = (isset($_POST['flavor_dislike_id']) && !empty($_POST['flavor_dislike_id']) ? $_POST['flavor_dislike_id'] : '');
            $random_select = false;
        }

        if (!empty($_POST['enhancement_id'])) {
            $enhancement_price = $this->model_enhancement_price->find_all_active(
                array('where_in' => array('enhancement_price_id' => explode(',', $_POST['enhancement_id'])))
            );
            foreach ($enhancement_price as $key => $value) {
                $get_enhancement_price += $value['enhancement_price_price'];
            }
        }

        if (!empty($_POST['enhancement_tenure'])) {
            $tenure = json_decode($_POST['enhancement_tenure'], true);
            foreach ($tenure as $key => $value) {
                $enhancement_tenure_data = $this->model_flavor_enhancement->find_all_active(array('where' =>
                    array('flavor_enhancement_id' => $key)));
                $tenureArr[] = $enhancement_tenure_data[0]['flavor_enhancement_name'] . "~" . $value;
            }

        }


        $data = array(
            'id' => $bottle_id,
            'qty' => 1,
            'price' => ($_POST['flavor_bottle_price']),
            'name' => 'E-Juice Script',
            'options' => array(
                'product_img' => $bottles[0]['bottle_image_path'] . $bottles[0]['bottle_image'],
                'flavor_id' => $likes,
                'flavor_dislike_id' => $dislike,
                'flavor_bottle_id' => (intval($_POST['flavor_bottle_id']) > 0 ? $_POST['flavor_bottle_id'] : '0'),
                'enhancement_id' => (intval($_POST['enhancement_id']) > 0 ? $_POST['enhancement_id'] : '0'),
                'additional_level' => (intval($_POST['additional_level']) > 0 ? $_POST['additional_level'] : '0'),
                'flavor_notes' => (isset($_POST['flavor_notes']) && !empty($_POST['flavor_notes']) ? $_POST['flavor_notes'] : ''),
                'enhancement_bottle_price' => (isset($_POST['enhancement_bottle_price']) && !empty($_POST['enhancement_bottle_price']) ? $_POST['enhancement_bottle_price'] : ''),
                'enhancement_bottle_price_id' => (isset($_POST['enhancement_bottle_price_id']) && !empty($_POST['enhancement_bottle_price_id']) ? $_POST['enhancement_bottle_price_id'] : ''),
                'is_addon' => false,
                'random_select' => $random_select,
                'tenure' => $tenureArr,
                'subscription_tenure' => (intval($_POST['subscription_tenure']) > 0 ? $_POST['subscription_tenure'] : 1),
                'just_bottle_price' => $_POST['flavor_bottle_price'],
            ));


        $insert = $this->cart->insert($data);
        $cart_data = $this->cart->contents();
        if (count($cart_data) > 0) {

            if (!empty($_POST['addon_id'])) {
                $this->add_addon_cart($_POST['addon_id']);
            }
            $results['status'] = true;
        } else
            $results['status'] = false;

        echo json_encode($results);
    }

    public function get_random_flavors()
    {
        $data = array();
        $params['order'] = 'RAND()';
        $params['limit'] = 6;
        $flavors = $this->model_flavor->find_all_active($params);

        $i = 1;
        foreach ($flavors as $key => $value) {
            if ($i < 4)
                $data['like'][$value['flavor_id']] = $value['flavor_id'];
            else
                $data['dislike'][$value['flavor_id']] = $value['flavor_id'];
            $i++;
        }

        return $data;
    }


    public function add_addon_cart($addon_id)
    {
        $addons = explode(',', $addon_id);
        $params['where_in'] = array('product_id' => $addons);
        $get_addons = $this->model_product->find_all($params);
        foreach ($get_addons as $key => $value) {

            $data = array(
                'id' => $value['product_id'],
                'qty' => 1,
                'price' => $value['product_addon_price'],
                'name' => $value['product_name'],
                'options' => array(
                    'product_slug' => $value['product_slug'],
                    'product_img' => g('base_url') . $value['product_image_path'] . $value['product_image'],
                    'is_addon' => true,
                ));
            $this->cart->insert($data);
        }

    }


    public function add_wishlist()
    {
        if ($this->userid <= 0) {
            $result['status'] = false;
            $result['txt'] = 'You are not not login or not a registered member.';
        } else {
            $product_id = intval($_POST['product_id']);
            $id = $this->model_wishlist->add_to_wishlist($product_id);
            if ($id > 0) {
                $result['status'] = true;
                $result['txt'] = 'Thank you! item has been added in your wishlist.';
            } else {
                $result['status'] = false;
                $result['txt'] = 'Sorry we are unable to save this item in your wishlist because you have already added this product.';
            }
        }

        echo json_encode($result);

    }

    /**
     * Delete Product in cart list
     */
    public function delete_item($id)
    {
        $data['rowid'] = $id;
        $data['qty'] = 0;

        // Get cart
        $cart = $this->cart->contents();
        // Get Image ID from cart to delete image
        $cart_img_id = $cart[$id]['options']['image']['image_id'];

        // Get record
        $data1 = $this->model_cart_file->find_by_pk($cart_img_id);
        // Delete record
        $this->model_cart_file->delete_by_pk($cart_img_id);
        // Delete Image
        unlink($data1['cart_file_image_path'] . $data1['cart_file_image']);
        unlink($data1['cart_file_image_path'] . "thumb/" . $data1['cart_file_image']);

        $this->cart->update($data);
        redirect('checkout');
    }


    public function update_qty()
    {
        $data['rowid'] = $_POST['id'];
        $data['qty'] = $_POST['qty'];

        $this->cart->update($data);
        echo json_encode(array('status' => 1));
        //redirect('checkout');
    }


    public function get_basket()
    {
        $result['total'] = price($this->cart->total());
        $result['total_items'] = $this->cart->total_items();
        echo json_encode($result);
    }


    public function clear_cart()
    {
        $this->cart->destroy();
        //echo 1;
        redirect(g('base_url'), true);
    }

    public function update_enhancement_price()
    {
        $enhancement_price = 0;
        $original_price = floatval($_POST['bottle_original_price']);

        if (!empty($_POST['enhancementsArr']) && is_array($_POST['enhancementsArr'])) {
            $enhancements = $this->model_enhancement_price->find_all_active(array('where_in' =>
                array('enhancement_price_id' => $_POST['enhancementsArr'])));

            foreach ($enhancements as $key => $value) {
                $enhancement_price += $value['enhancement_price_price'];
            }
        }

        $just_count = ($original_price + $enhancement_price);
        $count = price($original_price + $enhancement_price);
        echo json_encode(array('total' => $count, 'just_count' => $just_count));
    }

    public function update_enhancement_price_edit()
    {
        $enhancement_price = 0;
        $original_price = floatval($_POST['just_bottle_price']);

        if (!empty($_POST['enhancementsArr']) && is_array($_POST['enhancementsArr'])) {
            $enhancements = $this->model_enhancement_price->find_all_active(array('where_in' =>
                array('enhancement_price_id' => $_POST['enhancementsArr'])));

            foreach ($enhancements as $key => $value) {
                $enhancement_price += $value['enhancement_price_price'];
            }
        }

        $just_count = ($original_price + $enhancement_price);
        $count = price($original_price + $enhancement_price);
        echo json_encode(array('total' => $count, 'just_count' => $just_count));
    }

    /**
     * Update Cart Qty Function
     */

    public function update_qty_cart()
    {
        $input = $this->input->post();
        // debug($input,1);
        if (count($input) > 0) {
            if(array_filled($input)){
                $data['rowid'] = $input['id'];
                $data['qty'] = $input['qty'];
                $this->cart->update($data);
                echo json_encode(array('status' => 1,));
            }
            else{
                echo json_encode(array('status' => 2));
            }

        } else {
            echo json_encode(array('status' => 0));
        }
    }


    public function update_addon_price()
    {

        $addons = explode(',', $_POST['addons']);
        $params['where_in'] = array('product_id' => $addons);
        $get_addons = $this->model_product->find_all($params);
        foreach ($get_addons as $key => $value) {
            $price_list += $value['product_addon_price'];
        }

        $just_count = ($price_list + $_POST['enhancement_bottle_price']);
        $count = price($price_list + $_POST['enhancement_bottle_price']);
        echo json_encode(array('total' => $count, 'just_count' => $just_count));
    }

    public function remove_addon_price()
    {
        $addon_total = $_POST['price'];
        $total = $_POST['total_price'];
        $count = price($total - $addon_total);
        $just_count = ($total - $addon_total);
        echo json_encode(array('total' => $count, 'just_count' => $just_count));
    }

    // public function discount()
    // {
    //     if (count($_POST) > 0) {
    //         $coupon_code = $_POST['coupon_code'];
    //         $coupon_data = $this->model_coupon->find_all_active(array('where' => array('coupon_name' => $coupon_code)));
    //         $coupon_value = $coupon_data[0]['coupon_value'];

    //         if (count($coupon_data) > 0) {

    //             $this->model_user->set_extended_session(
    //                 array('is_coupon' => true,
    //                     'coupon_value' => $coupon_value,
    //                     'coupon_name' => $coupon_code));

    //             $result['status'] = 1;
    //             $result['txt'] = 'Coupon disocunt has been implemented in your grand total.';
    //         } else {
    //             $result['status'] = 0;
    //             $result['txt'] = 'Please provide the valid coupon code.';
    //         }

    //     } else {
    //         $result['status'] = 0;
    //         $result['txt'] = 'Please provide coupon code.';
    //     }
    //     echo json_encode($result);

    // }


     public function save_order()
    {
        // Define Custom rules for captcha

        if ($this->validate("model_order")) {
        // debug(1,1);
            $signupID = 0;
            $form_name = 'order';
            $contact_us_data = $_POST['order'];
            // coupon start
            $get_amount =price_without_symbol($this->cart->total());

            // coupon end

            $contact_us_data['order_user_id'] = $this->userid;
            $contact_us_data['order_total'] = $this->total_amount;
            $contact_us_data['order_shipping'] = 0;
            // $contact_us_data['order_shipping_firstname'] = $this->session->userdata['shipment'];
            // $contact_us_data['order_tax'] = $get_state_detail['state_tax'];
            $contact_us_data['order_amount'] = $this->total_amount;
            $contact_us_data['order_payment_status'] = 0;
            // debug($contact_us_data,1);            

            $inserted_id = $this->model_order->insert_record($contact_us_data);

            //debug($inserted_id);            

            if ($inserted_id > 0) {
                $cart_data = $this->cart->contents();
                //debug($cart_data,1);
                /** Add items **/

                foreach ($cart_data as $key => $value) {

                    //$oitem['order_currency_type'] = $this->currency;
                    $oitem['order_item_status'] = 1;
                    $oitem['order_item_order_id'] = $inserted_id;
                    $oitem['order_item_product_id'] = $value['id'];
                    $oitem['order_item_price'] = $value['price'];
                    $oitem['order_item_subtotal'] = $value['subtotal'];
                    $oitem['order_item_qty'] = $value['qty'];
                    $oitem['order_item_user_id'] = $this->userid;
                    $oitem['order_item_option'] = serialize($value['options']);
                    //$oitem['order_item_type'] = ($value['name'] == 'E-Juice Script' ? 1 : ($value['name'] == 'Membership Package' ? 3 : 2));
                    //$this->model_order_item->set_attributes($oitem);
                    //$this->model_order_item->save();

                    //debug($oitem);

                    $this->model_order_item->insert_record($oitem);

                }
                $url = g('base_url') . "checkout/step3?oid=" . $inserted_id;
                $param['status'] = 1;
                $param['txt'] = 'Order Saved Successfully';
                $param['url'] = $url;
                // debug($url,1);
                echo json_encode($param);
            } else {
                $param['status'] = 0;
                $param['txt'] = 'Failed to create order. Please try later.';
                echo json_encode($param);
            }
        } else {
            $param['status'] = 0;
            $param['txt'] = validation_errors();
            //$param['txt'] = 'Please complete all required fields';
            echo json_encode($param);
        }

    }
    //public function exam_email($getorderDetail)
    public function exam_email($order_id = 0)
    {
        //$order_id = 10;
        global $config;
        $getorderDetail = $this->model_order->find_by_pk($order_id);

        $title = 'Order Confirmation - Invoice #' . $getorderDetail['order_id'];

        $param['joins'][] = array(
            "table" => "product",
            "joint" => "product.product_id = order_item.order_item_product_id"
        );

        $param['where']['order_item_order_id'] = $getorderDetail['order_id'];
        $data['order_item'] = $this->model_order_item->find_all($param);
        $data['order_detail'] = $getorderDetail;
        $data['user_info'] = $this->user_info;

        $data['access_code'] = md5(time());
        $data['logo'] = $this->layout_data['logo'];

        // Update access code by Order
        $updparam = array(
            "order_access_code" => $data['access_code']
        );
        $this->model_order->update_by_pk($order_id,$updparam);

        //$template = $this->load->view("_layout/email_template/custom_order_invoice", $data, true);
        //$template = $this->load->view("_layout/email_template/invoice",$data,false);
        //$template = $this->load->view("_layout/email_template/custom_order_invoice",$data,false);
        $template = $this->load->view("_layout/email_template/custom_order_invoice",$data,true);
        //$template = $this->load->view("_layout/email_template/custom_order_invoice",$data,false);


        $to = $this->user_info['signup_email'];
        if(ENVIRONMENT!='development'){
            $this->model_email->invoice_email_temp($to, $template, $title);
        }
    }


    function USPSParcelRate($weight = "3", $dest_zip = "90210")
    {

// This script was written by Mark Sanborn at http://www.marksanborn.net
// If this script benefits you are your business please consider a donation
// You can donate at http://www.marksanborn.net/donate.

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

        $userName = '228TRADE3778'; // Your USPS Username
        $orig_zip = '90210'; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

//$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";
        $url = "http://production.shippingapis.com/ShippingAPI.dll";
//$url = "https://secure.shippingapis.com/ShippingAPI.dll";
        $ch = curl_init();

// set the target url
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// parameters to post
        curl_setopt($ch, CURLOPT_POST, 1);

        $data = "API=RateV3&XML=<RateV3Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>PRIORITY</Service><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$dest_zip</ZipDestination><Pounds>$weight</Pounds><Ounces>0</Ounces><Size>REGULAR</Size><Machinable>TRUE</Machinable></Package></RateV3Request>";

// send the POST values to USPS
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        debug($result);
        exit;
        $data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $data, $vals, $index);
        xml_parser_free($xml_parser);
        $params = array();
        $level = array();
        foreach ($vals as $xml_elem) {
            if ($xml_elem['type'] == 'open') {
                if (array_key_exists('attributes', $xml_elem)) {
                    list($level[$xml_elem['level']], $extra) = array_values($xml_elem['attributes']);
                } else {
                    $level[$xml_elem['level']] = $xml_elem['tag'];
                }
            }
            if ($xml_elem['type'] == 'complete') {
                $start_level = 1;
                $php_stmt = '$params';
                while ($start_level < $xml_elem['level']) {
                    $php_stmt .= '[$level[' . $start_level . ']]';
                    $start_level++;
                }
                $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
                eval($php_stmt);
            }
        }
        curl_close($ch);

// echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags
        debug($params['RATEV3RESPONSE']['1ST']['1']['RATE']);
    }

    // FEDEX START
    //
    function get_fedex()
    {
        //$states_id = 3655;

        /*$states_id = $_POST['states'];
        $states = $this->model_states->find_by_pk($states_id);


        $data['states'] = $states;*/
        $data['data'] = $_POST;
        //debug($data,1);

        //debug($data,1);
        $this->fedex_values($data);

        // echo 'response';

        // debug($required,1);


    }

    function fedex_values($data = '')
    {

        require_once APPPATH . "libraries/fedex-common.php";
        $path_to_wsdl = APPPATH . 'libraries/wsdl/RateService_v18.wsdl';
        ini_set("soap.wsdl_cache_enabled", "1");

        $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information
        // debug($client,1);

        $request['WebAuthenticationDetail'] = array(
            'ParentCredential' => array(
                'Key' => getProperty('parentkey'),
                'Password' => getProperty('parentpassword')
            ),
            'UserCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            )
        );
        $request['ClientDetail'] = array(
            'AccountNumber' => getProperty('shipaccount'),
            'MeterNumber' => getProperty('meter')
        );
        $request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'crs',
            'Major' => '18',
            'Intermediate' => '0',
            'Minor' => '0'
        );

        $request['ReturnTransitAndCommit'] = true;
        $request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
        $request['RequestedShipment']['ShipTimestamp'] = date('c');

        // echo 3;
        // debug(,1);

        $request['RequestedShipment']['ServiceType'] = $data['data']['ServiceType']; // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...

        //  INTERNATIONAL_ECONOMY
        //  INTERNATIONAL_FIRST
        //  INTERNATIONAL_PRIORITY
        //  INTERNATIONAL_ECONOMY_ FREIGHT
        //  INTERNATIONAL_PRIORITY_ FREIGHT


        $request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING'; // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
        $request['RequestedShipment']['TotalInsuredValue'] = array(
            'Ammount' => $this->cart->total(),
            'Currency' => 'USD'
        );


        $request['RequestedShipment']['Shipper'] = $this->addShipper();
        $request['RequestedShipment']['Recipient'] = $this->addRecipient($data);
        $request['RequestedShipment']['ShippingChargesPayment'] = $this->addShippingChargesPayment($data);
        $request['RequestedShipment']['PackageCount'] = '1';
        $request['RequestedShipment']['RequestedPackageLineItems'] = $this->addPackageLineItem1($data);


        if (setEndpoint('changeEndpoint')) {
            $newLocation = $client->__setLocation(setEndpoint('endpoint'));
        }

        $response = $client->getRates($request);

        // echo 4;
        // debug($response,1);

        try {

            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                $rateReply = $response->RateReplyDetails;

                // echo 'res';
                // debug(,1);
                $option .= '<select style="width:320px; height: 30px;" class="fedexprice" ><option value="">--Select Shipment--</option>';
                //debug($response->RateReplyDetails->ServiceType,1);
                if (isset($response->RateReplyDetails->ServiceType) && !empty($response->RateReplyDetails->ServiceType)) {

                    $package = str_replace('_', ' ', $response->RateReplyDetails->ServiceType);
                    $amount = $response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetChargeWithDutiesAndTaxes->Amount;
                    // debug($amount,1);
                    $option .= '<option date-price="' . $amount . '" value=' . $package . ' >' . $package . '</option>';
                } else {
                    foreach ($response->RateReplyDetails as $key => $value) {

                        $rate = $value->RatedShipmentDetails->ShipmentRateDetail->TotalNetChargeWithDutiesAndTaxes->Amount;
                        $option .= '<option date-price="' . $rate . '" value="' . $value->ServiceType . '" >"' . $value->ServiceType . '"</option>';

                    }
                }
                $option .= '</select>';
                $paramopt['status'] = 1;
                $paramopt['shipmentprice'] = price($amount);
                $ct = $this->cart->total();
                // debug($ct);
                $datac =  $this->session->userdata('coupon');
                if (isset($datac) && array_filled($datac)) {
                    $ct = $datac['coupon']['coupon_grandtotal'];
                }
                // debug($ct);
                $paramopt['sub_total'] = price($this->cart->total());
                $paramopt['total'] = price($ct + $amount);
                $paramopt['package'] = $package;
                $paramopt1['optionshtml'] = $option;
                // debug($paramopt,1);
                $shipdata = array(
                    'shippment_price' => $amount,
                    'shipment' => $package,
                    'all_data' => $data
                );
                // debug($data);
                // debug($response,1);
                
                $this->session->set_userdata($shipdata);

            } else {

                $paramopt['status'] = 0;
            }
            // debug($paramopt,1);
            echo json_encode($paramopt);

        } catch (SoapFault $exception) {


            if ($_POST['pound'] > 150) {
                # code...
                $paramser['status'] = 0;
                $paramser['txt'] = 'Fedex doesnot provide shipment in this service.';

            } else {
                $paramser['status'] = 0;
                $paramser['txt'] = 'Fedex doesnot provide shipment in this service.';

            }

            echo json_encode($paramser);


            // printFault($exception, $client);
        }


    }
    function addShipper()
    {
        $shipper = array(
            'Contact' => array(
                'PersonName' => 'Sender Name',
                'CompanyName' => 'Sender Company Name',
                'PhoneNumber' => '9012638716'
            ),
            // 'Address' => array(
            //  'StreetLines' => array('Address Line 1'),
            //  'City' => 'New York',
            //  'StateOrProvinceCode' => 'NY',
            //  'PostalCode' => '10009',
            //  'CountryCode' => 'US'
            // ),

            'Address' => array(
                'StreetLines' => array('Address Line 1'),
                // 'City' => 'Richmond',
                // 'StateOrProvinceCode' => 'BC',
                'PostalCode' => 'V7C4V4',
                'CountryCode' => 'CA',
                'Residential' => false
            )


        );
        return $shipper;
    }

    function addRecipient($data = '')
    {

        $recipient = array(
            'Contact' => array(
                'PersonName' => 'Recipient Name',
                'CompanyName' => 'Company Name',
                'PhoneNumber' => '9012637906'
            ),

            'Address' => array(
                'StreetLines' => array('Address Line 1'),
                // 'City' => 'New York',
                'StateOrProvinceCode' => $data['states']['code'],
                'PostalCode' => $data['data']['destination'],
                'CountryCode' => 'US'
            )
        );

        //debug($recipient,1);
        // debug($recipient,1);

        return $recipient;
    }


    function addShippingChargesPayment()
    {
        $shippingChargesPayment = array(
            'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
            'Payor' => array(
                'ResponsibleParty' => array(
                    'AccountNumber' => getProperty('billaccount'),
                    'CountryCode' => 'US'
                )
            )
        );
        return $shippingChargesPayment;
    }

    function addLabelSpecification()
    {
        $labelSpecification = array(
            'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
            'ImageType' => 'PDF',  // valid values DPL, EPL2, PDF, ZPLII and PNG
            'LabelStockType' => 'PAPER_7X4.75'
        );
        return $labelSpecification;
    }

    function addSpecialServices()
    {
        $specialServices = array(
            'SpecialServiceTypes' => array('COD'),
            'CodDetail' => array(
                'CodCollectionAmount' => array(
                    'Currency' => 'USD',
                    'Amount' => 1
                ),
                'CollectionType' => 'ANY' // ANY, GUARANTEED_FUNDS
            )
        );
        return $specialServices;
    }


    function addPackageLineItem1($data)
    {

        // echo 'weight';

        $packageLineItem = array(

            'SequenceNumber' => 1,
            'GroupPackageCount' => 1,
            'Weight' => array(
                'Value' => $data['data']['pound'],
                'Units' => 'LB'
            ),


            // 'Dimensions' => array(
            //  'Length' => 108,
            //  'Width' => 5,
            //  'Height' => 5,
            //  'Units' => 'IN'
            // )

        );

        // debug($packageLineItem,1);


        return $packageLineItem;
    }


    // FEDEX END


    public function set_shipping()
    {
        $shipdata = array(
            'shippment_price' => $_POST['price'],
            'shipment' => $_POST['value']
        );
        $this->session->set_userdata($shipdata);
        
        $param['status'] = 1;
        echo json_encode($param); 
        
    }
    public function get_usps()
    {


        $ounces = $_POST['ounces'];
        $pounds = $_POST['pound'];
        $originZip = "12345";
        $destZip = $_POST['destination'];


        // This script was written by Mark Sanborn at http://www.marksanborn.net
        // If this script benefits you are your business please consider a donation
        // You can donate at http://www.marksanborn.net/donate.

        // ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========
        $username = '452FISHB4309';
        // ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

        $url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";
        $ch = curl_init();

        // set the target url
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // parameters to post
        curl_setopt($ch, CURLOPT_POST, 1);

        // You would want to actually build this xml using dimensions
        // and other attributes but this is a bare minimum request as
        // an example.
        $data = "API=RateV4&XML=<RateV4Request USERID=\"{$username}\">
       <Revision>2</Revision>
       <Package ID=\"1ST\">
          <Service>ALL</Service>
          <ZipOrigination>{$originZip}</ZipOrigination>
          <ZipDestination>{$destZip}</ZipDestination>
          <Pounds>{$pounds}</Pounds>
          <Ounces>{$ounces}</Ounces>
          <Container />
          <Size>REGULAR</Size>
          <Width>2</Width>
          <Length>1</Length>
          <Height>3</Height>
          <Girth>10</Girth>
          <Machinable>false</Machinable>
       </Package>
    </RateV4Request>";

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        //$data = html_entity_decode($result);
        //$movies = new SimpleXMLElement($result);
        /* $test = '<?xml version="1.0" encoding="UTF-8"?>
     <RateV4Response><Package ID="1ST"><ZipOrigination>59759</ZipOrigination><ZipDestination>90210</ZipDestination><Pounds>5</Pounds><Ounces>1</Ounces><Size>REGULAR</Size><Machinable>FALSE</Machinable><Zone>5</Zone><Postage CLASSID="3"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt;</MailService><Rate>55.70</Rate></Postage><Postage CLASSID="2"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Hold For Pickup</MailService><Rate>55.70</Rate></Postage><Postage CLASSID="13"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Flat Rate Envelope</MailService><Rate>22.95</Rate></Postage><Postage CLASSID="27"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Flat Rate Envelope Hold For Pickup</MailService><Rate>22.95</Rate></Postage><Postage CLASSID="30"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Legal Flat Rate Envelope</MailService><Rate>22.95</Rate></Postage><Postage CLASSID="31"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Legal Flat Rate Envelope Hold For Pickup</MailService><Rate>22.95</Rate></Postage><Postage CLASSID="62"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Padded Flat Rate Envelope</MailService><Rate>22.95</Rate></Postage><Postage CLASSID="63"><MailService>Priority Mail Express 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Padded Flat Rate Envelope Hold For Pickup</MailService><Rate>22.95</Rate></Postage><Postage CLASSID="1"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt;</MailService><Rate>18.70</Rate></Postage><Postage CLASSID="22"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Large Flat Rate Box</MailService><Rate>18.75</Rate></Postage><Postage CLASSID="17"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Medium Flat Rate Box</MailService><Rate>13.45</Rate></Postage><Postage CLASSID="28"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Small Flat Rate Box</MailService><Rate>6.80</Rate></Postage><Postage CLASSID="16"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Flat Rate Envelope</MailService><Rate>6.45</Rate></Postage><Postage CLASSID="44"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Legal Flat Rate Envelope</MailService><Rate>6.45</Rate></Postage><Postage CLASSID="29"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Padded Flat Rate Envelope</MailService><Rate>6.80</Rate></Postage><Postage CLASSID="38"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Gift Card Flat Rate Envelope</MailService><Rate>6.45</Rate></Postage><Postage CLASSID="42"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Small Flat Rate Envelope</MailService><Rate>6.45</Rate></Postage><Postage CLASSID="40"><MailService>Priority Mail 2-Day&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt; Window Flat Rate Envelope</MailService><Rate>6.45</Rate></Postage><Postage CLASSID="4"><MailService>USPS Retail Ground&amp;lt;sup&amp;gt;&amp;#8482;&amp;lt;/sup&amp;gt;</MailService><Rate>15.91</Rate></Postage><Postage CLASSID="6"><MailService>Media Mail Parcel</MailService><Rate>5.22</Rate></Postage><Postage CLASSID="7"><MailService>Library Mail Parcel</MailService><Rate>4.99</Rate></Postage></Package></RateV4Response>';
         */

        $pos = strpos($result, '<?xml');
        $substr = substr($result, $pos);

        $movies = new SimpleXMLElement($substr);
        

        $newArr = array();
        $i = 1;
        foreach ($movies as $value) {
            foreach ($value->Postage as $key => $last) {
                $val1 = (array)$last->MailService;
                $val2 = (array)$last->Rate;
                //debug($val1);
                //debug($val2);
                $newArr[$i]['Service'] = $val1;
                $newArr[$i]['Rate'] = $val2;
                //$newArr[$val1] = $val2;
                $i++;
            }
        }


        //if(isset($newArr)){

        $datat['newArr'] = $newArr;
        
        // debug($movies);
        // debug($datat['newArr'],1);
        $abc = "<label>Select Shipping</label>";
        $abc .= "<select class='form-control shipping_dropd'>";
        $abc .= "<option value=''>Select</option>";
        foreach($datat['newArr'] as $key => $value)
        {
            $abc .= "<option value='{$value['Service'][0]}' data-attr='{$value['Rate'][0]}'>{$value['Service'][0]}</option>";
        }
        $abc .= "</select>";
        // debug($newArr,1);
        $param['txt'] = $abc;
        $param['status'] = 1;
        echo json_encode($param); 
        // return $datat['newArr'];
        //}
        //else{
        //	return array();
        //}

    }

    // Hyper Pay Request
    function hyperpay_response($order_id= 0 ) {
        /*debug($_POST);
        debug($_GET);*/

        $resourcePath = $this->input->get('resourcePath');

        $url = HYPER_PAY_BASE_URL . $resourcePath;
        $url .= "?entityId=" . HYPER_PAY_ENTITY_ID;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . HYPER_PAY_ACCESS_TOKEN));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, (ENVIRONMENT!='production')? false: true );// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $data = json_decode($responseData, true);
        // RESPONSE CODES
        // https://test.oppwa.com/v1/resultcodes

        $status_codes = array(
            "000.000.000",
            "000.100.110"
        );

        if(in_array($data['result']['code'], $status_codes)){

            $status_codes = array("Default" => 0, "Completed" => 1, "Pending" => 2, "Denied" => 3, "Failed" => 4, "Reversed" => 5);
            $payment_status = $data['payment_status'];

            $updateParam['order_payment_status'] = STATUS_ACTIVE;
            //$updateParam['order_payment_comments'] = $payment_status;
            $updateParam['order_response'] = serialize($data);

            $this->db->where('order_id', $order_id);
            $this->db->update('order', $updateParam);

            if ((ENVIRONMENT == 'testing') || (ENVIRONMENT == 'production')) {
                // get order detail
                $getorderDetail = $this->model_order->find_by_pk($order_id);
                $this->invoice_email($getorderDetail);
            }

            $data11['is_success'] = 1;
            $this->session->set_userdata($data11);
            redirect(g('base_url') . "checkout/success");
        }
        else{
            $this->session->set_flashdata('error_message', $data['result']['description']);
            redirect(g('base_url') . "checkout/step3?oid=" . $order_id );
        }

    }

    // PAYTAB Callback
    public function callback()
    {
        if (isset($_POST['transaction_id'])) {

            $data = $this->input->post();

            if($data['response_code']==100){
                $array = array(
                    'signup_is_subscribe' => $data['order_id'],
                );

                $this->db->where('signup_id', $this->userid);
                $this->db->update('wh_signup', $array);

                echo '<div class="alert alert-success"><strong>Success!</strong> Thankyou.</div>';
            }
            else{
                echo '<div class="alert alert-warning"><strong>Error</strong> - ' . $data['response_code'] . '</div>';
            }

            //file_put_contents('result.txt', json_encode($_POST));

            //echo 'Done';
        } else if ($_REQUEST['t'] == 'cancel') {

            echo '<div class="alert alert-warning"><strong>Error</strong> - Cancel</div>';
        } else {
            echo '0';
        }
    }
    public function discount()
  {


    if(count($_POST) > 0){
      
      $coupon_code = $_POST['coupon_name'];
      
      $coupon_data = $this->model_coupon->find_all_active(array('where'=>array('coupon_code'=>$coupon_code)));
      // debug($coupon_data,1); 

      if ($coupon_data[0]['coupon_type']==1){
        $coupon_value1 = $coupon_data[0]['coupon_rate'];
        $coupon_value = number_format((float)$coupon_value1, 2, '.', '');
                }
                else
                {
                $coupon_value =price_without_symbol($coupon_data[0]['coupon_rate']);
                // $coupon_value1 =substr(price($coupon_data[0]['coupon_rate']), 4); ;
                // $coupon_value = str_replace(array(',',' '),array('',''),$coupon_value1);
                }
        
                // debug($coupon_value,1);              
           // debug($coupon_data[0]['coupon_type'],1);    

      if(count($coupon_data) > 0){
                
                

         $today = date('Y-m-d');
                if(($today >= $coupon_data[0]['coupon_start_date']) AND ($today <= $coupon_data[0]['coupon_expire_date'])){

                  $get_amount =price_without_symbol($this->cart->total());

                if ($coupon_data[0]['coupon_type']==1){
                  $pdiscount1 = intval($get_amount * $coupon_value) / 100;
                  $pdiscount = number_format((float)$pdiscount1, 2, '.', '');
                  $total1=$get_amount - $pdiscount;
                  $total=number_format((float)$total1, 2, '.', '');
                   // debug($get_amount);
                   //   debug($coupon_value);
                   // debug($pdiscount);
                   //   debug($total,1);

                }
                else
                {
                  

              if(($coupon_value) > intval($get_amount)){
                $result['txt'] = 'Coupon discount greater than grand total.';
                echo json_encode($result);die;
              }else{
                    $total1 = floatval($get_amount - $coupon_value);
                    $total = number_format((float)$total1, 2, '.', '');
                     // debug($get_amount);
                     // debug($coupon_value);
                     // debug($total,1);
                       
              }

                }
                

        $setsession_val = array(
              'coupon_value'=>$coupon_value,
              'coupon_name'=>$coupon_code,
              'coupon_id' => $coupon_data[0]['coupon_id'],
              'coupon_code' => $coupon_data[0]['coupon_code'],
              'coupon_type' => $coupon_data[0]['coupon_type'],
              'discount_amount' =>  $pdiscount);
        // debug($setsession_val,1);

                $this->session->set_userdata('is_coupon',$setsession_val);
        $result['status'] = 1;
                if ($coupon_data[0]['coupon_type']==1){
        $result['couponamount'] = '% '.$coupon_value;
                }
                else
                {
                $result['couponamount'] = '$'.' '.$coupon_value;
                }

        $result['coupon_total'] = '$'.' '.$total;
        $result['txt'] = 'Discount Coupon has been implemented in your Grand Total.';
        //debug($calculate,1);
                }
                else
                {
                    $result['status'] = 0;
                    $result['txt'] = 'Sorry, Promo Code Has Expired or Is Not Valid.';
                }
      }
      else
      {
        $result['status'] = 0;
        $result['txt'] = 'Please provide the valid coupon code.';
      }


    }
    else
    {
      $result['status'] = 0;
      $result['txt'] = 'Please provide coupon code.';
    }
    echo json_encode($result);

  }


}
