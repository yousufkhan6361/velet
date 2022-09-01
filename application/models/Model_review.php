<?
class Model_review extends MY_Model {
    /**
     * Model_review MODEL
     *
     * @package     review Model
     */

    protected $_table    = 'review';
    protected $_field_prefix    = 'review_';
    protected $_pk    = 'review_id';
    protected $_status_field    = 'review_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "review_id,product_ingram_desc_one as product_name,review_name, review_email, review_status";

        $this->pagination_params['joins'][] = array(
            "table"=>"product" ,
            "joint"=>"product.product_id = review.review_post_id",
            // add left to get import records
            "type"=>"left"
        );


        parent::__construct();

    }

    // Get blog comments
    public function get_comments($slug)
    {
        // Set params
        $params['where']['review_post_id'] = $slug;
        $params['order'] = 'review_id DESC';

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

    * list_data         For dropdown etc, data in key-value pair that will populate dropdown 
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it
    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    */
    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'review_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'review_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'review_post_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'review_post_id',
                     'label'   => 'Post',
                     'type'   => 'dropdown',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'dropdown',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
                ),

              'review_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'review_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'review_email'  => array(
                  'table'   => $this->_table,
                  'name'   => 'review_email',
                  'label'   => 'Email',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities|valid_email'
              ),


              'review_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'review_description',
                     'label'   => 'Description',
                     'type'   => 'textarea',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim|htmlentities|max_length[250]'
                  ),

           /* 'review_rating' => array(
                'table'   => $this->_table,
                'name'   => 'review_rating',
                'label'   => 'Rating',
                'type'   => 'dropdown',
                'list_data'    => array("1"=>"1","2"=>"2","3"=>"3","4"=>"4", "5"=>"5") ,
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required',
            ),
             */
              'review_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'review_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "review_status" ,
                  'list_data' => array(
                      0 => "<span class=\"label label-default\">Inactive</span>" ,
                      1 =>  "<span class=\"label label-primary\">Active</span>"
                  ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),

            'product_name' => array(
                'table'   => "product",
                'name'   => 'product_name',
                'label'   => 'Product',
                'type'   => 'none',
                'attributes'   => array(),
                'rules'   => 'trim|htmlentities'
            ),

            'review_created_on'  => array(
                'table'   => $this->_table,
                'name'   => 'review_created_on',
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