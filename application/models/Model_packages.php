<?
class Model_packages extends MY_Model {
    /**
     * TKD packages MODEL
     *
     * @package     packages Model
     * 
     * @version     2.0
     * @since       2015 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'packages';
    protected $_field_prefix    = 'packages_';
    protected $_pk    = 'packages_id';
    protected $_status_field    = 'packages_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
//        $this->pagination_params['fields'] = "{pre}packages.packages_id,{pre}packages.packages_type,{pre}packages.packages_name,
        $this->pagination_params['fields'] = "packages_id,packages_name,packages_status";
                                                
        /*$this->pagination_params['joins'][] = array(
                                                    "table"=>"packages AS parent_cat" , 
                                                    "joint"=>"packages.packages_parent_id = parent_cat.packages_id", 
                                                    "type"=>"left" 
                                                );*/

        
        //$this->pagination_params['where']['packages.packages_parent_id >'] = 0 ;
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
        $params['fields'] = "packages_id,packages_name,packages_slug,(select count(*) from sbf_product where product_packages_id=packages_id and product_status = 1 $and) as cat_count";

        $params['order'] = 'packages_name ASC';
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
        $param['fields'] = "packages_id,packages_slug,packages_name,packages_detail,packages_parent_id";
        $param['where']['packages_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }
    // Check slug exists or not
    public function find_by_slug_all($slug)
    {
        // Set params
        $param['where']['packages_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }

    // Get total post active
    public function get_total_count($cat_id)
    {
        // Set params
        $params['where']['product_packages_id'] = $cat_id;

        return $this->model_product->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $product_cat_id=0)
    {
        $prefix = $this->db->dbprefix;
        // Set params
        /*$param['fields'] = "product_id,product_name,product_slug,product_image, product_image_thumb,,product_image_path,product_description,product_image,product_image_thumb,product_image_path,product_createdon,
        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = product_id and comment_status=1) AS total_comments, product_packages_name";*/
        $param['fields'] = "product_id,product_packages_id,product_name,product_slug,product_price,product_old_price,product_overview,
        product_image,,product_image_thumb,product_image_path,product_createdon,packages_name";
        // LEFT JOIN
        // LEFT JOIN
        $param['joins'][] = array(
            'table' => 'packages',
            'joint' => 'packages.packages_id = product.product_packages_id',
            'type' => 'right'
        );
        $param['where']['product.product_packages_id'] = $product_cat_id;
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
        $para['where']['packages_id > '] = 2;
        $para['order'] = "packages_name ASC";
        $categories = $this->model_packages->find_all_list_active($para,"packages_name");

        return $categories;
    }

    public function get_menu_categories($id=0)
    {
        $params['fields'] = 'packages_id,packages_parent_id,packages_name,packages_image,packages_image_thumb,packages_image_path,packages_slug';
        $params['order'] = 'packages_parent_id';
        $data = $this->find_all_active($params);
        
        $result = array();
        foreach ($data as $key => $value) 
        {
            $result[ $value['packages_id'] ] = $value;
        }
        foreach ($result as $key => $value) 
        {
            $children[ $value['packages_parent_id'] ][$key] = $value;
        }
        $menu_categories = (recursive_array($result , $children));
        return $menu_categories[1] ;
    }

    // Get Parent hirarechy for Categories
    public function get_ancestory($value , $key = "packages_id" , $fields = "t.*" )
    {
        $result = array();
        $value = urldecode($value);
        if($key && $value && $this->get_fields($key) )
        {
            $query = "SELECT @pv:=t.packages_parent_id as packages_parent_id, $fields
                        from  (SELECT * FROM pg_packages ORDER BY packages_id DESC) t 
                        JOIN
                        (SELECT @pv:= (SELECT packages_id FROM pg_packages WHERE $key = '$value' ))tmp
                        WHERE t.packages_id=@pv AND t.packages_id > 1 AND t.packages_status = ".STATUS_ACTIVE;
            $result = $this->db->query($query)->result_array();
            return $result;
        }
    }

    // Get All Children Under A Cateogry
    public function get_children_by_parent_id($parent_id )
    {
        $result = array();
        $params['where']['packages_parent_id'] = intval($parent_id);
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
        
              'packages_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'packages_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),



               /*'packages_type' => array(
                      'table'   => $this->_table,
                      'name'   => 'packages_type',
                      'label'   => 'packages Type',
                      'type'   => 'text',
                      'type_dt'   => 'text',
                      'attributes'   => array(),
                      'dt_attributes'   => array("width"=>"5%"),
                      'js_rules'   => '',
                      'rules'   => 'trim'
                 ),*/

            /*'packages_type' => array(
                   'table'   => $this->_table,
                   'name'   => 'packages_type',
                   'label'   => 'Level',
                   'type'   => 'dropdown',
                   'list_data'    => array("1"=>"Parent","2"=>"Level 1","3"=>"Level 2","4"=>"Level 3") ,
                   'attributes'   => array(),
                   'js_rules'   => 'required',
                   'rules'   => 'required|trim',
                ),

              'packages_parent_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'packages_parent_id',
                     'label'   => 'packages ID',
                     'type'   => 'dropdown',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'dropdown',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
            ),*/

              'packages_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'packages_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(""),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),             
              
              // 'packages_slug'  => array(
              //     'table'   => $this->_table,
              //     'name'   => 'packages_slug',
              //     'label'   => 'Title',
              //     'type'   => 'hidden',
              //     'attributes'   => array(),
              //     'js_rules'   => array("is_slug" => array() ),
              //     'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              // ),
              



              'packages_price'  => array(
                  'table'   => $this->_table,
                  'name'   => 'packages_price',
                  'label'   => 'Price',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => '',
                  'rules'   => 'htmlentities'
              ),


              'packages_description'  => array(
                  'table'   => $this->_table,
                  'name'   => 'packages_description',
                  'label'   => 'Description',
                  'type'   => 'editor',
                  'attributes'   => array(),
                  'js_rules'   => '',
                  'rules'   => 'htmlentities'
              ),



           /* 'packages_banner_image' => array(
                'table' => $this->_table,
                'name' => 'packages_banner_image',
                'label' => 'Banner Image',
                'name_path' => 'packages_image_path',
                'upload_config' => 'site_upload_packages',
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


            
            // 'packages_image' => array(
            //     'table' => $this->_table,
            //     'name' => 'packages_image',
            //     'label' => 'Image',
            //     'name_path' => 'packages_image_path',
            //     'upload_config' => 'site_upload_packages',
            //     'type' => 'fileupload',
            //     'type_dt' => 'image',
            //     'randomize' => true,
            //     'preview' => 'true',
            //     'attributes'   => array(
            //         'image_size_recommended'=>'1263px × 517px',
            //         'allow_ext'=>'png|jpeg|jpg',
            //     ),
            //     'dt_attributes' => array("width" => "10%"),
            //     'rules' => 'trim|htmlentities',
            //     'js_rules'=>$is_required_image
            // ),

              
              'packages_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'packages_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "packages_status" ,
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