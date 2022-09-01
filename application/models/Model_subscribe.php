<?
class Model_subscribe extends MY_Model {
  
    /**
     * Model_subscribe MODEL
     *
     * @package     Model_subscribe Model
     * 
     * @version     1.0
     * @since       2017 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'subscribe';
    protected $_field_prefix    = 'subscribe_';
    protected $_pk    = 'subscribe_id';
    protected $_status_field    = 'subscribe_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "
        subscribe_id,
        subscribe_email,
        subscribe_createdon,
        subscribe_status";
        parent::__construct();
    }

    public function get_records()
    {
        $params['fields'] = "MONTH(subscribe_createdon) as month , COUNT(subscribe_createdon) as count";
        $params['where_string'] = "subscribe_createdon >= NOW() - INTERVAL 1 YEAR AND YEAR(subscribe_createdon) = YEAR(CURRENT_DATE())";
        $params['group'] = "MONTH(subscribe_createdon)";

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
        
              'subscribe_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscribe_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'subscribe_email' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscribe_email',
                     'label'   => 'Email',
                     'type'   => 'text',
                     'attributes'   => array(),
                    'dt_attributes'   => array("width"=>"35%"),
                     'js_rules'   => '',
                     'rules' => 'required|valid_email|strtolower|trim|htmlentities|is_unique[' . $this->_table . '.' . $this->_field_prefix . 'email]'
                  ),

              'subscribe_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'subscribe_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                  'list_data' => array(
                      0 => "<span class='label label-danger'>Inactive</span>" ,
                      1 =>  "<span class='label label-primary'>Active</span>"
                  ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),

            'subscribe_createdon' => array(
                'table'   => $this->_table,
                'name'   => 'subscribe_createdon',
                'label'   => 'Created',
                'type'   => 'none',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"10%"),
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