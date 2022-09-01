<?
class Model_color extends MY_Model
{
    /**
     * TKD color MODEL
     *
     * @package     color Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'color';
    protected $_field_prefix = 'color_';
    protected $_pk = 'color_id';
    protected $_status_field = 'color_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "color_id,color_name,color_code,color_status";

        parent::__construct();
    }



    

    /*
    * table       Table Name
    * Name        FIeld Name
    * label       Field Label / Textual Representation in form and DT headings
    * type        Field type : hidden, text, textarea, editor, etc etc. 
    *                           Implementation in form_generator.php
    * type_dt     Type used by prepare_datatables method in controller to prepare DT value
    *                           If left blank, prepare_datatable Will opt to use 'type'
    * attributes  HTML Field Attributes
    * js_rules    Rules to be aplied in JS (form validation)
    * rules       Server side Validation. Supports CI Native rules
    */
    public function get_fields($specific_field = "")
    {
        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

            'color_id' => array(
                'table' => $this->_table,
                'name' => 'color_id',
                'label' => 'ID',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => 'required',
                'rules' => 'trim'
            ),

            

            'color_name' => array(
                'table' => $this->_table,
                'name' => 'color_name',
                'label' => 'Name',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),

            'color_code' => array(
                'table' => $this->_table,
                'name' => 'color_code',
                'label' => 'Color Code',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            

            'color_status' => array(
                'table' => $this->_table,
                'name' => 'color_status',
                'label' => 'Status',
                'type' => 'switch',
                'type_dt' => 'switch',
                'type_filter_dt' => 'dropdown',
                'list_data' => array(),
                'default' => '1',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),

        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>