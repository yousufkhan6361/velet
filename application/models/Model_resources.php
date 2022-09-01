<?
class Model_resources extends MY_Model
{
    /**
     * resources MODEL
     *
     * @package     resources Model
     * @version     1.0
     * @since       2019
     */

    protected $_table = 'resources';
    protected $_field_prefix = 'resources_';
    protected $_pk = 'resources_id';
    protected $_status_field = 'resources_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "resources_id,resources_title,resources_status";

        parent::__construct();
    }

    public function get_page_resources($page='')
    {
        // Set params
        $params['fields'] = 'resources_id,resources_title,resources_status';
        $params['where']['resources_page'] = $page;
        return $this->model_resources->find_one_active($params);

    }
    public function get_resources_type($type)
    {
        return $this->_list_data['resources_type'][$type];
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

            'resources_id' => array(
                'table' => $this->_table,
                'name' => 'resources_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),


            // 'resources_type' => array(
            //          'table'   => $this->_table,
            //          'name'   => 'resources_type',
            //          'label'   => 'Question Type',
            //          'type'   => 'dropdown',
            //          'attributes'   => array(),
            //          'js_rules'   => 'required',
            //          'list_data'    => $this->_list_data['resources_type'] ,
            //          'rules'   => 'required|trim|htmlentities'
            //       ),


              'resources_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'resources_title',
                     'label'   => 'Question',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),



            'resources_content' => array(
                'table' => $this->_table,
                'name' => 'resources_content',
                'label' => 'Answer ',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),

            


            // 'resources_is_featured' => array(
            //     'table' => $this->_table,
            //     'name' => 'resources_is_featured',
            //     'label' => 'Is Featured?',
            //     'type' => 'switch',
            //     'type_dt' => 'dropdown',
            //     'type_filter_dt' => 'dropdown',
            //     'list_data_key' => "resources_is_featured" ,
            //     'list_data'=> array() ,
            //     'default' => '1',
            //     'attributes' => array(),
            //     'dt_attributes' => array("width" => "7%"),
            //     'rules' => 'trim'
            // ),

            'resources_status' => array(
                'table' => $this->_table,
                'name' => 'resources_status',
                'label' => 'Status?',
                'type' => 'switch',
                'type_dt' => 'switch',
                'type_filter_dt' => 'dropdown',
                'list_data' => array(
                    0 => "<span class='label label-danger'>Inactive</span>" ,
                    1 =>  "<span class='label label-primary'>Active</span>"
                ) ,
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