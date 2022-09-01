<?
class Model_feature extends MY_Model {
    /**
     * TESTIMONIAL MODEL
     *
     * @package     TESTIMONIAL Model
     * @author
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'feature';
    protected $_field_prefix    = 'feature_';
    protected $_pk    = 'feature_id';
    protected $_status_field    = 'feature_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "feature_id,feature_title,
        CONCAT(feature_image_path,feature_image) AS feature_image,feature_status";

        parent::__construct();

    }

    // Get all active features
    public function get_features()
    {
        // Set params
        //$params['fields'] = "feature_name, feature_title, feature_description, feature_image, feature_image_path";
        // Get result
        $result = $this->model_feature->find_all_active();

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

            'feature_id' => array(
                'table'   => $this->_table,
                'name'   => 'feature_id',
                'label'   => 'id #',
                'type'   => 'hidden',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"5%"),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),




            'feature_title' => array(
                'table'   => $this->_table,
                'name'   => 'feature_title',
                'label'   => 'Title',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required|trim|htmlentities'
            ),

              /*'feature_designation' => array(
                     'table'   => $this->_table,
                     'name'   => 'feature_designation',
                     'label'   => 'Designation',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities|max_length[20]'
                  ),*/
              'feature_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'feature_description',
                     'label'   => 'Description',
                     'type'   => 'textarea',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),



            'feature_image' => array(
                'table'   => $this->_table,
                'name'   => 'feature_image',
                'label'   => 'Image',
                'name_path'   => 'feature_image_path',
                'upload_config'   => 'site_upload_feature',
                'type'   => 'fileupload',
                'type_dt'   => 'image',
                'randomize' => true,
                'preview'   => 'true',
                'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                'dt_attributes'   => array("width"=>"10%"),
                'rules'   => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),


            'feature_status' => array(
                'table'   => $this->_table,
                'name'   => 'feature_status',
                'label'   => 'Status?',
                'type'   => 'switch',
                'type_dt'   => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "feature_status" ,
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