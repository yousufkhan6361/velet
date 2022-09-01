<?
class Model_color extends MY_Model {
    /**
     * color MODEL
     *
     * @package     color Model
     * @author      
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'color';
    protected $_field_prefix    = 'color_';
    protected $_pk    = 'color_id';
    protected $_status_field    = 'color_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "color_id,color_name,color_status";
        parent::__construct();

    }

    // Get all active colors
    public function get_color()
    {
        // Set params
        $params['fields'] = "color_image, color_image_path";
        // Get result
        $result = $this->model_color->find_all_active($params);

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
        
              'color_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'color_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),




              'color_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'color_name',
                     'label'   => 'Color Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              // 'color_aqua_code' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'color_aqua_code',
              //        'label'   => 'Aqua Code',
              //        'type'   => 'text',
              //        'attributes'   => array(),
              //        'js_rules'   => 'required',
              //        'rules'   => 'required|trim|htmlentities'
              //     ),

            //   'color_product_id' => array(
            //     'table' => $this->_table,
            //     'name' => 'color_product_id',
            //     'label' => 'Product ID',
            //     'type' => 'hidden',
            //     'attributes' => array(),
            //     'js_rules' => '',
            //     'rules' => ''
            // ),

              'color_image' => array(
                'table'   => $this->_table,
                'name'   => 'color_image',
                'label'   => 'color Image*',
                'name_path'   => 'color_image_path',
                'upload_config' => 'site_upload_color',
                'type' => 'fileupload',
                'attributes'   => array(
                    'allow_ext'=>'png|jpeg|jpg',
                    'Image Size'=>'500 px x 500 px'
                ),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'   => $is_required_image,
            ),


              'color_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'color_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "color_status" ,
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