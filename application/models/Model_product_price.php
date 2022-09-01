<?
class Model_product_price extends MY_Model {
    /**
     * TKD warehouse_distributor MODEL
     *
     * @package     product_distributor Model
     *
     * @version     2.0
     * @since       2014 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'product_price';
    protected $_field_prefix    = 'pp_';
    protected $_pk    = '';
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;

    function __construct()
    {
        // Call the Model constructor
        /*$this->pagination_params['fields'] = "*";
        $this->pagination_params['joins'][] = array(
            "table"=>"product_prep" ,
            "joint"=>"product_prep.pp_prep_id = pp_prep_id",
        );*/
        parent::__construct();

    }

    // Get prices
    public function get_prices($product_id = 0)
    {
        $params['where']['pp_product_id'] = $product_id;
        $params['joins'][] = array(
            "table"=>"pricing" ,
            "joint"=>"pricing.pricing_id = product_price.pp_price_id",
        );

        $result = $this->find_all($params);
        return $result;
    }


    public function find_by_id($product_id=0)
    {
        // Set params
        //$params['fields'] = "wd_distributor_id";
        $params['where']['pp_product_id'] = $product_id;
        /*$params['joins'][] = array(
            "table"=>"prep_size" ,
            "joint"=>"prep_size.prep_size_id = product_price.pp_prep_id",
        );*/
        $result = $this->find_all($params);

        return $result;
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

    * list_data         For drowdown etc, data in key-value pair that will populate drowdown
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it
    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    */

    public function get_fields( $specific_field = "" )
    {

        $fields = array(

            'pp_product_id' => array(
                'table'   => $this->_table,
                'name'   => 'pp_product_id',
                'label'   => 'id #',
                'type'   => 'hidden',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"5%"),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),


            'pp_price_id' => array(
                'table'   => $this->_table,
                'name'   => 'pp_price_id',
                'label'   => 'id #',
                'type'   => 'hidden',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"5%"),
                'js_rules'   => '',
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