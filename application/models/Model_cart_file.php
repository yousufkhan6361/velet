<?

class Model_cart_file extends MY_Model
{

    /**
     * Social8 Album MODEL
     *
     * @package     Album Model
     */

    protected $_table = 'cart_file';
    protected $_field_prefix = 'cart_file_';
    protected $_pk = 'cart_file_id';
    protected $_status_field = 'cart_file_status';
    public $pagination_params = array();

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Get Albums (Time line=1, Profile=1, and Groups=1)
    public function get_cart_files($cart_file_cat_id=0)
    {
        $params = array();
        if($cart_file_cat_id>0){
            $params['where']['cart_file_category_id'] = $cart_file_cat_id;
        }
        $result = $this->model_cart_file->find_all_active($params);

        return $result;
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

        $fields = array(
            'cart_file_id' => array(
                'table' => $this->_table,
                'name' => 'cart_file_id',
                'label' => 'ID #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            'cart_file_image' => array(
                'table' => $this->_table,
                'name' => 'cart_file_image',
                'label' => 'Album Image',
                'name_path' => 'cart_file_image_path',
                'upload_config' => 'cart_file_upload_image',
                'type' => 'fileupload',
                'thumb'   => array(array('name'=>'cart_file_image_thumb','max_width'=>320, 'max_height'=>200),),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                //'attributes' => array('image_size' => 'Recommended  image size : 50px x 50px'),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities'
            ),

            'cart_file_status' => array(
                'table' => $this->_table,
                'name' => 'cart_file_status',
                'label' => 'Status?',
                'type' => 'switch',
                'type_dt' => 'dropdown',
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