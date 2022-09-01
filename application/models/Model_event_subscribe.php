<?
class Model_event_subscribe extends MY_Model {
  
    /**
     * Model_event_subscribe MODEL
     *
     * @package     Model_event_subscribe Model
     * 
     * @version     1.0
     * @since       2017 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'event_subscribe';
    protected $_field_prefix    = 'event_subscribe_';
    protected $_pk    = 'event_subscribe_id';
    protected $_status_field    = 'event_subscribe_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "
        event_subscribe_id,
        event_subscribe_email,
        event_subscribe_createdon,
        event_subscribe_status";
        parent::__construct();
    }

    public function get_records()
    {
        $params['fields'] = "MONTH(event_subscribe_createdon) as month , COUNT(event_subscribe_createdon) as count";
        $params['where_string'] = "event_subscribe_createdon >= NOW() - INTERVAL 1 YEAR AND YEAR(event_subscribe_createdon) = YEAR(CURRENT_DATE())";
        $params['group'] = "MONTH(event_subscribe_createdon)";

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
        
              'event_subscribe_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'event_subscribe_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'event_subscribe_email' => array(
                     'table'   => $this->_table,
                     'name'   => 'event_subscribe_email',
                     'label'   => 'Email',
                     'type'   => 'text',
                     'attributes'   => array(),
                    'dt_attributes'   => array("width"=>"35%"),
                     'js_rules'   => '',
                     'rules' => 'required|valid_email|strtolower|trim|htmlentities|is_unique[' . $this->_table . '.' . $this->_field_prefix . 'email]'
                  ),


            'event_subscribe_interest' => array(
                'table'   => $this->_table,
                'name'   => 'event_subscribe_interest',
                'label'   => 'Interest',
                'type'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"35%"),
                'js_rules'   => '',
                'rules' => 'required'
            ),

              'event_subscribe_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'event_subscribe_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                     'list_data' => array( 
                                        0 => "<span class=\"label label-danger\">Unread</span>" ,
                                        1 =>  "<span class=\"label label-primary\">Read</span>"
                                    ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),

            'event_subscribe_createdon' => array(
                'table'   => $this->_table,
                'name'   => 'event_subscribe_createdon',
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