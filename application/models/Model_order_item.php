<?
class Model_order_item extends MY_Model {
	/**
	 *
	 * @package	 order_item Model
	 *
	 */

	protected $_table	= 'order_item';
	protected $_field_prefix	= 'order_item_';
	protected $_pk	= 'order_item_id';
	protected $_status_field	= '';
	public $pagination_params = array();
	public $relations = array();
	public $dt_params = array();
	public $_per_page	= 20;
	
	function __construct()
	{
		// Call the Model constructor
		$this->pagination_params['fields'] = "order_item_id,order_item_user_id,order_item_total_items,order_item_total,order_item_ostatus_id";
		parent::__construct();
	}

    public function get_user_program($user_id = 0)
    {
        //$order_items = array();
        $data = array();
        // Get order info
        $params['order'] = "order_id DESC";
        $params['where']['order_user_id'] = $user_id;
        $order_result = $this->model_order->find_all_active($params);

        if(array_filled($order_result)){
            foreach ($order_result as $key=>$value):

                $o_item['where']['order_item_order_id'] = $value['order_id'];
                // JOIN
                $o_item['joins'][] = array(
                    "table"=>"product" ,
                    "joint"=>"product.product_id = order_item.order_item_product_id",
                );
                $item_result = $this->find_all($o_item);
                $data[] = array(
                    'order'=>$value,
                    'order_items'=>$item_result,

                );

                $o_item = array();
                // Get Order Items
            endforeach;
        }

        return $data;
	}

    // Get Selected ITEM INFO with order and Product
    public function get_order_info_for_exam($oi_id=0, $user_id=0, $product_id)
    {
        $params['fields'] = "order_item_id";
        $params['where']['order_item_order_id'] = $oi_id;
        $params['where']['order_item_user_id'] = $user_id;
        $params['where']['order_item_product_id'] = $product_id;
        $item_result = $this->find_one($params);

        return $item_result['order_item_id'];

    }

	// Get Selected ITEM INFO with order and Product
    public function get_order_info($oi_id=0, $user_id=0)
    {
        $o_item['fields'] = "order_id,order_user_id,order_item_id,product_id,product_name,order_item_product_id";
        // JOIN
        $o_item['joins'][] = array(
            "table"=>"order" ,
            "joint"=>"order.order_id = order_item.order_item_order_id and order_user_id=$user_id",
        );
        $o_item['joins'][] = array(
            "table"=>"product" ,
            "joint"=>"product.product_id = order_item.order_item_product_id",
        );
        $item_result = $this->find_by_pk($oi_id,false,$o_item);

        return $item_result;

    }

	public function save_order_items( $order_id )
	{
		global $config;
		$CI = & get_instance();

		$order_id = intval( $order_id ) ;
		
		if(!$order_id)
			return false;
		
        $cart_items = $CI->cart->contents();

        foreach ($cart_items as $rowid => $item) {
        	$record = $this->map_record( $order_id , $item ) ;
			$order_item_id = $this->insert_record( $record ) ;
        }

	}

	public function map_record( $order_id , $item=array() , $parent_id = 0 )
	{
		global $config;
    	$record = array() ;
		if( $order_id && array_filled( $item ) )
		{
        	$options = $item[ 'options' ] ;

        	$record[ 'order_item_order_id' ] = intval( $order_id ) ;
        	$record[ 'order_item_game_id' ] = intval( $item[ 'id' ] ) ;
        	$record[ 'order_item_qty' ] = $item[ 'qty' ] ;
        	$record[ 'order_item_price' ] = $item[ 'price' ] ;
        	$record[ 'order_item_total' ] = $item[ 'subtotal' ] ;
		}
		return $record ; 
	}

