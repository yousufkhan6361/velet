<?
class Model_service_main extends MY_Model {
    /**
     * service_main MODEL
     *
     * @package     service_main Model
     * @author      
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'service_main';
    protected $_field_prefix    = 'service_main_';
    protected $_pk    = 'service_main_id';
    protected $_status_field    = 'service_main_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "service_main_id,service_main_name,service_main_status";
        
        parent::__construct();

    }

    // Get all active service_mains
    public function get_service_main()
    {
        // Set params
        $params['fields'] = "service_main_id, service_main_title, service_main_description, service_main_url, service_main_image, service_main_image_path";
        // Get result
        $result = $this->model_service_main->find_all_active($params);

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
              'service_main_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_main_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'service_main_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_main_name',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),             
              
              'service_main_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'service_main_slug',
                  'label'   => 'Slug',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),
              'service_main_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_main_description',
                     'label'   => 'Description',
                     'type'   => 'editor',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              'service_main_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_main_image',
                     'label'   => 'Image',
                     'name_path'   => 'service_main_image_path',
                     'upload_config'   => 'site_upload_service_main',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),
              
              'service_main_description_2' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_main_description_2',
                     'label'   => 'Description',
                     'type'   => 'editor',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

            'service_main_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_main_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "service_main_status" ,
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