<?
class Model_channel_user extends MY_Model {
    /**
     * channel_user MODEL
     *
     * @package     channel Model
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'channel_user';
    protected $_field_prefix    = 'chann_usr_';
    protected $_pk    = 'chann_usr_id';
    protected $_status_field    = 'chann_usr_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "chann_usr_id,chann_usr_type,chann_usr_status";
        
        parent::__construct();

    }

    public function get_channels()
    {
       return $this->model_channel_user->find_all_active();
    }

    public function get_user_channel($user_id = 0)
    {
        // Set default result variable;
        $params['where']['chann_usr_user_id'] = $user_id;
        $result = $this->find_all_active();

        if(array_filled($result)){
            foreach($result as $key=>$value):
                $data[$value['chann_usr_type']][] = $value;
            endforeach;
        }
        else{
            $data = array();
        }
        // Return record
        return $data;
    }

    // Get channel users ID
    public function get_chanel_ids($user_id = 0, $type)
    {
        // Set params
        $params['fields'] = "chann_usr_id";
        $params['where']['chann_usr_user_id'] = $user_id;
        $params['where']['chann_usr_type'] = $type;
        // Result
        $query = $this->find_all_active($params);
        if(array_filled($query)){
            // Extract ID's
            $data = array_column($query,'chann_usr_id');
        }
        else{
            $data = array();
        }
        // Return
        return $data;
    }

    // Get user channel by Type
    // '1'=>'Shopify',
    // '2'=>'Ebay',
    // '3'=>'Wish',
    // '4'=>'Woocommerce',
    public function get_user_channel_list($user_id = 0, $type)
    {
        // Set params
        $params['fields'] = "chann_usr_id,chann_usr_type,chann_usr_store,chann_usr_store_access_token";
        $params['where']['chann_usr_user_id'] = $user_id;
        $params['where']['chann_usr_type'] = $type;
        // Result
        $query = $this->find_all_active($params);
        if(array_filled($query)){
            $data = $query;
        }
        else{
            $data = array();
        }
        // Return
        return $data;
    }

    public function is_exist($chann_usr_type, $chann_usr_store)
    {
        // Set default result variable;
        $params['where']['chann_usr_type'] = $chann_usr_type;
        $params['where']['chann_usr_store'] = $chann_usr_store;
        $result = $this->find_one_active($params);

        // Record found
        if(array_filled($result)){
            return true;
        }
        else{
            return false;
        }
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
        
              'chann_usr_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

            'chann_usr_user_id' => array(
                'table'   => $this->_table,
                'name'   => 'chann_usr_user_id',
                'label'   => 'User ID',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim|htmlentities'
            ),

            'chann_usr_type' => array(
                'table'   => $this->_table,
                'name'   => 'chann_usr_type',
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

              'chann_usr_nickname' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_nickname',
                     'label'   => 'Nickname',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              'chann_usr_store' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_store',
                     'label'   => 'Store',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
              'chann_usr_country' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_country',
                     'label'   => 'Country',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
              'chann_usr_store_redirect_response' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_store_redirect_response',
                     'label'   => 'Store redirect response',
                     'type'   => 'hidden',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
              'chann_usr_store_access_token_response' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_store_access_token_response',
                     'label'   => 'Access Token Response',
                     'type'   => 'hidden',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
              'chann_usr_store_access_token' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_store_access_token',
                     'label'   => 'Access Token',
                     'type'   => 'hidden',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
              'chann_usr_store_refresh_token' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_store_refresh_token',
                     'label'   => 'Refresh Token',
                     'type'   => 'hidden',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
              'chann_usr_store_token_expire' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_store_token_expire',
                     'label'   => 'Token Expire',
                     'type'   => 'hidden',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim|htmlentities'
                  ),
             
              'chann_usr_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'chann_usr_status',
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