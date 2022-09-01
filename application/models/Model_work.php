<?
class Model_work extends MY_Model {
    /**
     * MODEL
     *
     * @package     Work Model
     * @version     1.0
     * @since       2018
     */

    protected $_table    = 'work';
    protected $_field_prefix    = 'work_';
    protected $_pk    = 'work_id';
    protected $_status_field    = 'work_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "work_id,work_title, CONCAT(work_image_path,work_image) AS work_image,work_status";
        
        parent::__construct();

    }

    public function get_works()
    {
        $params['order'] = "work_id ASC" ;
       return $this->model_work->find_all_active($params);
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
        
              'work_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'work_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'work_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'work_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

               'work_description' => array(
                      'table'   => $this->_table,
                      'name'   => 'work_description',
                      'label'   => 'Description',
                      'type'   => 'textarea',
                      'attributes'   => array(),
                      'js_rules'   => 'required',
                      'rules'   => 'required|trim|htmlentities'
                   ),
              
              'work_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'work_image',
                     'label'   => 'Image',
                     'name_path'   => 'work_image_path',
                     'upload_config'   => 'site_upload_work',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('image_size'=>'Image size : 192px × 44px','allow_ext'=>'png|jpeg|jpg',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),
             
              'work_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'work_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "work_status" ,
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