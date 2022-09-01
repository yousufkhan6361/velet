<?
class Model_pricing extends MY_Model {
    /**
     * pricing MODEL
     *
     * @package     pricing Model
     * @author
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'pricing';
    protected $_field_prefix    = 'pricing_';
    protected $_pk    = 'pricing_id';
    protected $_status_field    = 'pricing_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "pricing_id,pricing_name,CONCAT('$', '',pricing_amount),pricing_status";

        parent::__construct();

    }

    // Get all active pricings
    public function get_pricing()
    {
        // Set params
        //$params['fields'] = "pricing_name, pricing_title, pricing_description, pricing_image, pricing_image_path";
        // Get result
        $result = $this->model_pricing->find_all_active();

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

            'pricing_id' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_id',
                'label'   => 'id #',
                'type'   => 'hidden',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"5%"),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),

            /*'pricing_title' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_title',
                'label'   => 'Title',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required|trim|htmlentities'
            ),*/

            // 'pricing_type' => array(
            //     'table'   => $this->_table,
            //     'name'   => 'pricing_type',
            //     'label'   => 'Type',
            //     'type'   => 'dropdown',
            //     'type_dt'   => 'dropdown',
            //     'type_filter_dt' => 'dropdown',
            //     'list_data'=>array(
            //         '1'=>'Days',
            //         '2'=>'Month',
            //         '3'=>'Year',
            //     ),
            //     'attributes'   => array(),
            //     'js_rules'   => 'required',
            //     'rules'   => 'required|trim|htmlentities'
            // ),
            'pricing_name' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_name',
                'label'   => 'Name',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required|trim|htmlentities'
            ),
            'pricing_amount' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_amount',
                'label'   => 'Amount',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => 'required',
                'rules'   => 'required|trim|htmlentities'
            ),

              /*'pricing_designation' => array(
                     'table'   => $this->_table,
                     'name'   => 'pricing_designation',
                     'label'   => 'Designation',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities|max_length[20]'
                  ),*/
              /*'pricing_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'pricing_description',
                     'label'   => 'Description',
                     'type'   => 'textarea',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),*/

            /*'pricing_is_popular' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_is_popular',
                'label'   => 'Is Popular',
                'type'   => 'switch',
                'type_dt'   => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "pricing_is_popular" ,
                'list_data' => array(),
                'default'   => '1',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"7%"),
                'rules'   => 'trim'
            ),*/


           /* 'pricing_image' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_image',
                'label'   => 'Image',
                'name_path'   => 'pricing_image_path',
                'upload_config'   => 'site_upload_pricing',
                'type'   => 'fileupload',
                'type_dt'   => 'image',
                'randomize' => true,
                'preview'   => 'true',
                'attributes'   => array('image_size'=>'Recommended image size : 96px × 96px','allow_ext'=>'png|jpeg|jpg',),
                'dt_attributes'   => array("width"=>"10%"),
                'rules'   => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),*/


            'pricing_status' => array(
                'table'   => $this->_table,
                'name'   => 'pricing_status',
                'label'   => 'Status?',
                'type'   => 'switch',
                'type_dt'   => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "pricing_status" ,
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