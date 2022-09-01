<?
class Model_icon extends MY_Model {

    /**
     * Model_icon
     *
     * @package     Model_icon Model
     *
     * @version     1.0
     * @since       2017 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'icon';
    protected $_field_prefix    = 'icon_';
    protected $_pk    = 'icon_id';
    protected $_status_field    = 'icon_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "icon_id,icon_name,icon_status";
        /*$this->pagination_params['joins'][] = array(
                                                    "table"=>"category" , 
                                                    "joint"=>"category.category_id = service.service_category_id"
                                                    );*/
        parent::__construct();
    }

    // Get all icons
    public function get_icon_list()
    {
        // Get icons
        $result = $this->model_icon->find_all_active();
        // Set list (custom)
        /*foreach ($result as $key => $value) {
            $icon_name = $value['icon_name'];
            $resultant[$icon_name] = '<i class="'.$icon_name.'" aria-hidden="true"></i>';
        }*/

        //debug($resultant,1);

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
    public function get_fields( $specific_field = "" )
    {

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

            'icon_id' => array(
                'table'   => $this->_table,
                'name'   => 'icon_id',
                'label'   => 'ID',
                'type'   => 'hidden',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"5%"),
                'js_rules'   => '',
                'rules'   => 'trim'
            ),
            /*'service_category_id' => array(
                   'table'   => $this->_table,
                   'name'   => 'service_category_id',
                   'label'   => 'Category',
                   'type'   => 'dropdown',
                   'type_dt'   => 'text',
                   'type_filter_dt'   => 'dropdown',
                   'js_rules'   => 'required',
                   'rules'   => 'required|trim'
              ),*/

            'icon_name' => array(
                'table'   => $this->_table,
                'name'   => 'icon_name',
                'label'   => 'Name',
                'type'   => 'text',
                //'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                'attributes'   => array(),
                'default'   => '',
                'rules'   => 'trim|htmlentities|required|max_length[30]',
                'js_rules'   => 'required'
            ),
           /* 'service_description' => array(
                'table'   => $this->_table,
                'name'   => 'service_description',
                'label'   => 'Description',
                'type'   => 'textarea',
                //'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                'attributes'   => array(),
                'default'   => '',
                'rules'   => 'trim|htmlentities|required|max_length[125]',
                'js_rules'   => 'required'
            ),
            'service_url' => array(
                'table'   => $this->_table,
                'name'   => 'service_url',
                'label'   => 'URL',
                'type'   => 'text',
                //'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                'attributes'   => array(),
                'default'   => '',
                'rules'   => 'trim|htmlentities|required',
                'js_rules'   => 'required'
            ),*/
           /* 'service_slug'  => array(
                'table'   => $this->_table,
                'name'   => 'service_slug',
                'label'   => 'Slug',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => array("is_slug" => array() ),
                'rules'   => 'required|strtolower|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
            ),
            'service_zipcode' => array(
                'table'   => $this->_table,
                'name'   => 'service_zipcode',
                'label'   => 'Zip Code',
                'type'   => 'text',
                'attributes'   => array(),
                'default'   => '',
                'rules'   => 'trim|htmlentities|required|min_length[3]|is_natural_no_zero|max_length[6]',
                'js_rules'   => 'required'
            ),

            'service_image' => array(
                'table' => $this->_table,
                'name' => 'service_image',
                'label' => 'Image',
                'name_path' => 'service_image_path',
                'upload_config' => 'site_upload_service',
                'type' => 'fileupload',
                'thumb'   => array(array('name'=>'service_image_thumb','max_width'=>260, 'max_height'=>250),),
                'attributes'   => array(
                    'image_size_recommended'=>'260px × 250px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'   => $is_required_image,
            ),*/
            /*
            'service_code' => array(
                   'table'   => $this->_table,
                   'name'   => 'service_code',
                   'label'   => 'service Code',
                   'type'   => 'servicepicker',
                   'attributes'   => array(),
                   'js_rules'   => 'required',
                   'rules'   => 'required|trim'
                ),

            'service_slug' => array(
                   'table'   => $this->_table,
                   'name'   => 'service_slug',
                   'label'   => 'service Slug',
                   'type'   => 'servicepicker',
                   'attributes'   => array(),
                   'js_rules'   => array("is_slug" => array() ),
                   'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
                ),

  */


            'icon_status' => array(
                'table'   => $this->_table,
                'name'   => 'icon_status',
                'label'   => 'Status?',
                'type'   => 'switch',
                'type_dt'   => 'dropdown',
                'type_filter_dt'   => 'dropdown',
                'list_data' => array(

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