<?
class Model_subscription extends MY_Model {

    protected $_table    = 'subscription';
    protected $_field_prefix    = 'subscription_';
    protected $_pk    = 'subscription_id';
    protected $_status_field    = 'subscription_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "subscription_id,subscription_membership_name, subscription_duration,subscription_amount,subscription_payment_status";
        
        // $this->pagination_params['where']['subscription_payment_status !='] = 0;


        //$this->pagination_params['where']['subscription_txn_message'] = 'ACTIVE';
        $this->pagination_params['where']['subscription_payment_status'] = 1;
        
        parent::__construct();
    }

    public function get_subscription_detail($subscription_id , $param = array() )
    {
        $params[ 'fields' ] = "subscription.* " ;
        if (isset($param) && array_filled($param)) {
            $params = $param;
        }
        return $this->find_by_pk($subscription_id , false, $params) ;
    }

  public function getExpireMembership($date ="")
  { 
     // $param = array();
    $param['where']['subscription_package_expire'] = $date;
    $expire_data  = $this->model_subscription->find_all($param);
    return $expire_data;
  }



  // public function getToBeExpireMembership($date ="")   
  // { 

  //   $param['where_string'] = " CURDATE() < subscription_package_expire AND  CURDATE() > $date ";
  //   $expire_data  = $this->model_subscription->find_all($param);
  //   return $expire_data;
  // }

   //public function get_order($user_id)
    public function get_subscription_by_user_id($user_id)
    {
        $param['fields'] = 'subscription_id ,subscription_payment_type, subscription_createdon as subscription_date, subscription_payment_status , subscription_package_item,subscription_status,subscription_txn_message,subscription_payment_status,subscription_package_name,subscription_package_start,subscription_amount,subscription_package_expire,subscription_accesstoken,subscription_sub_id,subscription_recurring';

        $param['where']["subscription_user_id"] = $user_id;
        $param['order'] = "subscription_id DESC";
        // $param['group'] = 'subscription_id';

        // if(!PAYMENT_MODE_IS_TEST)
        //     $param['where']["subscription_is_sandbox"] = 0;

        $data = $this->find_all($param);

        // if(isset($data) AND array_filled($data)) {
        //     foreach($data as $key=>$value) {
        //         $data[$key]['items'] = $this->model_shop_item->find_all(
        //             array(
        //                 'where'=>array('item_subscription_id'=>$value['subscription_id'])
        //             ));
        //     }
        // }

        return $data;
    }


    public function get_active_subscription_by_user_id($user_id)
    {
        $param['fields'] = 'subscription_id ,subscription_payment_type, subscription_createdon as subscription_date  , subscription_payment_status , subscription_status,subscription_txn_message,subscription_payment_status,subscription_package_name,subscription_package_start,subscription_amount,subscription_package_expire,subscription_package_item,subscription_package_leftitem';

        $param['where']["subscription_user_id"] = $user_id;
        // $param['group'] = 'subscription_id';

        // if(!PAYMENT_MODE_IS_TEST)
        //     $param['where']["subscription_is_sandbox"] = 0;

        $data = $this->find_one_active($param);
        return $data;
    }

    // public function get_payment_status($status)
    // {
    //     switch ($status) {
    //         case 1:
    //             $message = 'Payment Accepted';
    //             break;
    //         case 2:
    //             $message = 'Payment Declined';
    //             break;
    //         case 3:
    //             $message = 'Transaction Failed';
    //             break;  
    //         case 4:
    //             $message = 'Held for Review';
    //             break;  
    //         default:
    //             $message = 'subscription Placed';
    //             break;
    //     }
    //     return $message;
    // }

    public function get_payment_status($status)
    {
        switch ($status) {
            case 1:
                $message = 'COMPLETED';
                break;
            case 2:
                $message = 'APPROVAL PENDING';
                break;
            case 3:
                $message = 'SUSPENDED';
                break;  
            case 4:
                $message = 'CANCELLED';
                break;  
            case 11:
                $message = 'APPROVED';
                break; 
            case 0:
                $message = 'NOT ATTEMPT';
                break;  

            default:
                $message = 'SUBSCRIPTION REQUESTED';
                break;
        }
        return $message;
    }


