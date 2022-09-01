<?
class Model_media extends MY_Model {
    /**
     * Blog MODEL
     *
     * @package     media Model
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'media';
    protected $_field_prefix    = 'media_';
    protected $_pk    = 'media_id';
    protected $_status_field    = 'media_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "media_id,media_name,media_position,media_status";
        
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

    // Get all medias
    public function get_all_media()
    {
        // Set params
        $params['order'] = 'media_position ASC';
        $result = $this->find_all_active($params);

        return $result;
    }


    // Check slug exists or not (Join to fetch category)
    public function find_by_slug($slug)
    {

        $param['where']['media_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }

    public function get_fields( $specific_field = "" )
    {

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

              'media_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'media_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'media_position' => array(
                     'table'   => $this->_table,
                     'name'   => 'media_position',
                     'label'   => 'Position',
                     'type'   => 'dropdown',
                     'attributes'   => array(),
                     'list_data' => array(
                         '1'=>'1',
                         '2'=>'2',
                         '3'=>'3',
                         '4'=>'4',
                         '5'=>'5',
                         '6'=>'6',
                         '7'=>'7',
                         '8'=>'8',
                         '9'=>'9',
                         '10'=>'10',
                     ),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
              'media_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'media_name',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'media_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'media_slug',
                  'label'   => 'Slug',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),
            'media_description' => array(
                'table'   => $this->_table,
                'name'   => 'media_description',
                'label'   => 'Description',
                'type'   => 'editor',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|trim'
            ),


            'media_image' => array(
                'table' => $this->_table,
                'name' => 'media_image',
                'label' => 'Image',
                'name_path' => 'media_image_path',
                'upload_config' => 'site_upload_media',
                'thumb'   => array(array('name'=>'media_image_thumb','max_width'=>320, 'max_height'=>200),),
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes' => array('allow_ext'=>'png|jpeg|jpg','image_size_recommended'=>'771 × 250 px',),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),
            'media_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'media_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "media_status" ,
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