	// public function get_order_items($order_id='' , $with_addons = false , $params = array() )
	// {
	// 	$params[ 'where' ] = array(
	// 		'order_item_order_id' =>  $order_id ,
	// 	);
	// 	$params[ 'fields' ] = "*" ;
	// 	$params[ 'joins' ] = array(
	// 		array(
	// 			"table" => $this->_table,
	// 			"joint" => "order_item_product_id = game_id",
	// 		),
			 
	// 	);

	// 	$product_list = $this->model_game->find_all($params);

	// 	return ($product_list);	
	// }

	/*
	* table	     Table Name
	* Name		 FIeld Name
	* label	     Field Label / Textual Representation in form and DT headings
	* type		 Field type : hidden, text, textarea, editor, etc etc. 
	*						   Implementation in form_generator.php
	* type_dt	 Type used by prepare_datatables method in controller to prepare DT value
	*						   If left blank, prepare_datatable Will opt to use 'type'
	* attributes HTML Field Attributes
	* js_rules	 Rules to be aplied in JS (form validation)
	* rules	     Server side Validation. Supports CI Native rules
	*/

	public function get_order_items($order_id='' , $with_addons = false , $params = array() )
	{
		
		// debug($params); exit;


		$params[ 'where' ] = array(
			'order_item_order_id' =>  $order_id ,
		);
		$params[ 'fields' ] = "*" ;


		$params[ 'joins' ] = array(
			array(
				"table" => $this->_table,
				"joint" => "order_item_product_id = product_id",
			),
			/*array(
				"table" => 'product_image',
				"joint" => "pi_product_id = product_id and pi_is_featured=1",
			),*/


			 // array( 
    //             "table"=>"product_image" ,
    //             "joint"=>"product_id = pi_product_id AND pi_is_featured = 1" , 
    //             "type"=>"left" ,
    //         ),
		);

		$product_list = $this->model_product->find_all($params);



		return ($product_list);	
	}


	
	public function get_fields( $specific_field = "" )
	{

		$fields = array(
		
			  'order_item_id' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_id',
					 'label'   => 'id #',
					 'type'   => 'hidden',
					 'type_dt'   => 'text',
					 'attributes'   => array(),
					 'dt_attributes'   => array("width"=>"5%"),
					 'js_rules'   => '',
					 'rules'   => 'trim'
				),


			  'order_item_order_id' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_order_id',
					 'label'   => 'order_item_order_id',
					 'type'   => 'dropdown',
					 'type_dt'   => 'text',
					 'type_filter_dt'   => 'dropdown',
					 'rules'   => 'intval|required'
				),

			  'order_item_product_id' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_product_id',
					 'label'   => 'order_item_product_id',
					 'type'   => 'dropdown',
					 'type_dt'   => 'text',
					 'type_filter_dt'   => 'dropdown',
					 'rules'   => 'intval|required'
				),
			  
			  'order_item_qty' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_qty',
					 'label'   => 'order_item_qty',
					 'type'   => 'text',
					 'rules'   => 'intval'
				),

			  'order_item_color' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_color',
					 'label'   => 'order_item_color',
					 'type'   => 'text',
					 'rules'   => 'intval'
				),

			  'order_item_type' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_type',
					 'label'   => 'type',
					 'type'   => 'text',
					 'rules'   => ''
				),
			  
			  'order_item_total' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_total',
					 'label'   => 'order_item_total',
					 'type'   => 'text',
					 'rules'   => 'floatval'
				),


			  'order_item_name' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_name',
					 'label'   => 'order_item_name',
					 'type'   => 'text',
					 'rules'   => ''
				),


			  'order_item_image' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_image',
					 'label'   => 'order_item_image',
					 'type'   => 'text',
					 'rules'   => ''
				),
			  
			  'order_item_price' => array(
					 'table'   => $this->_table,
					 'name'   => 'order_item_price',
					 'label'   => 'order_item_price',
					 'type'   => 'text',
					 'rules'   => 'floatval'
				),
			  
			);

		if($specific_field)
			return $fields[ $specific_field ];
		else
			return $fields;

	}

}
?>