<?
class Model_style extends MY_Model {
    /**
     *
     * @package     Model_style
     * 
     * @version     2.0
     */

    protected $_table    = 'style';
    protected $_field_prefix    = 'style_';
    protected $_pk    = 'style_id';
    protected $_status_field    = 'style_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
//        $this->pagination_params['fields'] = "{pre}style.style_id,{pre}style.style_type,{pre}style.style_name,
        $this->pagination_params['fields'] = "style_id,style_name,style_status";
                                                
        /*$this->pagination_params['joins'][] = array(
                                                    "table"=>"style AS parent_cat" ,
                                                    "joint"=>"style.style_parent_id = parent_cat.style_id",
                                                    "type"=>"left" 
                                                );*/

        
        //$this->pagination_params['where']['style.style_parent_id >'] = 0 ;
        parent::__construct();

    }

    // Get latest categories
    //public function get_recent_styles($limit=5)
    public function get_recent_style($type)
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
        $params['fields'] = "style_id,style_name,style_slug,(select count(*) from sbf_product where product_style_id=style_id and product_status = 1 $and) as style_count";

        $params['order'] = 'style_name ASC';
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
        $param['fields'] = "style_id,style_slug,style_name,style_detail,style_parent_id";
        $param['where']['style_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }
    // Check slug exists or not
    public function find_by_slug_all($slug)
    {
        // Set params
        $param['where']['style_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }

    // Get total post active
    public function get_total_count($cat_id)
    {
        // Set params
        $params['where']['product_style_id'] = $cat_id;

        return $this->model_product->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $product_cat_id=0)
    {
        $prefix = $this->db->dbprefix;
        // Set params
        /*$param['fields'] = "product_id,product_name,product_slug,product_image, product_image_thumb,,product_image_path,product_description,product_image,product_image_thumb,product_image_path,product_createdon,
        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = product_id and comment_status=1) AS total_comments, product_style_name";*/
        $param['fields'] = "product_id,product_style_id,product_name,product_slug,product_price,product_overview,
        product_image,,product_image_thumb,product_image_path,product_createdon,style_name";
        // LEFT JOIN
        // LEFT JOIN
        $param['joins'][] = array(
            'table' => 'style',
            'joint' => 'style.style_id = product.product_style_id',
            'type' => 'right'
        );
        $param['where']['product.product_style_id'] = $product_cat_id;
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
        $para['where']['style_id > '] = 2;
        $para['order'] = "style_name ASC";
        $categories = $this->model_style->find_all_list_active($para,"style_name");

        return $categories;
    }

    public function get_menu_categories($id=0)
    {
        $params['fields'] = 'style_id,style_parent_id,style_name,style_image,style_image_thumb,style_image_path,style_slug';
        $params['order'] = 'style_parent_id';
        $data = $this->find_all_active($params);
        
        $result = array();
        foreach ($data as $key => $value) 
        {
            $result[ $value['style_id'] ] = $value;
        }
        foreach ($result as $key => $value) 
        {
            $children[ $value['style_parent_id'] ][$key] = $value;
        }
        $menu_categories = (recursive_array($result , $children));
        return $menu_categories[1] ;
    }

    // Get Parent hirarechy for Categories
    public function get_ancestory($value , $key = "style_id" , $fields = "t.*" )
    {
        $result = array();
        $value = urldecode($value);
        if($key && $value && $this->get_fields($key) )
        {
            $query = "SELECT @pv:=t.style_parent_id as style_parent_id, $fields
                        from  (SELECT * FROM pg_style ORDER BY style_id DESC) t 
                        JOIN
                        (SELECT @pv:= (SELECT style_id FROM pg_style WHERE $key = '$value' ))tmp
                        WHERE t.style_id=@pv AND t.style_id > 1 AND t.style_status = ".STATUS_ACTIVE;
            $result = $this->db->query($query)->result_array();
            return $result;
        }
    }

    // Get All Children Under A Cateogry
    public function get_children_by_parent_id($parent_id )
    {
        $result = array();
        $params['where']['style_parent_id'] = intval($parent_id);
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
        
              'style_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'style_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),



               /*'style_type' => array(
                      'table'   => $this->_table,
                      'name'   => 'style_type',
                      'label'   => 'Category Type',
                      'type'   => 'text',
                      'type_dt'   => 'text',
                      'attributes'   => array(),
                      'dt_attributes'   => array("width"=>"5%"),
                      'js_rules'   => '',
                      'rules'   => 'trim'
                 ),*/

            /*'style_type' => array(
                   'table'   => $this->_table,
                   'name'   => 'style_type',
                   'label'   => 'Level',
                   'type'   => 'dropdown',
                   'list_data'    => array("1"=>"Parent","2"=>"Level 1","3"=>"Level 2","4"=>"Level 3") ,
                   'attributes'   => array(),
                   'js_rules'   => 'required',
                   'rules'   => 'required|trim',
                ),

              'style_parent_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'style_parent_id',
                     'label'   => 'Category ID',
                     'type'   => 'dropdown',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'dropdown',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
            ),*/

              'style_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'style_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),             
              
              'style_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'style_slug',
                  'label'   => 'Title',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),
              


              'style_detail'  => array(
                  'table'   => $this->_table,
                  'name'   => 'style_detail',
                  'label'   => 'Detail',
                  'type'   => 'editor',
                  'attributes'   => array(),
                  'js_rules'   => '',
                  'rules'   => 'htmlentities'
              ),



           /* 'style_banner_image' => array(
                'table' => $this->_table,
                'name' => 'style_banner_image',
                'label' => 'Banner Image',
                'name_path' => 'style_image_path',
                'upload_config' => 'site_upload_style',
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


            
            /*'style_image' => array(
                'table' => $this->_table,
                'name' => 'style_image',
                'label' => 'Image',
                'name_path' => 'style_image_path',
                'upload_config' => 'site_upload_style',
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

              
              'style_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'style_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "style_status" ,
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