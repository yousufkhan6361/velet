<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."vendor/autoload.php");
use Twilio\Rest\Client;
use Twilio\Http\Response;

class Home extends MY_Controller {

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

        if($this->userid <= 0){
            // redirect(g('base_url').'user/index');
            redirect(g('base_url').'user/signup');
        }
        // debug(phpinfo(),1);
        global $config;

        // if($this->userid){

        //  $query = $this->db->query("SELECT * FROM fb_ads ad
        //                             INNEr JOIN fb_order od
        //                             ON ad.ads_user_id = od.order_user_id
        //                             WHERE od.order_payment_status = 1 AND od.order_package_name = 'Premium' AND ad.ads_status = 1 ");

        //  $orderAdds = $query->result_array();

        //  $query2 = $this->db->query("SELECT * FROM fb_ads ad
        //                              INNER JOIN fb_subscription sp
        //                              ON ad.ads_user_id = sp.subscription_user_id
        //                              WHERE sp.subscription_payment_status = 1 AND sp.subscription_membership_id = 3 AND ad.ads_status = 1");

        //  $subscriptionAdds = $query2->result_array();
        // }


        //  //showing ads for visitor
        // $par44['where']['ads_status'] = 1;
        // $par44['where']['ads_featured'] = 1;

        // $allAds = $this->model_ads->find_all_active($par44);


        // if($orderAdds){

        //    $data['ads'] = $orderAdds; 

        // }else if($userSubscriptionAutoRenewal){
            

        //     $data['ads'] = $subscriptionAdds; 

        
        // }else{

        //     $data['ads'] = $allAds; 
        // }

        // $data['ads'] = $allAds; 



        // //debug($data['ads'],1);

        //  $par['where']['favourites_user_id'] = $this->userid;
        //  $data['favourites'] = $this->model_favourites->find_all_active($par);

        // $par3['where']['ads_id'] = 1;
        // $data['businessAds'] = $this->model_ads->find_one($par3);
       /// debug($data['businessAds']);
         //debug($data['favourites']);
        // debug($data['banner'],1);

        // echo APPPATH;
        // exit;
        
        // Load View
        $this->load_view("index", $data);
    }


    public function sendSMS(){

    
        $number = $_POST['number'];
        $tokenNumber = $_POST['tokenNumber'];
         
        $sid    = "AC7447e958eadaf018acedcf124ee21a54"; 
        $token  = "5827d8d4eb53654696e39ae8c14a160e"; 
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create($number, // to 
                                   array(  
                                       "messagingServiceSid" => "MGffa4457c77a79fcef397842ce9a1e047",      
                                       "body" => "testing message " 
                                   ) 
                          ); 
         
        if($message->sid){
                $result['status'] = true;
                $result['txt'] = 'Your Message has been sent ';
        }else{
                $result['status'] = false;
                $result['txt'] = 'Your Message has not been sent ';
        }

        echo json_encode($result);    

        
    }

}
