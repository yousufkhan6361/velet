<?
class Model_stock_email extends MY_Model {
  
    /**
     * TKD stock_email MODEL
     *
     * @package     stock_email Model
     * 
     * @version     2.0
     * @since       2014 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'stock_email';
    protected $_field_prefix    = 'stock_email_';
    protected $_pk    = 'stock_email_id';
    protected $_status_field    = 'stock_email_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "stock_email_id,stock_email_email,stock_email_createdon,stock_email_status";
        parent::__construct();
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
        
              'stock_email_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'stock_email_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              
              'stock_email_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'stock_email_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => ''
                  ),

              'stock_email_email' => array(
                     'table'   => $this->_table,
                     'name'   => 'stock_email_email',
                     'label'   => 'Email',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                  'dt_attributes'   => array("width"=>"30%"),
                     'rules'   => 'required|valid_email|trim|is_unique['.$this->_table.'.'.$this->_field_prefix.'email]'
                  ),

              'stock_email_createdon' => array(
                     'table'   => $this->_table,
                     'name'   => 'stock_email_createdon',
                     'label'   => 'Created',
                     'type'   => 'none',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),
              
              
              'stock_email_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'stock_email_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                    'list_data' => array( 
                                        0 => "<span class=\"label label-primary\">Read</span>" ,
                                        1 =>  "<span class=\"label label-danger\">Unread</span>"
                                    ) ,
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