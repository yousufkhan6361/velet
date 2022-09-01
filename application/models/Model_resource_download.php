<?
class Model_resource_download extends MY_Model {
    /**
     * resource_download MODEL
     *
     * @package     resource_download Model
     * @author      
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'resource_download';
    protected $_field_prefix    = 'resource_download_';
    protected $_pk    = 'resource_download_id';
    protected $_status_field    = 'resource_download_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "resource_download_id,resource_download_title,resource_download_status";
        
        parent::__construct();

    }

    // Get all active resource_downloads
    public function get_resource_download()
    {
        // Set params
        $params['fields'] = "resource_download_name, resource_download_name, resource_download_designation, resource_download_description, resource_download_image, resource_download_image_path";
        // Get result
        $result = $this->model_resource_download->find_all_active($params);

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
        
              'resource_download_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'resource_download_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),




              'resource_download_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'resource_download_title',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              /*'resource_download_part_number' => array(
                     'table'   => $this->_table,
                     'name'   => 'resource_download_part_number',
                     'label'   => 'Part Number',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),*/
              'resource_download_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'resource_download_description',
                     'label'   => 'Description',
                     'type'   => 'editor',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),



              'resource_download_file' => array(
                     'table'   => $this->_table,
                     'name'   => 'resource_download_file',
                     'label'   => 'Attachment',
                     'name_path'   => 'resource_download_file_path',
                     'upload_config'   => 'site_upload_resource_download',
                     'type'   => 'customfileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     //'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                     'attributes'   => array('allow_ext'=>'doc|docx|pdf',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),


              'resource_download_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'resource_download_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "resource_download_status" ,
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