<?
class Model_logo extends MY_Model {
    /**
     * TKD logo MODEL
     *
     * @package     logo Model
     * 
     * @version     2.0
     * @since       2015 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'logo';
    protected $_field_prefix    = 'logo_';
    protected $_pk    = 'logo_id';
    protected $_status_field    = 'logo_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "logo_id,logo_name, 
                                                CONCAT(logo_image_path,logo_image) AS logo_image,
                                                logo_status";
       
        $this->pagination_params['where']['logo_status !='] = 2 ;
        parent::__construct();

    }

    // Get logo
    public function get_logo()
    {
        // Set params
        //$params['where']['logo_id'] =
        $params['fields'] = "CONCAT(logo_image_path, '', logo_image) as logo";
        $result = $this->find_one_active($params);
        return g('base_url') . $result['logo'];
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
    * 
    * list_data         For dropdown etc, data in key-value pair that will populate dropdown 
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it
    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    */
    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'logo_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'logo_id',
                     'label'   => 'ID #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              // 'logo_name' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'logo_name',
              //        'label'   => 'Name',
              //        'type'   => 'text',
              //        //'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
              //        'js_rules'   => 'required',
              //        'rules'   => 'required|trim|htmlentities'
              //     ),

              'logo_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'logo_image',
                     'label'   => 'Logo',
                     'name_path'   => 'logo_image_path',
                     'upload_config'   => 'site_upload_logo',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'thumb'   => array(array('name'=>'logo_image_thumb','max_width'=>150, 'max_height'=>150),),
                      'attributes'   => array(
                          'image_size_recommended'=>'171px × 157px',
                          'allow_ext'=>'png|jpeg|jpg',
                      ),
                     'randomize' => true,
                     'preview'   => 'true',
                     //'attributes'   => array('label'=>'width = 260, Height = 43'),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities'
                  ),
              'logo_favicon' => array(
                     'table'   => $this->_table,
                     'name'   => 'logo_favicon',
                     'label'   => 'Favicon',
                     'name_path'   => 'logo_image_path',
                     'upload_config'   => 'site_upload_logo',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     //'thumb'   => array(array('name'=>'logo_image_thumb','max_width'=>150, 'max_height'=>150),),
                      'attributes'   => array(
                          'image_size_recommended'=>'64px × 64px',
                          'allow_ext'=>'png|jpeg|jpg',
                      ),
                     'randomize' => true,
                     'preview'   => 'true',
                     //'attributes'   => array('label'=>'width = 260, Height = 43'),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities'
                  ),
              /*
              'logo_sticky_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'logo_sticky_image',
                     'label'   => 'Footer Logo',
                     'name_path'   => 'logo_sticky_image_path',
                     'upload_config'   => 'site_upload_default',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array('label'=>'width = 260, Height = 43'),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities'
                  ),
    */
              /*
              'logo_sticky_image' => array(
                     'table'   => $this->_table,
                     'name'   => 'logo_sticky_image',
                     'label'   => 'Dark Logo',
                     'name_path'   => 'logo_sticky_image_path',
                     'upload_config'   => 'site_upload_default',
                     'type'   => 'fileupload',
                     'type_dt'   => 'image',
                     'randomize' => true,
                     'preview'   => 'true',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'rules'   => 'trim|htmlentities'
                  ),
                */
              
              'logo_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'logo_status',
                     'label'   => 'Status?',
                     //'type'   => 'switch',
                     'type'   => 'hidden',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "logo_status" ,
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