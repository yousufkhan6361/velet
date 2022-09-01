<?
class Model_order extends MY_Model
{


    protected $_table = 'order';

    protected $_field_prefix = 'order_';

    protected $_pk = 'order_id';

    protected $_status_field = 'order_status';

    public $pagination_params = array();

    public $relations = array();

    public $dt_params = array();

    public $_per_page = 20;


    function __construct()

    {

        // Call the Model constructor

        // $this->pagination_params['fields'] = 


        // "order_id,order_firstname,order_lastname,order_email,order_createdon,

        // CONCAT('$', ch_order.order_amount) as order_amount ,

        // order_payment_status";


        // Call the Model constructor

        $this->pagination_params['fields'] = "order_id,order_package_name,order_total,order_payment_status";


        //CONCAT('$', ch_order.order_amount) as order_amount ,

        // $this->pagination_params['joins'][] = array(

        //                     "table"=>"signup" , 

        //                     "joint"=>"signup_id = order_user_id", 

        // );


        $this->pagination_params['group'] = 'order_id';
        $this->pagination_params['where']['order_payment_status'] = 1;
        // $params[ 'fields' ]['order_payment_status'] = 1;


        $this->pagination_params['joins'][] = array(

            "table" => "order_item",

            "joint" => "order_item_order_id = order_id",

            "type" => "left"

        );

        /*if(isset($_REQUEST['filter']) AND array_filled($_REQUEST['filter']))
        {
            if((isset($_REQUEST['filter']['adshare_type'])) && (!empty($_REQUEST['filter']['adshare_type']))) {
                $this->pagination_params['where']["adshare.adshare_type"] = trim($_REQUEST['filter']['adshare_type']);
            }
        }*/

        $this->pagination_params['group'] = 'order_id';


        parent::__construct();

    }


    public function get_order_detail($order_id, $params = array())

    {

        $params['fields'] = "order.* ";

        return $this->find_by_pk($order_id, false, $params);

    }


    // Do Login

    public function auto_login($order_id)

    {

        // Get CodeIgnier Instance

        $order = $this->find_by_pk($order_id, true);

        if (!$order) {

            return FALSE;

        } else {

            $this->set_order_session($order);

            return true;

        }

    }


    // Do Login

    public function login()

    {

        // Get CodeIgnier Instance

        $CI = &get_instance();


        $params['where']['order_email'] = $this->input->post('order_email');

        $params['where']['order_password'] = md5($this->input->post('order_password'));

        $order = $this->find_one($params, true);

        if (!$order) {

            $CI->form_validation->set_message('order_check', 'Incorrect ordername or ID');

            return FALSE;

        } else {

            $this->set_order_session($order);

            return true;

        }


    }


    public function get_payment_status($status)

    {

        switch ($status) {

            case 1:

                $message = 'Payment Accepted';

                break;

            case 2:

                $message = 'Payment Declined';

                break;

            case 3:

                $message = 'Transaction Failed';

                break;

            case 4:

                $message = 'Held for Review';

                break;

            default:

                $message = 'Order Placed';

                break;

        }

        return $message;

    }


    public function set_order_session($order)

    {

        $CI = &get_instance();

        $sess_array = array(

            'id' => $order->order_id,

            'ordername' => $order->order_ordername,

            'first_name' => $order->order_firstname,

            'last_name' => $order->order_lastname,

            'nameprefix' => $order->order_nameprefix,

            'email' => $order->order_email,

            'country' => $order->order_country,

            'dob' => $order->order_dob,

            'order_title' => $order->order_title,

            'profile_image' => $order->order_profile_image_path . $order->order_profile_image,

            'is_admin' => $order->order_is_admin,

        );

        $CI->session->set_orderdata('logged_in', $sess_array);

    }

    // Check Code status
    public function verify_code($oid=0, $code=null)
    {
        $param['where']['order_id'] = $oid;
        $param['where']['order_access_code'] = $code;
        $result = $this->find_one($param);

        return $result;
    }


    public function get_fields($specific_field = "")

