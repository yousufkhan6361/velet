<?
class Model_product_kit extends MY_Model {
    /**
     * TKD warehouse_distributor MODEL
     *
     * @package     product_distributor Model
     * 
     * @version     2.0
     * @since       2014 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'product_kit';
    protected $_field_prefix    = 'pk_';
    protected $_pk    = '';
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        /*$this->pagination_params['fields'] = "*";
        $this->pagination_params['joins'][] = array(
                                                    "table"=>"kit" ,
                                                    "joint"=>"kit_id = pk_kit_id",
                                                );*/
        parent::__construct();

    }

    public function find_by_id($product_id=0)
    {
        // Set params
        //$params['fields'] = "wd_distributor_id";
        $params['where']['pk_product_id'] = $product_id;
        $params['joins'][] = array(
            "table"=>"kit" ,
            "joint"=>"kit.kit_id = product_kit.pk_kit_id",
        );
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

    // Get warehouse IDs
    public function get_distributor_ids($warehouse_id)
    {
        // Set params
        $params['fields'] = "wd_distributor_id";
        $params['where_in']['wd_warehouse_id'] = $warehouse_id;
        $params['group'] = 'wd_distributor_id';
        $result = $this->find_all($params);

        return $result;
    }

    // Get warehouse IDs
    public function get_warehouse_by_distributor($distributor_id)
    {
        // Set params
        $params['fields'] = "wd_warehouse_id,wd_distributor_id";
        $params['where']['wd_distributor_id'] = $distributor_id;
        //$params['group'] = 'wd_distributor_id,wd_warehouse_id';
        $result = $this->find_all($params);

        return $result;
    }

    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'pk_product_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'pk_product_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              
              'pk_kit_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'pk_kit_id',
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