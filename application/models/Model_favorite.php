<?
class Model_favorite extends MY_Model {
  
    /**
     * Model_favorite MODEL
     *
     * @package     Model_favorite Model
     * 
     * @version     1.0
     * @since       2017 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'favorite';
    protected $_field_prefix    = 'favorite_';
    protected $_pk    = 'favorite_id';
    protected $_status_field    = 'favorite_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "
        favorite_id,
        favorite_status";
        parent::__construct();
    }

    public function get_records()
    {
        $params['fields'] = "MONTH(favorite_createdon) as month , COUNT(favorite_createdon) as count";
        $params['where_string'] = "favorite_createdon >= NOW() - INTERVAL 1 YEAR AND YEAR(favorite_createdon) = YEAR(CURRENT_DATE())";
        $params['group'] = "MONTH(favorite_createdon)";

        $result = $this->find_all($params);
        return $result;
    }

    public function favorite_status($cat_id=0, $like_product_id=0,$user_id=0)
    {
        //$params['where']['favorite_cat_id'] = $cat_id;
        $params['where']['favorite_product_id'] = $like_product_id;
        $params['where']['favorite_user_id'] = $user_id;

        $result = $this->find_one_active($params);

        return $result;
    }

    public function get_my_fav($user_id=0)
    {
        $params['order'] = "favorite_id DESC";
        $params['where']['favorite_user_id'] = $user_id;

        $params['joins'][] = array(
            "table"=>"product" ,
            "joint"=>"product.product_id = favorite.favorite_product_id",
        );

        $result = $this->find_all_active($params);

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
        
              'favorite_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'favorite_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              /*'favorite_cat_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'favorite_cat_id',
                     'label'   => 'ID',
                     'type'   => 'text',
                     'attributes'   => array(),
                    'dt_attributes'   => array("width"=>"35%"),
                     'js_rules'   => '',
                     'rules' => 'required|strtolower|trim|htmlentities'
                  ),*/
              'favorite_product_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'favorite_product_id',
                     'label'   => 'Fav ID',
                     'type'   => 'text',
                     'attributes'   => array(),
                    'dt_attributes'   => array("width"=>"35%"),
                     'js_rules'   => '',
                     'rules' => 'required|strtolower|trim|htmlentities'
                  ),
              'favorite_user_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'favorite_user_id',
                     'label'   => 'User ID',
                     'type'   => 'text',
                     'attributes'   => array(),
                    'dt_attributes'   => array("width"=>"35%"),
                     'js_rules'   => '',
                     'rules' => 'strtolower|trim|htmlentities'
                  ),

              'favorite_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'favorite_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                     'list_data' => array( 
                                        0 => "<span class=\"label label-default\">Inactive</span>" ,
                                        1 =>  "<span class=\"label label-primary\">Active</span>"
                                    ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),

            'favorite_createdon' => array(
                'table'   => $this->_table,
                'name'   => 'favorite_createdon',
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