<?
class Model_blog_category extends MY_Model
{
    /**
     * TKD blog_category MODEL
     *
     * @package     blog_category Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'blog_category';
    protected $_field_prefix = 'blog_category_';
    protected $_pk = 'blog_category_id';
    protected $_status_field = 'blog_category_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "blog_category_id,blog_category_name,,blog_category_status";

        parent::__construct();
    }

    public function get_page_blog_category($page='')
    {
        // Set params
        $params['fields'] = 'blog_category_page,blog_category_name,,blog_category_status';
        $params['where']['blog_category_page'] = $page;
        return $this->model_blog_category->find_one_active($params);

    }

    // Get categories with total number of post
    public function get_recent_categories()
    {
        $params['fields'] = "blog_category_id,blog_category_name,blog_category_slug,(select count(*) from yt_blog where blog_category = blog_category_id) as total_post";
        return $this->find_all_active($params);
    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        $param['where']['blog_category_slug'] = $slug;
        // JOIN
        $param['joins'][] = array(
            "table"=>"blog" ,
            "joint"=>"blog.blog_category = blog_category.blog_category_id",
        );

        // Query

        $result = $this->find_all_active($param);
        // Return result;

        return $result;

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
        
              'blog_category_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'blog_category_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'blog_category_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'blog_category_name',
                     'label'   => 'Category Name',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'blog_category_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'blog_category_slug',
                  'label'   => 'Slug',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|strtolower|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
              ),

              'blog_category_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'blog_category_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "blog_category_status" ,
                     'list_data' => array(),
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                   ),

        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>