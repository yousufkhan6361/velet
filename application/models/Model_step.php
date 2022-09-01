<?
class Model_step extends MY_Model {
    /**
     * Comment MODEL
     *
     * @package     step Model
     */

    protected $_table    = 'step';
    protected $_field_prefix    = 'step_';
    protected $_pk    = 'step_id';
    protected $_status_field    = 'step_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "step_id,step_title, step_status,step_created_on";

        /*$this->pagination_params['joins'][] = array(
            "table"=>"blog" ,
            "joint"=>"blog.blog_id = step.step_post_id",
            // add left to get import records
            "type"=>"left"
        );*/


        parent::__construct();

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
        
              'step_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'step_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'step_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'step_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),


              'step_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'step_description',
                     'label'   => 'Description',
                     'type'   => 'editor',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim|htmlentities'
                  ),

           /* 'step_rating' => array(
                'table'   => $this->_table,
                'name'   => 'step_rating',
                'label'   => 'Rating',
                'type'   => 'dropdown',
                'list_data'    => array("1"=>"1","2"=>"2","3"=>"3","4"=>"4", "5"=>"5") ,
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required',
            ),
             */
              'step_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'step_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "step_status" ,
                  /*'list_data' => array(
                      0 => "<span class=\"label label-default\">Inactive</span>" ,
                      1 =>  "<span class=\"label label-primary\">Active</span>"
                  ) ,*/
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),

            'step_created_on'  => array(
                'table'   => $this->_table,
                'name'   => 'step_created_on',
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