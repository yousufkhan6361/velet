<?

class Model_coupon extends MY_Model {

    /**

     * TKD coupon MODEL

     *

     * @package     coupon Model

     * @author      Waqas Ahmed (waqasahmed.it@gmail.com)

     * @version     2.0

     * @since       2016 / Amazingly corrupt models Corporation Inc.

     */



    protected $_table    = 'coupon';

    protected $_field_prefix    = 'coupon_';

    protected $_pk    = 'coupon_id';

    protected $_status_field    = 'coupon_status';

    public $relations = array();

    public $pagination_params = array();

    public $dt_params = array();

    public $_per_page    = 20;

    

    function __construct()

    {

        // Call the Model constructor

        //$this->pagination_params['fields'] = "coupon_id,coupon_code, CASE WHEN coupon_type = 1 THEN CONCAT(coupon_rate , '%') else CONCAT('$', coupon_rate) END as coupon_rate,coupon_start_date,coupon_expire_date,coupon_status";

        $this->pagination_params['fields'] = "coupon_id,coupon_comments,coupon_rate,coupon_code,coupon_status";







        // $this->relations['coupon_product_category'] = array(

        //                                           "type"=>"has_many", 

        //                                           "own_key"=>"pc_coupon_id", 

        //                                           "other_key"=>"pc_product_category_id",

        //                                         );



        // $this->relations['coupon_product'] = array(

        //                                           "type"=>"has_many", 

        //                                           "own_key"=>"pc_coupon_id", 

        //                                           "other_key"=>"pc_product_id",

        //                                         );





        // debug($this->relations['coupon_product'],1 );



        parent::__construct();



    }



    public function calculate_discounted_amount($coupon_id , $amount)

    {

        $data = $this->find_by_pk($coupon_id);

        if(array_filled($data))

            return $this->_set_discount_amount($data['coupon_rate'] , $data['coupon_type'] , $amount);

        else

            return 0;

    }





    public function get_coupon_apply_on($type)

    {

        return $this->_list_data['coupon_apply_on'][$type];

    }

    

        public function get_coupon_type($type)

    {

        return $this->_list_data['coupon_type'][$type];

    }

    public function get_discount_type($rate , $type)

    {

        switch ($type) {

            case 1:

                return $rate.'%';

                break;

            

            default:

                return $rate;

                break;

        }

    }



    private function _set_discount_amount($rate , $type , $amount)

    {

        /*switch ($type) {

            case 1: // in % discount

                return round(($amount*$rate)/100 , 2);

                break;

            

            default: // in amount discount

                return ($amount >= $rate) ? $rate : $amount;

                break;

        }*/



        return ($amount >= $rate) ? $rate : $amount;

    }



    public function _set_audience()

    {

        return array(

            'all'=>'All',

            'client'=>'Normal User',

            'merchant'=>'Merchant user',

            'non_registered'=>'Non Registered Member',

            );

    }



   

    public function get_coupon_exist($coupon)

    {

        $param = array();

        $param['where']['coupon_code'] = $coupon;

        return $this->find_one_active($param);

    }







    /*

    * table             Table Name

    * Name              FIeld Name

    * label             Field Label / Textual Representation in form and DT headings

    * type              Field type : hidden, text, textarea, editor, etc etc. 

    *                                 Implementation in form_generator.php

    * type_dt           Type used by prepare_datatables method in controller to prepare DT value

    *                                 If left blank, prepare_datatable Will opt to use 'type'

    * type_filter_dt    Used by DT FILTER PREPRATION IN datatables.php

    * attributes        HTML Field Attributes

    * js_rules          Rules to be aplied in JS (form validation)

    * rules             Server side Validation. Supports CI Native rules



    * list_data         For dropdown etc, data in key-value pair that will populate dropdown 

    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php

    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it

    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key

    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php

    */

    public function get_fields( $specific_field = "" )

    {



        $fields = array(

        

              'coupon_id' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_id',

                     'label'   => 'id #',

                     'type'   => 'hidden',

                     'type_dt'   => 'text',

                     'attributes'   => array(),

                     'dt_attributes'   => array("width"=>"5%"),

                     'js_rules'   => '',

                     'rules'   => 'trim'

                ),

              'coupon_comments' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_comments',

                     'label'   => 'Coupon Title',

                     'type'   => 'text',

                     'attributes'   => array(),

                     'js_rules'   => 'required',

                     'rules'   => 'required|trim|htmlentities'

                  ),





              // 'coupon_apply_on' => array(

              //        'table'   => $this->_table,

              //        'name'   => 'coupon_apply_on',

              //        'label'   => 'Coupon Apply',

              //        'type'   => 'dropdown',

              //        'attributes'   => array(),

              //        'js_rules'   => 'required',

              //        'list_data'    => $this->_list_data['coupon_apply_on'] ,

              //        'rules'   => 'required|trim|htmlentities'

              //     ),



              // 'coupon_product_category' => array(

              //                    'table'   => "coupon_product_category",

              //                    'name'   => 'pc_product_category_id',

              //                    'label'   => 'Product Category',

              //                    'type'   => 'multiselect',

              //                    'attributes'   => array(),

              //                    'js_rules'   => '',

              //                    'rules'   => '',

              //                 ),



              // 'coupon_product' => array(

              //                    'table'   => "coupon_product",

              //                    'name'   => 'pc_product_id',

              //                    'label'   => 'Product',

              //                    'type'   => 'multiselect',

              //                    'attributes'   => array(),

              //                    'js_rules'   => '',

              //                    'rules'   => '',

              //                 ),

            'coupon_code' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_code',

                     'label'   => 'Coupon Code',

                     'type'   => 'text',

                     'attributes'   => array(

                        'class'=>'is_copoun',

                        'additional' => 'data-url='. la('coupon/genrate_code')

                        ),

                     'js_rules'   => 'required',

                     'rules'   => 'required|trim|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'code]'

                  ),

              

              'coupon_type' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_type',

                     'label'   => 'Type',

                     'type'   => 'hidden',

                     'attributes'   => array(),

                     'js_rules'   => 'required',

                     'list_data'    => $this->_list_data['coupon_type'] ,

                     'rules'   => 'trim|htmlentities'

                  ),



              'coupon_rate' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_rate',

                     'label'   => 'Discount (Percentage)',

                     'type'   => 'text',

                     'attributes'   => array(),

                     'js_rules'   => 'required',

                     'rules'   => 'required|trim|htmlentities'

                  ),







              'coupon_start_date' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_start_date',

                     'label'   => 'Start Date',

                     'type'   => 'hidden',

                     'attributes'   => array(),

                     'js_rules'   => 'required',

                     'rules'   => 'trim|htmlentities'

                  ),



              'coupon_expire_date' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_expire_date',

                     'label'   => 'Expire Date',

                     'type'   => 'hidden',

                     'attributes'   => array(),

                     'js_rules'   => 'required',

                     'rules'   => 'trim|htmlentities'

                  ),





              'coupon_status' => array(

                     'table'   => $this->_table,

                     'name'   => 'coupon_status',

                     'label'   => 'Status?',

                     'type'   => 'switch',

                     'type_dt'   => 'dropdown',

                     'type_filter_dt' => 'dropdown',

                     'list_data_key' => "coupon_status" ,

                     'list_data' => array(),

                     'default'   => '1',

                     'attributes'   => array(),

                     'dt_attributes'   => array("width"=>"7%"),

                     'rules'   => 'trim'

                  ),



              

            );

        

        if($specific_field)

            return $fields[ $specific_field ];

        else

            return $fields;

    }



}

?>