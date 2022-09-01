<?
class Model_agent extends MY_Model {
    /**
     * agent MODEL
     *
     * @package     agent Model
     * @version     1.0
     * @since       2019
     */

    protected $_table    = 'agent';
    protected $_field_prefix    = 'agt_';
    protected $_pk    = 'agt_id';
    protected $_status_field    = 'agt_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "agt_id,agt_status";
        
        parent::__construct();

    }

    public function get_records()
    {
        // Set params
        $params['fields'] = "(select count(agt_id) from ". $this->db->dbprefix . "agent where 1) as user_counts,
        (select count(agt_id) from " . $this->db->dbprefix . "agent where agt_type='desktop') as desk_users,
        (select count(agt_id) from " . $this->db->dbprefix . "agent where agt_type='mobile') as mob_users";

        $result = $this->find_one($params);

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

    * list_data         For dropdown etc, data in key-value pair that will populate dropdown 
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it
    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    */
    public function get_fields( $specific_field = "" )
    {
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(
        
              'agt_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'agt_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'agt_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'agt_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

               'agt_type' => array(
                      'table'   => $this->_table,
                      'name'   => 'agt_type',
                      'label'   => 'Type',
                      'type'   => 'text',
                      'attributes'   => array(),
                      'js_rules'   => '',
                      'rules'   => 'required|trim|htmlentities'
                   ),
             
              'agt_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'agt_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "agt_status" ,
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