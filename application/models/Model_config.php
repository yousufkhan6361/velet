<?
class Model_config extends MY_Model {
    /**
     * TKD config MODEL
     *
     * @package     config Model
     * 
     * @version     2.0
     * @since       2014 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'config';
    protected $_field_prefix    = 'config_';
    protected $_pk    = 'config_id';
    // Must define to fetch only Active Records
    protected $_status_field    = 'config_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "config_id,config_variable,config_value,config_status";
        $this->relations['config_category'] = array(
                                                    "type"=>"has_many", 
                                                    "own_key"=>"bc_config_id", 
                                                    "other_key"=>"bc_category_id",
                                                );
        parent::__construct();
    }

    // Load All DB Config Parameters to $config['dynamics']
    public function load_config($is_admin=false)
    {
        $params = array();
        // define columns to fetch records
        return $this->find_all_grouping(array(), "config_type", "config_variable", "config_value","config_status");
    }

    public function get_admin_config()
    {
        $params['where']['config_type'] = CONFIG_ADMIN ;
        $params['where']['config_status'] = 1 ;
        $configuration = $this->model_config->find_all($params);
        return $configuration;
    }

    public function update_config($config_data=array())
    {
        $updated = 0 ;
        $pk = $this->get_pk();
        foreach ($config_data as $config_id => $config_val) {
            $params = array();
            $record = array();
            $params['where'][$pk] = $config_id ;
            $record['config_value'] = $config_val;
            $updated += $this->update_model($params,$record);
        }
        return $updated;
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
        
              'config_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'config_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'config_variable' => array(
                     'table'   => $this->_table,
                     'name'   => 'config_variable',
                     'label'   => 'Variable',
                     'type'   => 'label',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              
              'config_value' => array(
                     'table'   => $this->_table,
                     'name'   => 'config_value',
                     'label'   => 'Value',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              
              'config_type' => array(
                     'table'   => $this->_table,
                     'name'   => 'config_type',
                     'label'   => 'Type?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                     'list_data' => array( 
                                        1 => "<span class=\"label label-default\">Admin</span>" ,  
                                        2 =>  "<span class=\"label label-primary\">System</span>"  
                                    ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),
            'config_status' => array(
                'table'   => $this->_table,
                'name'   => 'config_status',
                'label'   => 'Status?',
                'type'   => 'switch',
                'type_dt'   => 'dropdown',
                'type_filter_dt'   => 'dropdown',
                'list_data' => array(
                    STATUS_INACTIVE => "<span class=\"label label-default\">InActive</span>" ,
                    STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>",
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