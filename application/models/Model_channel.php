<?
class Model_channel extends MY_Model {
    /**
     * channel MODEL
     *
     * @package     channel Model
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'channel';
    protected $_field_prefix    = 'channel_';
    protected $_pk    = 'channel_id';
    protected $_status_field    = 'channel_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "channel_id,channel_type,channel_status";
        
        parent::__construct();

    }

    public function find_by_type($type=0)
    {
        $params['where']['channel_type'] = $type;
       return $this->find_one_active($params);
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
        
              'channel_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'channel_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

            'channel_type' => array(
                'table'   => $this->_table,
                'name'   => 'channel_type',
                'label'   => 'Type',
                'type'   => 'dropdown',
                'attributes'   => array(),
                'list_data'=>array(
                    '1'=>'Shopify',
                    '2'=>'Ebay',
                    '3'=>'Wish',
                    '4'=>'Woocommerce',
                ),
                'js_rules'   => 'required',
                'rules'   => 'required|trim|htmlentities'
            ),

              'channel_client_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'channel_client_id',
                     'label'   => 'Client ID',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              'channel_secret' => array(
                     'table'   => $this->_table,
                     'name'   => 'channel_secret',
                     'label'   => 'Channel Secret',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              'channel_redirect_url' => array(
                     'table'   => $this->_table,
                     'name'   => 'channel_redirect_url',
                     'label'   => 'Redirect URL',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
            'channel_extra' => array(
                'table'   => $this->_table,
                'name'   => 'channel_extra',
                'label'   => 'Extra',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim|htmlentities'
            ),
             
              'channel_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'channel_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "channel_status" ,
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