<?
class Model_wishlist extends MY_Model {
	/**
     * User address MODEL
     *
     * @package     User address Model
     * 
     * @version     2.0
     * @since       2014 
     */
	 
    protected $_table    = 'wishlist';
    protected $_field_prefix    = 'wishlist_';
    protected $_pk    = 'wishlist_id';
    protected $_status_field    = 'wishlist_status';

    public $pagination_params = array();
    public $_per_page    = 20;

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function add_to_wishlist($product_id)
    {
        // Call the Model constructor
        $rec = array();
        $rec['wishlist_user_id'] = $this->userid ;
        $rec['wishlist_product_id'] = $product_id;
        // $rec['wishlist_user_ip'] = $ip_address;
        return $this->insert_if_not_found($rec);
    }

    public function remove_to_wishlist( $product_id )
    {
        // Call the Model constructor
        $rec = array();
        $rec['wishlist_user_id'] = $this->userid;
        $rec['wishlist_product_id'] = $product_id ;
        return $this->delete_record($rec);
    }

    public function get_fields()
    {
        return array(

            'wishlist_id'  => array(
                'table'   => $this->_table,
                'name'   => 'wishlist_id',
                'label'   => 'id',
                'primary'   => 'primary',
                'type'   => 'hidden',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),

            'wishlist_user_id' => array(
                 'table'   => $this->_table,
                 'name'   => 'wishlist_user_id',
                 'label'   => 'User id #',
                 'type'   => 'hidden',
                 'type_dt'   => 'text',
                 'attributes'   => array(),
                 'dt_attributes'   => array("width"=>"5%"),
                 'js_rules'   => '',
                 'rules'   => 'trim'
           ),

            'wishlist_product_id' => array(
                 'table'   => $this->_table,
                 'name'   => 'wishlist_product_id',
                 'label'   => 'Product id #',
                 'type'   => 'hidden',
                 'type_dt'   => 'text',
                 'attributes'   => array(),
                 'dt_attributes'   => array("width"=>"5%"),
                 'js_rules'   => '',
                 'rules'   => 'trim'
           ),

            'wishlist_status' => array(
				 'table'   => $this->_table,
				 'name'   => 'wishlist_status',
				 'label'   => 'Status?',
				 'type'   => 'switch',
				 'type_dt'   => 'dropdown',
				 'type_filter_dt'   => 'dropdown',
				 'list_data' => array( 
									STATUS_INACTIVE => "InActive" ,  
									STATUS_ACTIVE =>  "Active"  
								) ,
				 'default'   => '1',
				 'attributes'   => array(),
				 'dt_attributes'   => array("width"=>"7%"),
				 'rules'   => 'trim'
			  )
        );
    }
}
?>