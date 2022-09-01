<?

class Model_slider extends MY_Model
{
    /**
     * TKD slider MODEL
     *
     * @package     slider Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'slider';
    protected $_field_prefix = 'slider_';
    protected $_pk = 'slider_id';
    protected $_status_field = 'slider_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        //$this->pagination_params['fields'] = "slider_id,slider_page,slider_heading,CONCAT(slider_image_path,slider_image) AS slider_image,slider_status";
        $this->pagination_params['fields'] = "slider_id,slider_description,slider_heading,slider_status";

        parent::__construct();
    }

    public function get_sliders($id = 0)
    {
        // Set params
        $params['fields'] = "slider_heading,slider_description,slider_image,slider_image_path";
        $params['where']['slider_status'] = 1;
        return $this->model_slider->find_by_pk($id,false,$params);

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

        $fields['slider_id'] = array(
            'table' => $this->_table,
            'name' => 'slider_id',
            'label' => 'ID',
            'type' => 'hidden',
            'type_dt' => 'text',
            'attributes' => array(),
            'dt_attributes' => array("width" => "5%"),
            'js_rules' => 'required',
            'rules' => 'trim'
        );

        $fields['slider_heading'] = array(
            'table' => $this->_table,
            'name' => 'slider_heading',
            'label' => 'Heading',
            'type' => 'text',
            'attributes' => array(),
            'js_rules' => 'required',
            'rules' => 'required|trim|htmlentities'
        );

        $fields['slider_description'] = array(
            'table' => $this->_table,
            'name' => 'slider_description',
            'label' => 'Description',
            //'type' => 'textarea',
            'type' => 'editor',
            'attributes' => array(),
            'js_rules' => 'required',
            'rules' => 'trim|htmlentities'
        );        

        $fields['slider_image'] = array(
            'table' => $this->_table,
            'name' => 'slider_image',
            'label' => 'Image',
            'name_path' => 'slider_image_path',
            'upload_config' => 'site_upload_slider',
            'type' => 'fileupload',
            'type_dt' => 'image',
            'randomize' => true,
            'preview' => 'true',
            'attributes' => array(
                'image_size_recommended' => '1223px × 608px',
                'allow_ext' => 'png|jpeg|jpg',
            ),
            'dt_attributes' => array("width" => "10%"),
            'rules' => '',
            'js_rules' => $is_required_image
        );

        $fields['slider_status'] = array(
            'table' => $this->_table,
            'name' => 'slider_status',
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