    {

        $fields =  array(


            'order_id' => array(

                'table' => $this->_table,

                'name' => 'order_id',

                'label' => 'ID',

                'primary' => 'primary',

                'type' => 'hidden',

                'attributes' => array(),

                'js_rules' => '',

                'rules' => 'trim'

            ),

            
            'order_user_id' => array(

                'table' => $this->_table,

                'name' => 'order_user_id',

                'label' => 'User Name',

                'type' => 'hidden',

                'type_dt' => 'text',

                'attributes' => array(),

                'dt_attributes' => array("width" => "5%"),

                'js_rules' => '',

                'rules' => 'trim'

            ),

            'order_package_id' => array(

                'table' => $this->_table,

                'name' => 'order_package_id',

                'label' => 'Package Id',

                'type' => 'hidden',

                'type_dt' => 'text',

                'attributes' => array(),

                'dt_attributes' => array("width" => "5%"),

                'js_rules' => '',

                'rules' => 'trim|required'

            ),

            'order_package_name' => array(

                'table' => $this->_table,

                'name' => 'order_package_name',

                'label' => 'Package Name',

                'type' => 'hidden',

                'type_dt' => 'text',

                'attributes' => array(),

                'dt_attributes' => array("width" => "5%"),

                'js_rules' => '',

                'rules' => 'trim|required'

            ),


            'order_amount' => array(
                'table' => $this->_table,
                'name' => 'order_amount',
                'label' => 'order amount',
                'type' => 'text',
                'default' => '',
                'attributes' => array(),
                'rules' => 'trim'
            ),

            'order_package_days' => array(
                'table' => $this->_table,
                'name' => 'order_package_days',
                'label' => 'Days',
                'type' => 'hidden',
                'default' => '',
                'attributes' => array(),
                'rules' => 'trim'
            ),

            // Total amount (excluding amount + shipment)
            'order_total' => array(

                'table' => $this->_table,

                'name' => 'order_total',

                'label' => 'Total',

                'type' => 'text',

                'attributes' => array(),

                'js_rules' => '',

                'rules' => 'trim'

            ),



            // 'order_firstname' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_firstname',

            //     'label' => 'Firstname',

            //     'type' => 'text',

            //     'default' => '',

            //     'attributes' => array(),

            //     'rules' => 'required|trim'

            // ),


            // 'order_lastname' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_lastname',

            //     'label' => 'Lastname',

            //     'type' => 'text',

            //     'default' => '',

            //     'attributes' => array(),

            //     'rules' => 'required|trim'

            // ),

            // 'order_company' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_company',

            //     'label' => 'Company',

            //     'type' => 'text',

            //     'default' => '',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),

            // 'order_address1' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_address1',

            //     'label' => 'Address',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'trim|htmlentities'

            // ),

            // 'order_city' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_city',

            //     'label' => 'City',

            //     'type' => 'textarea',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),


            // 'order_country' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_country',

            //     'label' => 'Country',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),

            // 'order_phone' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_phone',

            //     'label' => 'Phone',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'trim|regex_match[/^[\d\(\)\-+ ]+$/]'

            // ),

            'order_email' => array(

                'table' => $this->_table,

                'name' => 'order_email',

                'label' => 'Email',

                'type' => 'hidden',

                'attributes' => array(),

                'js_rules' => 'required',
                'type_filter_dt' => 'text',

                'rules' => 'strtolower|trim|htmlentities'

            ),





            /*'order_fax' => array(

                'table' => $this->_table,

                'name' => 'order_fax',

                'label' => 'Fax',

                'type' => 'text',

                'attributes' => array(),

                'rules' => 'required|trim|numeric'

            ),*/

            /*
            'order_quantity' => array(

                'table' => $this->_table,

                'name' => 'order_quantity',

                'label' => 'Quantity',

                'type' => 'text',

                'attributes' => array(),

                'js_rules' => '',

                'rules' => 'trim'

            ),


            'order_shipment_price' => array(

                'table' => $this->_table,

                'name' => 'order_shipment_price',

                'label' => 'Shipment Price',

                'type' => 'hidden',

                'attributes' => array(),

                'js_rules' => '',

                'rules' => 'required'

            ),


            'order_shipment_package' => array(

                'table' => $this->_table,

                'name' => 'order_shipment_package',

                'label' => 'Shipment Package',

                'type' => 'hidden',

                'attributes' => array(),

                'js_rules' => '',

                'rules' => 'trim'

            ),*/




            // 'order_merchant' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_merchant',

            //     'label' => 'Merchant',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'trim|htmlentities'

            // ),

             'order_paymentID' => array(
                 'table'   => $this->_table,
                 'name'   => 'order_paymentID',
                 'label'   => 'order paymentID',
                 'type'   => 'text',
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'trim'
              ),


               'order_payerID' => array(
                 'table'   => $this->_table,
                 'name'   => 'order_payerID',
                 'label'   => 'order payerID',
                 'type'   => 'text',
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'trim'
              ),


            /*'order_address2' => array(

                'table' => $this->_table,

                'name' => 'order_address2',

                'label' => 'Address2',

                'type' => 'textarea',

                'attributes' => array(),

                'rules' => 'trim|htmlentities'

            ),*/





            // 'order_state' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_state',

            //     'label' => 'State',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'required|trim'

            // ),


            // 'order_zip' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_zip',

            //     'label' => 'Zip Code',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),

            // 'order_tax' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_tax',

            //     'label' => 'Tax',

            //     'type' => 'text',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),

            // Order amount (include product + tax + shipping)
            

            /*'order_password' => array(

                'table' => $this->_table,

                'name' => 'order_password',

                'label' => 'Password',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim|matches[retype]|md5'

            ),*/


            /*'order_package' => array(

                'table' => $this->_table,

                'name' => 'order_package',

                'label' => 'Chose Program',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => ''

            ),*/

           /* 'order_is_usa' => array(

                'table' => $this->_table,

                'name' => 'order_is_usa',

                'label' => 'Is USA',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => ''

            ),*/


            /*'order_shipment_special_price' => array(

                'table' => $this->_table,

                'name' => 'order_shipment_special_price',

                'label' => 'shipment price',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => ''

            ),*/


            /*'order_gender' => array(

                'table' => $this->_table,

                'name' => 'order_gender',

                'label' => 'order Gender',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim|'

            ),*/





           /* 'order_newsletter_subscribed' => array(

                'table' => $this->_table,

                'name' => 'order_newsletter_subscribed',

                'label' => 'order Newsletter Subscribed',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim'

            ),*/


           /* 'order_authorize_responuno_reason_code' => array(

                'table' => $this->_table,

                'name' => 'order_authorize_responuno_reason_code',

                'label' => 'Reason Code',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => '|trim'

            ),


            'order_authorize_responuno_reason_text' => array(

                'table' => $this->_table,

                'name' => 'order_authorize_responuno_reason_text',

                'label' => 'Reason Text',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => '|trim'

            ),


            'order_authorize_card_type' => array(

                'table' => $this->_table,

                'name' => 'order_authorize_card_type',

                'label' => 'Card Type',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => '|trim'

            ),*/


            'order_response' => array(

                'table' => $this->_table,

                'name' => 'order_response',

                'label' => 'Order Response',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim'

            ),

            
            'order_access_code' => array(

                'table' => $this->_table,

                'name' => 'order_access_code',

                'label' => 'Order Access code',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim'

            ),


            /*'order_dob' => array(

                'table' => $this->_table,

                'name' => 'order_dob',

                'label' => 'Date of Birth',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim|strip_tags'

            ),*/


           /* 'order_emergency_contact' => array(

                'table' => $this->_table,

                'name' => 'order_emergency_contact',

                'label' => 'Emergency Contact',

                'type' => 'text',

                'attributes' => array(),

                'rules' => '|trim'

            ),


            'order_medical_information' => array(

                'table' => $this->_table,

                'name' => 'order_medical_information',

                'label' => 'Medical Information',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'trim'

            ),*/

            // 'order_shipment_address' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_shipment_address',

            //     'label' => 'Shipment info',

            //     'type' => 'hidden',

            //     'attributes' => array(),

            //     'rules' => 'trim|required'

            // ),


            'order_createdon' => array(

                'table' => $this->_table,

                'name' => 'order_createdon',

                'label' => 'Registered On',

                'type' => 'hidden',

                'attributes' => array(),

                'rules' => ''

            ),


            'order_payment_status' => array(

                'table' => $this->_table,

                'name' => 'order_payment_status',

                'label' => 'Payment Status',

                'type' => 'switch',

                'type_dt' => 'dropdown',

                'list_data' => array(

                    1 => "<span class=\"label label-order-completed\">Completed</span>",

                    2 => "<span class=\"label label-order-pending\">Pending</span>",

                    3 => "<span class=\"label label-order-denied\">Denied</span>",

                    4 => "<span class=\"label label-order-failed\">Failed</span>",

                    5 => "<span class=\"label label-order-reversed\">Reversed</span>",

                    0 => "<span class=\"label label-order-place\">Order Placed</span>",

                ),

                'type_filter_dt' => 'dropdown',

                'attributes' => array(),

                'rules' => 'text|trim|htmlentities'

            ),


            // 'order_payment_comments' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_payment_comments',

            //     'label' => 'Status Response',

            //     'type' => 'hidden',

            //     'default' => '',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),

            // 'order_message' => array(

            //     'table' => $this->_table,

            //     'name' => 'order_message',

            //     'label' => 'order Message',

            //     'type' => 'textarea',

            //     'default' => '',

            //     'attributes' => array(),

            //     'rules' => 'trim'

            // ),
            // 'order_coupon_discount' => array(
            //      'table'   => $this->_table,
            //      'name'   => 'order_coupon_discount',
            //      'label'   => 'Coupon Discount',
            //      'type'   => 'text',
            //      'attributes'   => array(),
            //      'js_rules'   => '',
            //      'rules'   => 'trim'
            //   ),
              
            //   'order_coupon_id' => array(
            //      'table'   => $this->_table,
            //      'name'   => 'order_coupon_id',
            //      'label'   => 'Coupon ID',
            //      'type'   => 'hidden',
            //      'attributes'   => array(),
            //      'js_rules'   => '',
            //      'rules'   => 'trim'
            //   ),
              'order_tracking_number' => array(
                 'table'   => $this->_table,
                 'name'   => 'order_tracking_number',
                 'label'   => 'Tracking Number',
                 'type'   => 'hidden',
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'trim'
              ),


            'order_business_feature' => array(
                'table'   => $this->_table,
                'name'   => 'order_business_feature',
                'label'   => 'Business Feature',
                'type'   => 'hidden',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim'
              ),

              


            /*'order_special_shipment' => array(

                'table' => $this->_table,

                'name' => 'order_special_shipment',

                'label' => 'Special Shipment',

                'type' => 'hidden',

                'attributes' => array(),

                'js_rules' => '',

                'rules' => ''

            ),*/

            /*'order_shipping_firstname' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_firstname',

                'label' => 'Firstname',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'required|trim'

            ),


            'order_shipping_lastname' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_lastname',

                'label' => 'Lastname',

                'type' => 'text',

                'default' => '',

                'attributes' => array(),

                'rules' => 'required|trim'

            ),


            'order_shipping_email' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_email',

                'label' => 'Email',

                'type' => 'text',

                'attributes' => array(),

                'js_rules' => 'required',
                'type_filter_dt' => 'text',

                'rules' => 'required|valid_email|strtolower|trim|htmlentities'

            ),


            'order_shipping_phone' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_phone',

                'label' => 'Phone',

                'type' => 'text',

                'attributes' => array(),

                'rules' => 'required|trim|regex_match[/^[\d\(\)\-+ ]+$/]'

            ),


            'order_shipping_address1' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_address1',

                'label' => 'Address',

                'type' => 'text',

                'attributes' => array(),

                'rules' => 'required|trim|htmlentities'

            ),


            'order_shipping_address2' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_address2',

                'label' => 'Address2',

                'type' => 'textarea',

                'attributes' => array(),

                'rules' => 'trim|htmlentities'

            ),


            'order_shipping_city' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_city',

                'label' => 'City',

                'type' => 'textarea',

                'attributes' => array(),

                'rules' => 'required|trim'

            ),


            'order_shipping_country' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_country',

                'label' => 'Country',

                'type' => 'text',

                'attributes' => array(),

                'rules' => 'required|trim'

            ),


            'order_shipping_state' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_state',

                'label' => 'State',

                'type' => 'textarea',

                'attributes' => array(),

                'rules' => 'required|trim'

            ),


            'order_shipping_zip' => array(

                'table' => $this->_table,

                'name' => 'order_shipping_zip',

                'label' => 'Zip Code',

                'type' => 'text',

                'attributes' => array(),

                'rules' => 'required|trim'

            ),*/
             'order_dispatch_status' => array(
                'table' => $this->_table,
                'name' => 'order_dispatch_status',
                'label' => 'Is Dispatched?',
                'type' => 'switch',
                'type_dt' => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "order_dispatch_status" ,
                'list_data'=> array() ,                
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),

            'order_status' => array(

                'table' => $this->_table,

                'name' => 'order_status',

                'label' => 'Status?',

                'type' => 'switch',

                'default' => '1',

                'attributes' => array(),

                'rules' => 'trim'

            ),


        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>