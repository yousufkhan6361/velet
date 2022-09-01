<?

class Model_category_parent extends MY_Model
{
    /**
     * TKD category_parent MODEL
     *
     * @package     category_parent Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'category_parent';
    protected $_field_prefix = 'category_parent_';
    protected $_pk = 'category_parent_id';
    protected $_status_field = 'category_parent_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        //$this->pagination_params['fields'] = "category_parent_id,category_parent_page,category_parent_name,CONCAT(category_parent_image_path,category_parent_image) AS category_parent_image,category_parent_status";
        $this->pagination_params['fields'] = "category_parent_id,category_parent_name,category_parent_status";

        parent::__construct();
    }

    public function get_category_parents($id = 0)
    {
        // Set params
        $params['fields'] = "category_parent_name,category_parent_id";
        $params['where']['category_parent_status'] = 1;
        return $this->model_category_parent->find_by_pk($id,false,$params);

    }

    /*
    * table       Table Name
    * Name        FIeld Name
    * label       Field Label / Textual Representation in form and DT names
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

        $fields['category_parent_id'] = array(
            'table' => $this->_table,
            'name' => 'category_parent_id',
            'label' => 'ID',
            'type' => 'hidden',
            'type_dt' => 'text',
            'attributes' => array(),
            'dt_attributes' => array("width" => "5%"),
            'js_rules' => 'required',
            'rules' => 'trim'
        );

        $fields['category_parent_name'] = array(
            'table' => $this->_table,
            'name' => 'category_parent_name',
            'label' => 'Name',
            'type' => 'text',
            'attributes' => array(),
            'js_rules' => 'required',
            'rules' => 'required|trim|htmlentities'
        );      

        $fields['category_parent_image'] = array(
            'table' => $this->_table,
            'name' => 'category_parent_image',
            'label' => 'Image',
            'name_path' => 'category_parent_image_path',
            'upload_config' => 'site_upload_category_parent',
            'type' => 'fileupload',
            'type_dt' => 'image',
            'randomize' => true,
            'preview' => 'true',
            'attributes' => array(
                'image_size_recommended' => '1344px × 381px',
                'allow_ext' => 'png|jpeg|jpg',
            ),
            'dt_attributes' => array("width" => "10%"),
            'rules' => '',
            'js_rules' => $is_required_image
        );

        $fields['category_parent_image_2'] = array(
            'table' => $this->_table,
            'name' => 'category_parent_image_2',
            'label' => 'Image 2',
            'name_path' => 'category_parent_image_path',
            'upload_config' => 'site_upload_category_parent',
            'type' => 'fileupload',
            'type_dt' => 'image',
            'randomize' => true,
            'preview' => 'true',
            'attributes' => array(
                'image_size_recommended' => '1344px × 381px',
                'allow_ext' => 'png|jpeg|jpg',
            ),
            'dt_attributes' => array("width" => "10%"),
            'rules' => '',
            'js_rules' => $is_required_image
        );

        $fields['category_parent_status'] = array(
            'table' => $this->_table,
            'name' => 'category_parent_status',
            'label' => 'Status',
            'type' => 'switch',
            'type_dt' => 'switch',
            'type_filter_dt' => 'dropdown',
            'list_data' => array(),
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