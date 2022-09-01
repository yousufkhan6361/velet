<?

class Model_state extends MY_Model
{
    /**
     * TKD state MODEL
     *
     * @package     state Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'state';
    protected $_field_prefix = 'state_';
    protected $_pk = 'state_id';
    protected $_status_field = 'state_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        //$this->pagination_params['fields'] = "state_id,state_page,state_name,CONCAT(state_image_path,state_image) AS state_image,state_status";
        $this->pagination_params['fields'] = "state_id,,state_name,state_tax,state_status";
        //$this->pagination_params['fields'] = "state_id,state_name,state_status";

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
        // Show button link and url
        $segment = array(1);
        $segment_id = $this->uri->segment(4);

        // Use when add new image
        $is_required_image = (($this->uri->segment(4) != null) && intval($this->uri->segment(4))) ? '' : 'required';

        $fields['state_id'] = array(
            'table' => $this->_table,
            'name' => 'state_id',
            'label' => 'ID',
            'type' => 'hidden',
            'type_dt' => 'text',
            'attributes' => array(),
            'dt_attributes' => array("width" => "5%"),
            'js_rules' => 'required',
            'rules' => 'trim'
        );


        $fields['state_name'] = array(
            'table' => $this->_table,
            'name' => 'state_name',
            'label' => 'Name',
            'type' => 'text',
            'attributes' => array(),
            'js_rules' => 'required',
            'rules' => 'required|trim|htmlentities'
        );
       
         $fields['state_tax'] = array(
             'table' => $this->_table,
             'name' => 'state_tax',
             'label' => 'Tax',
             'type' => 'text',
             //'type' => 'hidden',
             'attributes' => array(),
             'js_rules' => 'required',
             'rules' => 'trim|htmlentities'
         );
      

        $fields['state_status'] = array(
            'table' => $this->_table,
            'name' => 'state_status',
            'label' => 'Status',
            'type' => 'switch',
            'type_dt' => 'switch',
            'type_filter_dt' => 'dropdown',
            'list_data_key' => "news_status" ,
            'list_data' => array(
                0 => "<span class='label label-danger'>Inactive</span>" ,
                1 =>  "<span class='label label-primary'>Active</span>"
            ) ,
            'default' => '1',
            'attributes' => array(),
            'dt_attributes' => array("width" => "7%"),
            'rules' => 'trim'
        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>