<?
class Model_technical_document extends MY_Model {
    /**
     * technical_document MODEL
     *
     * @package     technical_document Model
     * @author      
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'technical_document';
    protected $_field_prefix    = 'technical_document_';
    protected $_pk    = 'technical_document_id';
    protected $_status_field    = 'technical_document_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "technical_document_id,technical_document_title,technical_document_part_number,technical_document_status";
        
        parent::__construct();

    }

    // Get all active technical_documents
    public function get_technical_document()
    {
        // Set params
        $params['fields'] = "technical_document_name, technical_document_name, technical_document_designation, technical_document_description, technical_document_image, technical_document_image_path";
        // Get result
        $result = $this->model_technical_document->find_all_active($params);

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
        
              'technical_document_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'technical_document_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),




              'technical_document_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'technical_document_title',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'technical_document_part_number' => array(
                     'table'   => $this->_table,
                     'name'   => 'technical_document_part_number',
                     'label'   => 'Part Number',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              /*'technical_document_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'technical_document_description',
                     'label'   => 'Description',
                     'type'   => 'textarea',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),*/



              'technical_document_file' => array(
                     'table'   => $this->_table,
                     'name'   => 'technical_document_file',
                     'label'   => 'Attachment',
                     'name_path'   => 'technical_document_file_path',
                     'upload_config'   => 'site_upload_technical_document',
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


              'technical_document_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'technical_document_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "technical_document_status" ,
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