// paypal subscription
// APPROVAL_PENDING. The subscription is created but not yet approved by the buyer. 2
// APPROVED. The buyer has approved the subscription. 11
// ACTIVE. The subscription is active.  1
// SUSPENDED. The subscription is suspended. 3 
// CANCELLED. The subscription is cancelled. 4
// EXPIRED. The subscription is expired.0

    public function get_fields()
    {
        return array(

            'subscription_id'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_id',
                'label'   => 'ID',
                'primary'   => 'primary',
                'type'   => 'hidden',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),

            'subscription_business_feature'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_business_feature',
                'label'   => 'ID',
                'primary'   => 'primary',
                'type'   => 'hidden',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),

            'subscription_membership_name'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_membership_name',
                'label'   => 'Package',
                'primary'   => 'primary',
                'type'   => 'hidden',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),

            'subscription_duration'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_duration',
                'label'   => 'Duration',
                'primary'   => 'primary',
                'type'   => 'hidden',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),


            

            

            'subscription_user_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscription_user_id',
                     'label'   => 'User Name',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),


            'subscription_membership_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscription_membership_id',
                     'label'   => 'subscription Package ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim|required'
                ),


            'subscription_package_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscription_package_name',
                     'label'   => 'subscription Package Name',
                     'type'   => 'text',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     // 'dt_attributes'   => array("width"=>"5%"),s
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                ),

               
         'subscription_amount' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscription_amount',
                     'label'   => 'Package Amount',
                     'type'   => 'text',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

           'subscription_discount'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_discount',
                'label'   => 'Package Discount',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),


           'subscription_coupon'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_coupon',
                'label'   => 'Package Discount',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),

           'subscription_coupon_id'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_coupon_id',
                'label'   => 'Coupon id',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),


            'subscription_package_expire'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_package_expire',
                'label'   => 'Package Expires On',
                'type'   => 'text',
                // 'default'   => '1',
                'attributes'   => array(),
                'rules'   => 'trim|required'
            ),      



            'subscription_package_item'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_package_item',
                'label'   => 'Package Item',
                'type'   => 'text',
                // 'default'   => '1',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),      

          'subscription_package_leftitem'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_package_leftitem',
                'label'   => 'Package Left Item',
                'type'   => 'text',
                // 'default'   => '1',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),      

          'subscription_recurring'  => array(  //0 : non recurring and 1 recurring 
                'table'   => $this->_table,
                'name'   => 'subscription_recurring',
                'label'   => 'Package Payment Type',
                'type'   => 'text',
                // 'default'   => '1',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),      


          'subscription_package'  => array(  
                'table'   => $this->_table,
                'name'   => 'subscription_package',
                'label'   => 'Package Detail',
                'type'   => 'text',
                // 'default'   => '1',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),      


//user info 

         'subscription_firstname'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_firstname',
                'label'   => 'Firstname',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'required|trim'
            ),

            'subscription_lastname'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_lastname',
                'label'   => 'Last Name',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'required|trim'
            ),


            'subscription_email'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_email',
                'label'   => 'Email',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required|valid_email|strtolower|trim|htmlentities'
            ),

               'subscription_phone'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_phone',
                'label'   => 'Phone',
                'type'   => 'text',
                'attributes'   => array(),
                'rules'   => 'required|trim|numeric|min_length[9]'
            ),

            'subscription_address'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_address',
                'label'   => 'Address',
                'type'   => 'text',
                'attributes'   => array(),
                'rules'   => 'required|trim|htmlentities'
            ),


            'subscription_city'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_city',
                'label'   => 'City',
                'type'   => 'textarea',
                'attributes'   => array(),
                'rules'   => 'required|trim|htmlentities'
            ),

              'subscription_country'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_country',
                'label'   => 'Country',
                'type'   => 'text',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),

            'subscription_state'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_state',
                'label'   => 'State',
                'type'   => 'textarea',
                'attributes'   => array(),
                'rules'   => 'required|trim|htmlentities'
            ),

    //payment parameters   
      

        'subscription_txn_message'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_txn_message',
                'label'   => 'Transaction Status Message',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),

        'subscription_payment_txn_id'  => array(  //plan id
                'table'   => $this->_table,
                'name'   => 'subscription_payment_txn_id',
                'label'   => 'Plan Id',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),   


        'subscription_sub_id'  => array(  //subscription id
                'table'   => $this->_table,
                'name'   => 'subscription_sub_id',
                'label'   => 'Subscription Id ',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),            


