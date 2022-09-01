<?
class Model_assets extends MY_Model {
    /**
     * assets MODEL
     *
     * @package     assets Model
     * @author      
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'assets';
    protected $_field_prefix    = 'assets_';
    protected $_pk    = 'assets_id';
    protected $_status_field    = 'assets_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "assets_id,assets_name,
        CONCAT(assets_image_path,assets_image) AS assets_image,assets_status";
        
        parent::__construct();

    }

    // Get all active assetss
    public function get_assets()
    {
        // Set params
        $params['fields'] = "assets_name, assets_name, assets_designation, assets_description, assets_image, assets_image_path";
        // Get result
        $result = $this->model_assets->find_all_active($params);

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
        
              'assets_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'assets_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'assets_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'assets_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'assets_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'assets_image',
                     'label'   => 'Image',
                     'name_path'   => 'assets_image_path',
                     'upload_config'   => 'site_upload_assets',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),

              'assets_image2' => array(
                     'table'   => $this->_table,
                     'name'   => 'assets_image2',
                     'label'   => 'Image 2',
                     'name_path'   => 'assets_image_path',
                     'upload_config'   => 'site_upload_assets',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities',
                     'js_rules'=>$is_required_image
                  ),


              'assets_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'assets_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "assets_status" ,
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