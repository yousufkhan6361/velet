<?
class Model_kit extends MY_Model {
    /**
     * Blog MODEL
     *
     * @package     kit Model
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'kit';
    protected $_field_prefix    = 'kit_';
    protected $_pk    = 'kit_id';
    protected $_status_field    = 'kit_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "kit_id,kit_name,kit_status";
        
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


    public function get_fields( $specific_field = "" )
    {

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

              'kit_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'kit_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'kit_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'kit_name',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'kit_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'kit_slug',
                  'label'   => 'Slug',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),
            /*'kit_description' => array(
                'table'   => $this->_table,
                'name'   => 'kit_description',
                'label'   => 'Description',
                'type'   => 'editor',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|trim'
            ),*/

            'kit_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'kit_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "kit_status" ,
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