// PAYPAL SUBSCRIPOTION ATTRIBUTES
    'subscription_accesstoken'  => array( 
                'table'   => $this->_table,
                'name'   => 'subscription_accesstoken',
                'label'   => ' Access Token ',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),


'subscription_tokentype'  => array( 
                'table'   => $this->_table,
                'name'   => 'subscription_tokentype',
                'label'   => 'Token Type',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),


'subscription_planid'  => array(  
                'table'   => $this->_table,
                'name'   => 'subscription_planid',
                'label'   => 'PlanID',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),

// PAYPAL SUBSCRIPOTION ATTRIBUTES

                    

    'subscription_payment_type'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_payment_type',
                'label'   => 'Payment Method',
                'type'   => 'text',
                'default'   => '',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),   

   'subscription_payment_status'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_payment_status',
                'label'   => 'Payment Status',
                'type'   => 'switch',
               'type_dt'   => 'dropdown',
               'list_data' => array( 
                                        // 1 => "<span class=\"label label-success\">Completed</span>" ,  
                                        // 2 => "<span class=\"label label-warning\">Pending</span>"  ,
                                        // 3 => "<span class=\"label label-danger\">Denied</span>" ,  
                                        // 4 => "<span class=\"label label-info\">Failed</span>" ,  
                                        // 5 => "<span class=\"label label-danger\">Reversed</span>" ,  
                                        // 0 => "<span class=\"label label-default\">subscription Placed</span>" ,                                          
                                        1 => "<span class=\"label label-success\">COMPLETED</span>" ,  
                                        11 => "<span class=\"label label-warning\">ACTIVE</span>"  ,
                                        2 => "<span class=\"label label-danger\">APPROVAL_PENDING</span>" ,  
                                        3 => "<span class=\"label label-info\">SUSPENDED</span>" ,  
                                        4 => "<span class=\"label label-danger\">CANCELLED</span>" ,  
                                        0 => "<span class=\"label label-default\">SUBSCRIPTION REQUESTED</span>"
                                    ) ,
               'type_filter_dt'   => 'dropdown',
                'attributes'   => array(),
                'rules'   => 'text|trim|htmlentities'
            ),



     // 'order_payment_post'  => array(
     //            'table'   => $this->_table,
     //            'name'   => 'order_payment_post',
     //            'label'   => 'POST Response',
     //            'type'   => 'hidden',
     //            'attributes'   => array(),
     //            'rules'   => ''
     //        ),

              'subscription_paypal_date'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_paypal_date',
                'label'   => 'Paypal Date',
                'type'   => 'hidden',
                'attributes'   => array(),
                'rules'   => ''
            ),


              'subscription_paypal_payer_email'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_paypal_payer_email',
                'label'   => 'Payer Email',
                'type'   => 'hidden',
                'attributes'   => array(),
                'rules'   => ''
            ),
                
                
    
        'subscription_subcreated_post'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_subcreated_post',
                'label'   => 'Subscription created',
                'type'   => 'hidden',
                'attributes'   => array(),
                'rules'   => ''
            ),

 
        'subscription_activation_post'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_activation_post',
                'label'   => 'Subscription activation',
                'type'   => 'hidden',
                'attributes'   => array(),
                'rules'   => ''
            ),


        'subscription_payment_post'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_payment_post',
                'label'   => 'Post Data',
                'type'   => 'hidden',
                'attributes'   => array(),
                'rules'   => ''
            ),
                

             'subscription_createdon'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_createdon',
                'label'   => 'Created On',
                'type'   => 'hidden',
                'attributes'   => array(),
                'rules'   => ''
            ),


    

         
//shipment

            'subscription_status'  => array(
                'table'   => $this->_table,
                'name'   => 'subscription_
                ',
                'label'   => 'Status?',
                'type'   => 'switch',
                'default'   => '1',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),

           

        );
    }
}
?>