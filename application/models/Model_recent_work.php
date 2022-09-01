<?
class Model_recent_work extends MY_Model {
    /**
     * Model_recent_work MODEL
     *
     * @package     Model_recent_work Model
     * @author      
     * @version     1.0
     * @since       2019
     */

    protected $_table    = 'recent_work';
    protected $_field_prefix    = 'recent_work_';
    protected $_pk    = 'recent_work_id';
    protected $_status_field    = 'recent_work_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "recent_work_id,recent_work_title,CONCAT(recent_work_image_path,recent_work_image) as recent_work_image,recent_work_status";
        
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

        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(
        
              'recent_work_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'recent_work_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'recent_work_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'recent_work_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'recent_work_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'recent_work_image',
                     'label'   => 'Image',
                     'name_path'   => 'recent_work_image_path',
                     'upload_config'   => 'site_upload_recent_work',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('image_size'=>'Recommended image size : 530px × 344px','allow_ext'=>'png|jpeg|jpg',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),


              'recent_work_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'recent_work_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "recent_work_status" ,
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