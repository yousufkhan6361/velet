<?
class Model_paypal_subscription extends MY_Model {
  
    /**
     * TKD Email MODEL
     *
     * @package     Email Model
     * @author      
     * @version     1.0
     * @since       2020 
     */

    private $subscription_oid;
    public $order_oid;

    function __construct()
    {
        parent::__construct();

    }


   public function getPaypalToken($secretKey,$clientId){
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD,  $clientId .':'. $secretKey);

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Accept-Language: en_US';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $result=json_encode(['status'=>1,'msg'=>'Error:' . curl_error($ch)]);
        }
        curl_close($ch);
        // echo "<pre>";
        // print_r(json_decode($result));
        // exit();
        return json_decode($result);

    }


    public function entrypoint($subscription_oid="",$orderid)
    {
        global $config;
        $data = array();

        $this->subscription_oid = $subscription_oid;
        $this->order_oid = $orderid;

        $secretKey = PAYPAL_SECRETKEY;
        $clientId = PAYPAL_CLIENTID;

    
        $accesstoken = $this->getPaypalToken($secretKey,$clientId);

        //exit();
        //debug($accesstoken,1);
        //  echo "clientId";
        //  debug($clientId);    
        //  echo "secretKey";
        //  debug($secretKey);    
        // // var_dump($accesstoken);
        //  echo '<pre>';
        //  print_r($accesstoken);

        //  exit;

        $createPaypalProduct = $this->createPaypalProduct($secretKey,$accesstoken->access_token,$accesstoken->token_type);
                
         // echo '<pre>';
         // print_r($createPaypalProduct); //PRODUCT CREATED
         // exit;
                
                // echo $secretKey."<br>";
                // echo $accesstoken->access_token."<br>";
                // echo $accesstoken->token_type."<br>";
                // echo $createPaypalProduct->id."<br>";
        $createPaypalPlan = $this->createPaypalPlan($secretKey,$accesstoken->access_token,$accesstoken->token_type,$createPaypalProduct->id);
        
        // echo '<pre>';
        // print_r($createPaypalPlan);   //PLAN CREATED
        // exit;

        $planId = $createPaypalPlan->id;

        
        $par['where']['subscription_id'] = $this->order_oid;
        $subsData = $this->model_subscription->find_one($par);

        $subsAmount = $subsData['subscription_amount'];

        $subsBusinessFeatureStatus = $subsData['subscription_business_feature'];
        $subsName = $subsData['subscription_membership_name'];

        //debug($subsAmount,1);

       // debug($planId,1);

        // $activatePaypalPlan = $this->activatePaypalPlan($planId,$accesstoken->access_token,$accesstoken->token_type);
        //     echo '<pre>';
        //  print_r($activatePaypalPlan);         //ACTIVATING PLAN (ACTIVE BY DEFAULT)
         
            $response = array();
            $response['planId'] = $planId;
            $response['accesstoken'] = $accesstoken->access_token; 
            $response['token_type'] = $accesstoken->token_type; 
            //$response['subscription_id'] = $this->subscription_oid;

            //debug($response,1);

            if (isset($response) && array_filled($response)) {

                    $param = array();
                    $param['subscription_id'] = $this->order_oid;
                    $param['subscription_planid'] = $response['planId'];
                    $param['subscription_accesstoken'] = $response['accesstoken'];
                    $param['subscription_tokentype'] = $response['token_type'];
                    $param['subscription_membership_id'] = $this->subscription_oid;
                    $param['subscription_user_id'] = $this->userid;
                    $param['subscription_business_feature'] = $subsBusinessFeatureStatus;
                    $param['subscription_membership_name'] = $subsName;
                    $param['subscription_amount'] = $subsAmount;
                    $param['subscription_status'] = 0;
                    // $this->model_subscription->update_by_pk($this->subscription_oid,$param);
                    $this->model_subscription->set_attributes($param);
                    $inserted_id = $this->model_subscription->save();
                     //debug($inserted_id,1);
                }    
            $response['subscription_main_id'] = $inserted_id;
            // debug($response,1);  
            return $response;
    }


    public function createPaypalProduct($clientId,$accessToken,$tokenType){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/catalogs/products');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"name\": \"Lisence Recurring\",\n  \"type\": \"SERVICE\"}");

        $request_id = $this->subscription_oid;
        // $request_id = 100; //subscription id

        
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"name": "The Northern Ireland Package","type": "SERVICE"}');
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: '.$tokenType.' '.$accessToken.'';
        // $headers[] = 'Paypal-Request-Id: '.$clientId.'';
        $headers[] = 'Paypal-Request-Id: '.$request_id.'';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        // echo "<pre>";
        // print_r($result);
        // exit;
        if (curl_errno($ch)) {
            $result=json_encode(['status'=>1,'msg'=>'Error:' . curl_error($ch)]);
        }
        curl_close($ch);
        return json_decode($result);
    
    }

     public function createPaypalPlan($clientId,$accessToken,$tokenType,$productId){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/billing/plans');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     
        // $request_id = 100;
        $request_id = $this->subscription_oid;

        $par['where']['subscription_id'] = $this->order_oid;
        $subsData2 = $this->model_subscription->find_one($par);

       // debug($subsData2,1);

        $subsAmount2 = $subsData2['subscription_amount'];

        //debug($subsAmount2,1);
        

        // curl_setopt($ch, CURLOPT_POSTFIELDS, '{"product_id": "'.$productId.'","name": "Primerealtygroupx Plan1","description": "liscense plan","billing_cycles": [
        //         {  "frequency": {"interval_unit": "YEAR","interval_count": 1  },  "tenure_type": "REGULAR",  "sequence": 1,  "total_cycles": 50,  "pricing_scheme": {"fixed_price": {"value": 111.58,"currency_code": "USD"}  }}],"payment_preferences": {"service_type": "PREPAID","auto_bill_outstanding": true,"setup_fee": {"value": 10.30,"currency_code": "USD"},"setup_fee_failure_action": "CONTINUE","payment_failure_threshold": 3},"quantity_supported": true}');
        
        $details  = $this->model_packages->find_by_pk($this->subscription_oid);
        //debug($details,1);
        $package = unserialize($details['subscription_package']);
        //debug($package,1);
        // $interval_unit = $this->model_package->get_expiry_date_by_type($package['package_period'],true);
        $planname = !empty($details['packages_name']) ? $details['packages_name'] : 'The Northern Ireland Membership';
        $packageName = $details['packages_name'];

        // debug($package);
        // debug($package['package_period']);

        //$interval_unit = ($details['membership_duration'] == 2 ? 'YEAR' : 'MONTH ');
        
        $interval_unit = 'DAY';
        // $interval_count = ($package['package_period'] == 2 ?  1 : 12);
        //$interval_count = 1 ; //every 1 month or year
        $interval_count = $details['packages_days']; // every given days

       
        
//      $total_cycles = ($package['package_period_rate'] == 0 ? 1 : $package['package_period_rate']);
        $total_cycles = 999;


        //$amount = $details['packages_price'];
            //$subsAmount2;

        //debug($amount,1);
        

        // if($packageName == "Premium"){

        //     $amount += 6 ;

        // }

        //debug("sds".$amount,1);

        $auto_bill_outstanding = ($details['subscription_recurring'] == 0 ? 'false' : 'true');

         // debug($planname);
         // debug($interval_unit);
         // debug($interval_count);
         // debug($total_cycles);
         // debug($amount);
         // debug($auto_bill_outstanding);
         // exit;
        // debug($package);
         //debug($subsAmount2,1);


    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"product_id": "'.$productId.'","name": "'.$planname.'","description": "liscense plan","billing_cycles": [
                {  "frequency": {"interval_unit": "'.$interval_unit.'","interval_count": '.$interval_count.'  },  "tenure_type": "REGULAR",  "sequence": 1,  "total_cycles": '.$total_cycles.',  "pricing_scheme": {"fixed_price": {"value": '.$subsAmount2.',"currency_code": "GBP"}  }}],"payment_preferences": {"service_type": "PREPAID","auto_bill_outstanding": false,"setup_fee": {"value": 0,"currency_code": "GBP"},"setup_fee_failure_action": "CONTINUE","payment_failure_threshold": 3},"quantity_supported": true}');

        curl_setopt($ch, CURLOPT_POST, 1);


        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$tokenType.' '.$accessToken.'';
        // $headers[] = 'Paypal-Request-Id: '.$clientId.'';
        $headers[] = 'Paypal-Request-Id: '.$request_id.'';
        $headers[] = 'Prefer: return=representation';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    
        // echo "<pre>";
        // print_r(json_decode($result));
        // exit;
    
        return json_decode($result);
    }



    public function subscription_detail($paypal_subscription,$accessToken,$tokenType="",$subscription_id)
    {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/billing/subscriptions/$paypal_subscription");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Content-Type: application/json';
        // $headers[] = 'Authorization: Bearer A21AAFLIg0fgT5eHXvsENUXwNIYoMP60IT4OraxE0nmxBpsf0tbBGGi1cjdg7B0xJXmSdi3uyFrMtyM_BXTXNgJPRIdC6wNPw';
        $headers[] = 'Authorization: '.$tokenType.' '.$accessToken.'';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        // echo "<pre>"; 
        // print_r($result);

            return $result;
    }

  
}
?>