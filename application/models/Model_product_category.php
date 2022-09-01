<?
class Model_product_category extends MY_Model {
    /**
     * Model_product_category MODEL
     *
     * @since       03-Jan-2018
     */

    protected $_table    = 'product_category';
    protected $_field_prefix    = 'product_category_';
    protected $_pk    = 'product_category_id';
    protected $_status_field    = 'product_category_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "product_category_id,product_category_name,product_category_status";
        
        parent::__construct();

    }

    // Get latest categories
    public function get_recent_categories($limit=5)
    {
        // Set params
        $params['fields'] = "product_category_id,product_category_name,product_category_slug";

        $params['order'] = 'product_category_id DESC';
        $params['limit'] = $limit;
        // Query
        $result = $this->find_all_active($params);

        // Return result
        return $result;
    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        // Set params
        $param['fields'] = "product_category_id,product_category_slug,product_category_name";
        $param['where']['product_category_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }

    // Get total post active
    public function get_total_count($product_cat_id)
    {
        // Set params
        $params['where']['product_category_id'] = $product_cat_id;

        return $this->model_product->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $product_cat_id)
    {
        $prefix = $this->db->dbprefix;
        // Set params
        $param['fields'] = "product_id,product_name,product_slug,product_image, product_image_thumb,,product_image_path,product_description,product_image,product_image_thumb,product_image_path,product_createdon,
        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = product_id and comment_status=1) AS total_comments, product_category_name";
        // LEFT JOIN
        $param['joins'][] = array(
            "table"=>"product_category" ,
            "joint"=>"product_category.product_category_id = product.product_category_id and product_category.product_category_status =1",
            "type"=>"left"
        );
        $param['where']['product.product_category_id'] = $product_cat_id;
        $param['order'] = 'product_id DESC';
        $param['limit'] = $limit;
        $param['offset'] = $offset;
        // Query data
        $data = $this->model_product->find_all_active($param);

        // Return result
        return $data;
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

        $fields = array(
        
              'product_category_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'product_category_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'product_category_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'product_category_name',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'product_category_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'product_category_slug',
                  'label'   => 'Title',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),

              'product_category_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'product_category_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "product_category_status" ,
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