<?
class Model_comment extends MY_Model {
    /**
     * Comment MODEL
     *
     * @package     comment Model
     */

    protected $_table    = 'comment';
    protected $_field_prefix    = 'comment_';
    protected $_pk    = 'comment_id';
    protected $_status_field    = 'comment_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "comment_id,comment_name, comment_subject, comment_status";

        $this->pagination_params['joins'][] = array(
            "table"=>"blog" ,
            "joint"=>"blog.blog_id = comment.comment_post_id",
            // add left to get import records
            "type"=>"left"
        );


        parent::__construct();

    }

    public function get_comments($id = 0)
    {
        $param['where']['comment_post_id'] = $id;
        $result = $this->find_all_active($param);

        return array($result, count($result), $this->rating_avg($id));
    }
    public function find_all_comment_count($id = 0)
    {
        $param['where']['comment_post_id'] = $id;
        $result = $this->find_count_active($param);

        return $result;
    }

    // Calculate average
    public function rating_avg($id=0)
    {
        $params['fields'] = "comment_rating,count(*) as total";
        $params['where']['comment_post_id'] = $id;
        $params['group'] = "comment_rating";
        $result = $this->find_all_active($params);

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

        $fields = array(
        
              'comment_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'comment_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'comment_post_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'comment_post_id',
                     'label'   => 'Post',
                     'type'   => 'dropdown',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'dropdown',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
                ),

              'comment_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'comment_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'comment_subject'  => array(
                  'table'   => $this->_table,
                  'name'   => 'comment_subject',
                  'label'   => 'Subject',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities'
              ),
              'comment_rating'  => array(
                  'table'   => $this->_table,
                  'name'   => 'comment_rating',
                  'label'   => 'Rating',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities'
              ),
              'comment_email'  => array(
                  'table'   => $this->_table,
                  'name'   => 'comment_email',
                  'label'   => 'Email',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'htmlentities|valid_email'
              ),


              'comment_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'comment_description',
                     'label'   => 'Description',
                     'type'   => 'textarea',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim|htmlentities'
                  ),

           /* 'comment_rating' => array(
                'table'   => $this->_table,
                'name'   => 'comment_rating',
                'label'   => 'Rating',
                'type'   => 'dropdown',
                'list_data'    => array("1"=>"1","2"=>"2","3"=>"3","4"=>"4", "5"=>"5") ,
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required',
            ),
             */
              'comment_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'comment_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "comment_status" ,
                  'list_data' => array(
                      0 => "<span class=\"label label-default\">Inactive</span>" ,
                      1 =>  "<span class=\"label label-primary\">Active</span>"
                  ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),

            'blog_name' => array(
                'table'   => "blog",
                'name'   => 'blog_title',
                'label'   => 'Blog',
                'type'   => 'none',
                'attributes'   => array(),
                'rules'   => 'trim|htmlentities'
            ),

            'comment_created_on'  => array(
                'table'   => $this->_table,
                'name'   => 'comment_created_on',
                'label'   => 'Created',
                'type'   => 'none',
                'attributes'   => array(),
                'rules'   => 'trim'
            )
              
            );
        
        if($specific_field)
            return $fields[ $specific_field ];
        else
            return $fields;
    }

}
?>