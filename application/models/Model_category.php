<?
class Model_category extends MY_Model {
    /**
     * TKD category MODEL
     *
     * @package     category Model
     * 
     * @version     2.0
     * @since       2015 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'category';
    protected $_field_prefix    = 'category_';
    protected $_pk    = 'category_id';
    protected $_status_field    = 'category_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
//        $this->pagination_params['fields'] = "{pre}category.category_id,{pre}category.category_type,{pre}category.category_name,
        $this->pagination_params['fields'] = "category_id,category_name,category_status";
                                                
        /*$this->pagination_params['joins'][] = array(
                                                    "table"=>"category AS parent_cat" , 
                                                    "joint"=>"category.category_parent_id = parent_cat.category_id", 
                                                    "type"=>"left" 
                                                );*/

        
        //$this->pagination_params['where']['category.category_parent_id >'] = 0 ;
        parent::__construct();

    }

    // Get latest categories
    //public function get_recent_categories($limit=5)
    public function get_recent_categories($type)
    {
        switch ($type){
            // Accessories
            case 1:
                $and = " and product_is_accessories=1";
                break;
            case 2:
                $and = " and product_is_merchandise=1";
                break;
            case 3:
                $and = " and product_is_summer=1";
                break;
            case 4:
                $and = " and product_is_winter=1";
                break;
            default:
                $and = "";
        }
        // Set params
        $params['fields'] = "category_id,category_name,category_slug,(select count(*) from sbf_product where product_category_id=category_id and product_status = 1 $and) as cat_count";

        $params['order'] = 'category_name ASC';
        //$params['limit'] = $limit;
        // Query
        $result = $this->find_all_active($params);

        // Return result
        return $result;
    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        // Set params
        $param['fields'] = "category_id,category_slug,category_name,category_detail,category_parent_id";
        $param['where']['category_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }
    // Check slug exists or not
    public function find_by_slug_all($slug)
    {
        // Set params
        $param['where']['category_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }

    // Get total post active
    public function get_total_count($cat_id)
    {
        // Set params
        $params['where']['product_category_id'] = $cat_id;

        return $this->model_product->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $product_cat_id=0)
    {
        $prefix = $this->db->dbprefix;
        // Set params
        /*$param['fields'] = "product_id,product_name,product_slug,product_image, product_image_thumb,,product_image_path,product_description,product_image,product_image_thumb,product_image_path,product_createdon,
        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = product_id and comment_status=1) AS total_comments, product_category_name";*/
        $param['fields'] = "product_id,product_category_id,product_name,product_slug,product_price,product_old_price,product_overview,
        product_image,,product_image_thumb,product_image_path,product_createdon,category_name";
        // LEFT JOIN
        // LEFT JOIN
        $param['joins'][] = array(
            'table' => 'category',
            'joint' => 'category.category_id = product.product_category_id',
            'type' => 'right'
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

    public function get_categories()
    {
        $para['where']['category_id > '] = 2;
        $para['order'] = "category_name ASC";
        $categories = $this->model_category->find_all_list_active($para,"category_name");

        return $categories;
    }

    public function get_menu_categories($id=0)
    {
        $params['fields'] = 'category_id,category_parent_id,category_name,category_image,category_image_thumb,category_image_path,category_slug';
        $params['order'] = 'category_parent_id';
        $data = $this->find_all_active($params);
        
        $result = array();
        foreach ($data as $key => $value) 
        {
            $result[ $value['category_id'] ] = $value;
        }
        foreach ($result as $key => $value) 
        {
            $children[ $value['category_parent_id'] ][$key] = $value;
        }
        $menu_categories = (recursive_array($result , $children));
        return $menu_categories[1] ;
    }

    // Get Parent hirarechy for Categories
    public function get_ancestory($value , $key = "category_id" , $fields = "t.*" )
    {
        $result = array();
        $value = urldecode($value);
        if($key && $value && $this->get_fields($key) )
        {
            $query = "SELECT @pv:=t.category_parent_id as category_parent_id, $fields
                        from  (SELECT * FROM pg_category ORDER BY category_id DESC) t 
                        JOIN
                        (SELECT @pv:= (SELECT category_id FROM pg_category WHERE $key = '$value' ))tmp
                        WHERE t.category_id=@pv AND t.category_id > 1 AND t.category_status = ".STATUS_ACTIVE;
            $result = $this->db->query($query)->result_array();
            return $result;
        }
    }

    // Get All Children Under A Cateogry
    public function get_children_by_parent_id($parent_id )
    {
        $result = array();
        $params['where']['category_parent_id'] = intval($parent_id);
        return $this->find_all_active($params);
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
    * 
    * list_data         For dropdown etc, data in key-value pair that will populate dropdown 
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it
    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    */
    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'category_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'category_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),



               /*'category_type' => array(
                      'table'   => $this->_table,
                      'name'   => 'category_type',
                      'label'   => 'Category Type',
                      'type'   => 'text',
                      'type_dt'   => 'text',
                      'attributes'   => array(),
                      'dt_attributes'   => array("width"=>"5%"),
                      'js_rules'   => '',
                      'rules'   => 'trim'
                 ),*/

            /*'category_type' => array(
                   'table'   => $this->_table,
                   'name'   => 'category_type',
                   'label'   => 'Level',
                   'type'   => 'dropdown',
                   'list_data'    => array("1"=>"Parent","2"=>"Level 1","3"=>"Level 2","4"=>"Level 3") ,
                   'attributes'   => array(),
                   'js_rules'   => 'required',
                   'rules'   => 'required|trim',
                ),

              'category_parent_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'category_parent_id',
                     'label'   => 'Category ID',
                     'type'   => 'dropdown',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'dropdown',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
            ),*/

              'category_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'category_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),             
              
              'category_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'category_slug',
                  'label'   => 'Title',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),
              



              // 'category_shipping'  => array(
              //     'table'   => $this->_table,
              //     'name'   => 'category_shipping',
              //     'label'   => 'Shipping Rates',
              //     'type'   => 'text',
              //     'attributes'   => array(),
              //     'js_rules'   => '',
              //     'rules'   => 'htmlentities'
              // ),



           /* 'category_banner_image' => array(
                'table' => $this->_table,
                'name' => 'category_banner_image',
                'label' => 'Banner Image',
                'name_path' => 'category_image_path',
                'upload_config' => 'site_upload_category',
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'image_size_recommended'=>'1263px × 517px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),*/


            
            'category_image' => array(
                'table' => $this->_table,
                'name' => 'category_image',
                'label' => 'Image',
                'name_path' => 'category_image_path',
                'upload_config' => 'site_upload_category',
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'image_size_recommended'=>'1263px × 517px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),

              
              'category_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'category_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "category_status" ,
                      'list_data' => array(
                          0 => "<span class='label label-danger'>Inactive</span>" ,
                          1 =>  "<span class='label label-primary'>Active</span>"
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