<?
class Model_service extends MY_Model {
    /**
     * Service MODEL
     *
     * @package     Service Model
     * @author      
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'service';
    protected $_field_prefix    = 'service_';
    protected $_pk    = 'service_id';
    protected $_status_field    = 'service_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        //$this->pagination_params['fields'] = "service_id,service_title,CONCAT(service_image_path,service_image) AS service_image,service_status";
        $this->pagination_params['fields'] = "service_id,service_title,CONCAT(service_image_path,service_image) AS service_image,service_status";

        parent::__construct();

    }

    // Get all active services
    public function get_service()
    {
        // Set params
        $params['fields'] = "service_id, service_title, service_description, service_url, service_image, service_image_path";
        // Get result
        $result = $this->model_service->find_all_active($params);

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
              'service_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

            'service_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'service_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'service_slug',
                  'label'   => 'Slug',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|strtolower|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
              ),

           // 'service_short_detail' => array(
           //      'table' => $this->_table,
           //      'name' => 'service_short_detail',
           //      'label' => 'Short Lines',
           //      'type' => 'textarea',
           //      'attributes' => array(),
           //      'js_rules' => 'required',
           //      'rules' => 'required|trim|htmlentities'
           //  ),

            'service_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_description',
                     'label'   => 'Description',
                     'type'   => 'editor',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
            // 'service_url' => array(
            //     'table'   => $this->_table,
            //     'name'   => 'service_url',
            //     'label'   => 'URL',
            //     'type'   => 'hidden',
            //     'attributes'   => array(),
            //     'js_rules'   => '',
            //     'rules'   => 'trim|htmlentities'
            // ),
              'service_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_image',
                     'label'   => 'Image',
                     'name_path'   => 'service_image_path',
                     'upload_config'   => 'site_upload_service',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),
              'service_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'service_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "service_status" ,
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