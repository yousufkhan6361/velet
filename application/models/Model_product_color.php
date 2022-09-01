<?
class Model_product_color extends MY_Model {
  
    /**
     * Model_signup_category MODEL
     *
     * @package     Model_signup_category Model
     * @version     1.0
     * @since       2018
     */

    protected $_table    = 'product_color';
    protected $_field_prefix    = 'mba_';
    protected $_pk    = '';
    protected $_status_field    = '';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        //$this->pagination_params['fields'] = "pp_user_id,pp_page_id";

        /*$this->pagination_params['fields'] = "*";
        $this->pagination_params['joins'][] = array(
                                                    "table"=>"category" ,
                                                    "joint"=>"category_id = mba_category_id",
                                                );*/

        $this->pagination_params['fields'] = "*";
        $this->pagination_params['joins'][] = array(
            "table"=>"color" ,
            "joint"=>"color_id = ohb_color_id",
        );

        parent::__construct();
    }

    // Get User data
    public function find_all_product_color($product_id = 0)
    {
        // Set params
        $params['fields'] = "color_id, color_name";
        // JOIN
        $params['joins'][] = array(
            "table"=>"color" ,
            "joint"=>"color.color_id = product_color.mba_color_id",
        );
        $params['where']['mba_product_id'] = $product_id;
        $result = $this->find_all($params);

        return $result;
    }

    // Get User data (use for listing only)
    public function get_category_list($userid = 0)
    {
        // Set params
        $params['fields'] = "mba_item_id";
        // JOIN
        $params['joins'][] = array(
            "table"=>"item_category" ,
            "joint"=>"signup_category.mba_signup_category_id = item_category.mba_category_id",
        );
        $params['where']['mba_signup_id'] = $userid;
        $result = $this->find_all($params);

        return $result;
    }



    /*
    * table       Table Name
    * Name        FIeld Name
    * label       Field Label / Textual Representation in form and DT headings
    * type        Field type : hidden, text, textarea, editor, etc etc. 
    *                           Implementation in form_generator.php
    * type_dt     Type used by prepare_datatables method in controller to prepare DT value
    *                           If left blank, prepare_datatable Will opt to use 'type'
    * attributes  HTML Field Attributes
    * js_rules    Rules to be aplied in JS (form validation)
    * rules       Server side Validation. Supports CI Native rules
    */
    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'mba_color_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'mba_color_id',
                     'label'   => 'Color ID #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),


              'mba_product_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'mba_product_id',
                     'label'   => 'Product ID',
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