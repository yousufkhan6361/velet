<?

class Model_album extends MY_Model
{

    /**
     * Social8 Album MODEL
     *
     * @package     Album Model
     */

    protected $_table = 'album';
    protected $_field_prefix = 'album_';
    protected $_pk = 'album_id';
    protected $_status_field = 'album_status';
    public $pagination_params = array();

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Get Albums (Time line=1, Profile=1, and Groups=1)
    public function get_albums($album_cat_id=0)
    {
        $params = array();
        if($album_cat_id>0){
            $params['where']['album_category_id'] = $album_cat_id;
        }
        $result = $this->model_album->find_all_active($params);

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
            'album_id' => array(
                'table' => $this->_table,
                'name' => 'album_id',
                'label' => 'ID #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),
            'album_category_id' => array(
                'table' => $this->_table,
                'name' => 'album_category_id',
                'label' => 'Category ID',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => 'required',
                'rules' => 'required|trim'
            ),
            'album_image' => array(
                'table' => $this->_table,
                'name' => 'album_image',
                'label' => 'Album Image',
                'name_path' => 'album_image_path',
                'upload_config' => 'album_upload_image',
                'type' => 'fileupload',
                'thumb'   => array(array('name'=>'album_image_thumb','max_width'=>320, 'max_height'=>200),),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                //'attributes' => array('image_size' => 'Recommended  image size : 50px x 50px'),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities'
            ),

            /*'album_name' => array(
                'table' => $this->_table,
                'name' => 'album_name',
                'label' => 'Album Name',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => '|required|trim|htmlentities'
            ),

            'album_description' => array(
                'table' => $this->_table,
                'name' => 'album_description',
                'label' => 'Album Description',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => '|required|trim|htmlentities'
            ),

            'album_user_id' => array(
                'table' => $this->_table,
                'name' => 'album_user_id',
                'label' => 'Album User ID',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => '|required|trim|htmlentities'
            ),*/

            /*
             * 1 = General (time line and profile)
             * 2 = Group
             *
             * */

           /* 'album_page_type' => array(
                'table' => $this->_table,
                'name' => 'album_page_type',
                'label' => 'Album Page Type',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => '|required|trim|htmlentities'
            ),
            'album_page_id' => array(
                'table' => $this->_table,
                'name' => 'album_page_id',
                'label' => 'Album Page ID',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => '|required|trim|htmlentities'
            ),

            'album_createdon' => array(
                'table' => $this->_table,
                'name' => 'album_createdon',
                'label' => 'Album Createdon',
                'type' => 'label',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => '|trim'
            ),*/

            'album_status' => array(
                'table' => $this->_table,
                'name' => 'album_status',
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